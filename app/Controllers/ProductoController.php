<?php

namespace App\Controllers;

use App\Models\Producto;
use App\Models\Configuracion;
use App\Traits\Utility;
use PDO;
use System\Core\Controller;
use System\Core\View;

class ProductoController extends Controller{
    private $producto;

    use Utility;

    public function __construct(){
        $this->producto = new Producto();
    }

    public function index(){
        $band = false;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Productos") {     
            $band = true;
        }endforeach;   
        if (!$band) {
            header("Location: ".ROOT);
            return false;
        }
        return View::getView('Producto.index');
    }

    public function mostrar($param){

        $param = $this->desencriptar($param);

        $producto = $this->producto->query("SELECT p.id, c.id AS categoria_id, u.id AS unidad_id, p.codigo, p.nombre, c.nombre AS categoria, u.nombre AS unidad, p.precio_porcentaje AS porcentaje, p.precio_venta AS precio, p.precio_costo AS precio_costo, p.descripcion, IFNULL(e.total - s.total,0) AS stock, p.stock_min, p.stock_max, p.estatus 
            FROM productos p
            JOIN categorias c 
                ON p.categoria_id = c.id
            JOIN unidades u
                ON p.unidad_id = u.id
            LEFT JOIN
            v_entradas_totales e
                ON p.id = e.id
            LEFT JOIN
            v_salidas_totales s 
                ON p.id = s.id
            WHERE p.id = '$param' LIMIT 1");
        $producto = $producto->fetch(PDO::FETCH_OBJ);                                    

        http_response_code(200);

        echo json_encode([
            'data' => $producto
        ]);

        exit();
    }

    public function listar(){

        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
        http_response_code(404);
        return false;
        }

        $productos = $this->producto->listar();
        $config = new Configuracion;
        $dolar = $config->obtenerDolar();
        $editar = false;
        $eliminar = false;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Editar Productos") {     
            $editar = true;
        }endforeach;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Eliminar Productos") {     
            $eliminar = true;
        }endforeach;
        foreach($productos as $producto){
    
            $producto->button = 
            "<a href=".ROOT."producto/mostrar/". $this->encriptar($producto->id) ."' class='mostrar btn btn-info mr-1 mb-1' title='Consultar'><i class='fas fa-search'></i></a>";
            if ($editar) {
                $producto->button .= "<a href=".ROOT."producto/mostrar/". $this->encriptar($producto->id) ."' class='editar btn btn-warning mr-1 mb-1' title='Editar'><i class='fas fa-pencil-alt'></i></a>";
            }
            if ($eliminar) {
                if($producto->estatus == "ACTIVO"){
                    $producto->button .= "<a href='". $this->encriptar($producto->id) ."' class='eliminar btn btn-danger mr-1 mb-1' title='Eliminar'><i class='fas fa-trash-alt'></i></a>";
                }
                else{
                    $producto->button .= "<a href='". $this->encriptar($producto->id) ."' class='estatusAnulado btn btn-outline-info mr-1 mb-1' title='Activar'><i class='fas fa-trash'></i></a>";
                }
            }
            if (isset($producto->precio_venta)) {
                $producto->precio_bss = round($producto->precio_venta * $dolar, 2);
            }
            else{
                $producto->precio_bss = NULL;
            }
            
        }

        http_response_code(200);

        echo json_encode([
        'data' => $productos
        ]);

    }

    public function guardar(){

        $method = $_SERVER['REQUEST_METHOD'];
    
        if( $method != 'POST'){
          http_response_code(404);
          return false;
        }
    
        $producto = new Producto;
    
        $producto->setCategoriaId($this->limpiaCadena($_POST['categoria']));
        $producto->setUnidadId(($this->limpiaCadena($_POST['unidad'])));
        $producto->setCodigo(strtoupper($this->limpiaCadena($_POST['codigo'])));
        $producto->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
        $producto->setPrecioPorcentaje((strtoupper($this->limpiaCadena($_POST['porcentaje']))));
        $producto->setDescripcion((strtoupper($this->limpiaCadena($_POST['descripcion']))));
        $producto->setStockMin($this->limpiaCadena($_POST['stock_min']));
        $producto->setStockMax($this->limpiaCadena($_POST['stock_max']));

        if($_POST['descripcion'] != ''){
            $producto->setDescripcion(strtoupper($this->limpiaCadena($_POST['descripcion'])));
        }else{
            $producto->setDescripcion('N/A');
        }
    
        // Variables a consultar
        $codigo = $producto->getCodigo();
        $nombre = $producto->getNombre();

        $consulta = $this->producto->query("SELECT * FROM productos WHERE codigo='$codigo'" ); // Verifica inexistencia de , sies igual a la actual no la toma en cuenta puesto que si registramos un cambio en el nombre se mantiene la misma cedula y afectaria la consulta.
    
        if ($consulta->rowCount() >= 1) {
    
          http_response_code(200);
          
          echo json_encode([
            'titulo' => 'Codigo Registrado',
            'mensaje' => $codigo . ' Se encuentra registrado en nuestro sistema',
            'tipo' => 'error'
          ]);
    
          exit();
    
        }else{

            $consulta2 = $this->producto->query("SELECT * FROM productos WHERE nombre='$nombre'");

            if($consulta2->rowCount() >= 1 ){
                http_response_code(200);
          
                echo json_encode([
                    'titulo' => 'Nombre Registrado',
                    'mensaje' => $nombre . ' Se encuentra registrado en nuestro sistema',
                    'tipo' => 'error'
                ]);
            
                exit();
            }else {
                
                if($this->producto->registrar($producto)){
                    http_response_code(200);
                
                    echo json_encode([
                      'titulo' => 'Registro Exitoso',
                      'mensaje' => 'Producto registrado en nuestro sistema',
                      'tipo' => 'success'
                    ]);
        
                    exit();
                }else{
                    http_response_code(200);
                
                    echo json_encode([
                      'titulo' => 'Error Inesperado',
                      'mensaje' => 'Ocurrio un error durante la operacion!',
                      'tipo' => 'error'
                    ]);
        
                    exit();
                }
            }

        }
    
        
    
    
    
    }

    public function actualizar(){
        $method = $_SERVER['REQUEST_METHOD'];
    
        if( $method != 'POST'){
          http_response_code(404);
          return false;
        }
    
        $producto = new Producto;
        
        $producto->setId($_POST['id']);
        $producto->setCategoriaId($this->limpiaCadena($_POST['categoria']));
        $producto->setUnidadId(($this->limpiaCadena($_POST['unidad'])));
        $producto->setCodigo(strtoupper($this->limpiaCadena($_POST['codigo'])));
        $producto->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
        $producto->setPrecioPorcentaje((strtoupper($this->limpiaCadena($_POST['porcentaje']))));
        // $producto->setPrecioVenta($this->limpiaCadena($_POST['precio']));
        $producto->setDescripcion((strtoupper($this->limpiaCadena($_POST['descripcion']))));
        $producto->setStockMin($this->limpiaCadena($_POST['stock_min']));
        $producto->setStockMax($this->limpiaCadena($_POST['stock_max']));

        if($_POST['descripcion'] != ''){
            $producto->setDescripcion(strtoupper($this->limpiaCadena($_POST['descripcion'])));
        }else{
            $producto->setDescripcion('N/A');
        }

        $id = $producto->getId();
        $codigo = $producto->getCodigo();
        $nombre = $producto->getNombre();

        $consulta1 = $this->producto->query("SELECT * FROM productos WHERE codigo='$codigo' AND id<>'$id'" ); //Consulta codigo
        $consulta2 = $this->producto->query("SELECT * FROM productos WHERE nombre='$nombre' AND id<>'$id'" ); //Consulta nombr

        if ($consulta1->rowCount() >= 1) {

            http_response_code(200);
          
            echo json_encode([
                'titulo' => 'Codigo Registrado',
                'mensaje' => $codigo . ' Se encuentra registrado en nuestro sistema',
                'tipo' => 'error'
            ]);
        
            exit();

        } elseif ($consulta2->rowCount() >= 1) {

            http_response_code(200);
          
            echo json_encode([
                'titulo' => 'Nombre Registrado',
                'mensaje' => $nombre . ' Se encuentra registrado en nuestro sistema',
                'tipo' => 'error'
            ]);
        
            exit();

        } else {

            //Actualizacion de precio
            $consulta3 = $this->producto->query("SELECT e.costo FROM 
                detalle_compra e
                    JOIN
                productos p
                    ON e.producto_id = p.id
                    WHERE p.id = '$id'
                    ORDER BY e.id DESC LIMIT 1");

            $ultimoPrecio = $consulta3->fetch(PDO::FETCH_COLUMN);

            $precioVenta = ($producto->getPrecioPorcentaje() / 100) * $ultimoPrecio + $ultimoPrecio ;

            if($precioVenta == 0){
                $precioVenta = null;
            }

            $producto->setPrecioVenta($precioVenta);

            // echo json_encode($producto->getPrecioVenta());
            // exit();


            if ($this->producto->actualizar($producto)) {
                http_response_code(200);
          
                echo json_encode([
                    'titulo' => 'Actualizacion exitosa!',
                    'mensaje' => 'Registro actualizado en nuestro sistema',
                    'tipo' => 'success'
                ]);
            
                exit();
            } else {
                http_response_code(200);
            
                echo json_encode([
                    'titulo' => 'Error!',
                    'mensaje' => 'Ocurrio un error al actualizar',
                    'tipo' => 'error'
                ]);
            
                exit();
            }

        } 

    }

    public function eliminar($id){

        $method = $_SERVER['REQUEST_METHOD'];
    
        if( $method != 'POST'){
          http_response_code(404);
          return false;
        }
    
        $id = $this->desencriptar($id);
    
        if($this->producto->eliminar("productos", $id)){
    
          http_response_code(200);
    
          echo json_encode([
            'titulo' => 'Registro eliminado!',
            'mensaje' => 'Registro eliminado en nuestro sistema',
            'tipo' => 'success'
          ]);
        }else{
          http_response_code(404);
    
          echo json_encode([
            'titulo' => 'Ocurio un error!',
            'mensaje' => 'No se pudo eliminar el registro',
            'tipo' => 'error'
          ]);
        }
        
    
    }

    public function habilitar($id){

        $method = $_SERVER['REQUEST_METHOD'];
    
        if( $method != 'POST'){
          http_response_code(404);
          return false;
        }
    
        $id = $this->desencriptar($id);
    
        if($this->producto->habilitar("productos", $id)){
    
          http_response_code(200);
    
          echo json_encode([
            'titulo' => 'Registro eliminado!',
            'mensaje' => 'Registro eliminado en nuestro sistema',
            'tipo' => 'success'
          ]);
        }else{
          http_response_code(404);
    
          echo json_encode([
            'titulo' => 'Ocurio un error!',
            'mensaje' => 'No se pudo eliminar el registro',
            'tipo' => 'error'
          ]);
        }
        
    
    }
}
