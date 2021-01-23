<?php

namespace App\Controllers;

use App\Models\Compra;
use App\Models\Venta;
use App\Models\Categoria;
use App\Models\Servicio;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Empleado;
use App\Traits\Utility;
use Exception;
use PDO;
use System\Core\Controller;
use System\Core\View;

class ReporteController extends Controller {

    private $compra;
    private $venta;
    private $usuario;
    private $producto;
    private $categoria;
    private $empleado;
    private $servicio;
	
	use Utility;

	public function __construct(){
        
        $this->compra = new Compra;
        $this->venta = new Venta;
        $this->usuario = new Usuario;
        $this->categoria = new Categoria;
        $this->producto = new Producto;
        $this->empleado = new Empleado;
        $this->servicio = new Servicio;
    }
    
    public function index(){
        if($_SESSION['rol'] != 1){
            header("Location: ".ROOT);
            return false;
        }
        $query = $this->usuario->connect()->prepare("SELECT id, CONCAT(nombre,' ', apellido) AS nombre FROM
                usuarios WHERE estatus='Activo'");
        $query->execute();
        $usuarios = $query->fetchAll(PDO::FETCH_OBJ);
        $tecnicos = $this->empleado->getTecnicos();
        $categorias = $this->categoria->getCategorias();
        return View::getView('Reporte.index',[
            'usuarios' => $usuarios,
            'tecnicos' => $tecnicos,
            'categorias' => $categorias
        ]);
    }

    public function ventas () {
        $query = $this->usuario->connect()->prepare("SELECT id, CONCAT(nombre,' ', apellido) AS nombre FROM
                usuarios WHERE estatus='Activo'");
        $query->execute();
        $usuarios = $query->fetchAll(PDO::FETCH_OBJ);

        return View::getView('Reporte.ventas',[
            'usuarios' => $usuarios
        ]);
    }

    public function servicios () {
        $tecnicos = $this->empleado->getTecnicos();

        return View::getView('Reporte.servicios',[
            'tecnicos' => $tecnicos
        ]);
    }

    public function productos () {
        $categorias = $this->categoria->getCategorias();

        return View::getView('Reporte.productos',[
            'categorias' => $categorias
        ]);
    }

    public function reporteVenta()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }  
        $usuario = $_POST['vendedor']; 
        $desde = $_POST['desde']; 
        $hasta = $_POST['hasta']; 
        $desde.= " 00:00:00";
        $hasta.= " 23:59:59";
        $vendedor = NULL;
        if($usuario == 0){
            $query = $this->venta->connect()->prepare("SELECT v.codigo, date_format(v.fecha, '%d-%m-%Y %r') as fecha,
                c.nombre as cliente, CONCAT(u.nombre, ' ', u.apellido) as vendedor, ROUND(SUM(d.precio*d.cantidad),2) as total
                FROM ventas v INNER JOIN clientes c ON v.cliente_id = c.id 
                INNER JOIN usuarios u ON v.usuario_id = u.id INNER JOIN detalle_venta d ON d.venta_id=v.id
                WHERE v.estatus = 'ACTIVO' AND v.fecha BETWEEN
                :desde AND :hasta GROUP BY d.venta_id ORDER BY v.fecha DESC

            ");
            $vendedores = true;
            // $query2 = $this->venta->connect()->prepare("SELECT v.codigo, v.fecha, vp.metodo, count(vp.metodo) as cantidad, SUM(vp.monto) as 
            //     total FROM ventas v LEFT JOIN venta_pago vp ON v.id = vp.venta_id 
            //     WHERE v.estatus = 'ACTIVO' AND v.fecha BETWEEN
            //     :desde AND :hasta GROUP BY vp.metodo ");
        }
        else{
            $query = $this->venta->connect()->prepare("SELECT v.codigo, date_format(v.fecha, '%d-%m-%Y %r') as fecha,
                c.nombre as cliente, CONCAT(u.nombre, ' ', u.apellido) as vendedor, ROUND(SUM(d.precio*d.cantidad),2) as total
                FROM ventas v INNER JOIN clientes c ON v.cliente_id = c.id 
                INNER JOIN usuarios u ON v.usuario_id = u.id INNER JOIN detalle_venta d ON d.venta_id=v.id
                WHERE v.estatus = 'ACTIVO' AND v.usuario_id = :usuario AND v.fecha BETWEEN
                :desde AND :hasta GROUP BY d.venta_id ORDER BY v.fecha DESC
            ");
            $query->bindParam(':usuario',$usuario);
            $vendedores = false;
            // $query2 = $this->venta->connect()->prepare("SELECT v.codigo, v.fecha, vp.metodo, count(vp.metodo) as cantidad, SUM(vp.monto) as 
            //     total FROM ventas v LEFT JOIN venta_pago vp ON v.id = vp.venta_id 
            //     WHERE v.estatus = 'ACTIVO' AND v.usuario_id = :usuario AND v.fecha BETWEEN
            //     :desde AND :hasta GROUP BY vp.metodo ");
            // $query2->bindParam(':usuario',$usuario);
            $vendedor = $this->usuario->getOne("usuarios", $usuario);
        }
        $query->bindParam(':desde',$desde);
        $query->bindParam(':hasta',$hasta);
        $query->execute();
        $ventas = $query->fetchAll(PDO::FETCH_OBJ);
        // $query2->bindParam(':desde',$desde);
        // $query2->bindParam(':hasta',$hasta);
        // $query2->execute();
        // $pagos = $query2->fetchAll(PDO::FETCH_OBJ);
        // $dolar = $this->venta->getAll('dolar');
        ob_start();
        if ($vendedores) {
            View::getViewPDF('FormatosPDF.reporteVenta',[
                'ventas' => $ventas,
                // 'pagos' => $pagos,
                'desde' => $desde,
                'hasta' => $hasta,
                'dolar' => 1,
                // 'dolar' => $dolar[0]->precio,
                'vendedores' => $vendedores,
                'cantidad' => 0,
                'total' => 0
            ]);
        }
        else{
            View::getViewPDF('FormatosPDF.reporteVenta',[
                'ventas' => $ventas,
                // 'pagos' => $pagos,
                'desde' => $desde,
                'hasta' => $hasta,
                'dolar' => 1,
                // 'dolar' => $dolar[0]->precio,
                'vendedores' => $vendedores,
                'cantidad' => 0,
                'total' => 0,
                'vendedor' =>$vendedor->nombre." ".$vendedor->apellido
            ]);
        }
        

        $html = ob_get_clean();

        $this->crearPDF($html);
       
    }
    
    public function reporteServicio()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }  
        $empleado = $_POST['tecnico']; 
        $desde = $_POST['desde']; 
        $hasta = $_POST['hasta']; 
        $desde.= " 00:00:00";
        $hasta.= " 23:59:59";
        $tecnico = NULL;
        if($empleado == 0){
            $query = $this->servicio->connect()->prepare("SELECT p.codigo, date_format(p.fecha, '%d-%m-%Y %r') as fecha,
                c.nombre as cliente, CONCAT(e.nombre, ' ', e.apellido) as empleado, ROUND(d.precio,2) as total, s.nombre as nombre_servicio
                FROM servicios_prestados p 
                INNER JOIN clientes c 
                ON p.cliente_id = c.id 
                INNER JOIN empleados e 
                ON p.empleado_id = e.id 
                INNER JOIN detalle_servicio d 
                ON d.servicio_prestado_id=p.id
                INNER JOIN servicios s
                ON  d.servicio_id = s.id
                WHERE p.estatus = 'ACTIVO' AND p.fecha BETWEEN
                :desde AND :hasta GROUP BY d.servicio_prestado_id ORDER BY p.fecha DESC
            ");
            $tecnicos = true;
            // $query2 = $this->venta->connect()->prepare("SELECT v.codigo, v.fecha, vp.metodo, count(vp.metodo) as cantidad, SUM(vp.monto) as 
            //     total FROM ventas v LEFT JOIN venta_pago vp ON v.id = vp.venta_id 
            //     WHERE v.estatus = 'ACTIVO' AND v.fecha BETWEEN
            //     :desde AND :hasta GROUP BY vp.metodo ");
        }
        else{

            $query = $this->servicio->connect()->prepare("SELECT p.codigo, date_format(p.fecha, '%d-%m-%Y %r') as fecha,
                c.nombre as cliente, CONCAT(e.nombre, ' ', e.apellido) as empleado, ROUND(d.precio,2) as total, s.nombre as nombre_servicio
                FROM servicios_prestados p INNER JOIN clientes c ON p.cliente_id = c.id 
                INNER JOIN empleados e 
                ON p.empleado_id = e.id 
                INNER JOIN detalle_servicio d 
                ON d.servicio_prestado_id=p.id 
                INNER JOIN servicios s
                ON  d.servicio_id = s.id
                WHERE p.estatus = 'ACTIVO' AND p.empleado_id = :empleado AND p.fecha BETWEEN
                :desde AND :hasta GROUP BY d.servicio_prestado_id ORDER BY p.fecha DESC
            ");

            $query->bindParam(':empleado',$empleado);
            $tecnicos = false;
            // $query2 = $this->venta->connect()->prepare("SELECT v.codigo, v.fecha, vp.metodo, count(vp.metodo) as cantidad, SUM(vp.monto) as 
            //     total FROM ventas v LEFT JOIN venta_pago vp ON v.id = vp.venta_id 
            //     WHERE v.estatus = 'ACTIVO' AND v.usuario_id = :usuario AND v.fecha BETWEEN
            //     :desde AND :hasta GROUP BY vp.metodo ");
            // $query2->bindParam(':usuario',$usuario);
            $tecnico = $this->empleado->getOne("empleados", $empleado);
        }
        $query->bindParam(':desde',$desde);
        $query->bindParam(':hasta',$hasta);
        $query->execute();
        $servicios = $query->fetchAll(PDO::FETCH_OBJ);
        // $query2->bindParam(':desde',$desde);
        // $query2->bindParam(':hasta',$hasta);
        // $query2->execute();
        // $pagos = $query2->fetchAll(PDO::FETCH_OBJ);
        // $dolar = $this->venta->getAll('dolar');
        ob_start();
        if ($tecnicos) {
            View::getViewPDF('FormatosPDF.reporteServicio',[
                'servicios' => $servicios,
                // 'pagos' => $pagos,
                'desde' => $desde,
                'hasta' => $hasta,
                'dolar' => 1,
                // 'dolar' => $dolar[0]->precio,
                'tecnicos' => $tecnicos,
                'cantidad' => 0,
                'total' => 0
            ]);
        }
        else{
            View::getViewPDF('FormatosPDF.reporteServicio',[
                'servicios' => $servicios,
                // 'pagos' => $pagos,
                'desde' => $desde,
                'hasta' => $hasta,
                'dolar' => 1,
                // 'dolar' => $dolar[0]->precio,
                'tecnicos' => $tecnicos,
                'cantidad' => 0,
                'total' => 0,
                'tecnico' =>$tecnico->nombre." ".$tecnico->apellido
            ]);
        }
        
        $html = ob_get_clean();

        $this->crearPDF($html);
       
    }
    
    public function reporteProducto()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }  
        $categoria_id = $_POST['categoria'];
        $categorias = NULL;
        if($categoria_id == 0){
            $query = $this->producto->connect()->prepare("SELECT p.codigo,p.nombre,p.precio_venta,p.stock,p.stock_min,
                p.stock_max, c.nombre as nombre_categoria, u.abreviatura
                FROM productos p 
                INNER JOIN categorias c 
                ON c.id = p.categoria_id 
                INNER JOIN unidades u 
                ON u.id = p.unidad_id 
                WHERE p.estatus = 'ACTIVO'
                ORDER BY c.nombre
            ");
            $categorias = true;
            // $query2 = $this->venta->connect()->prepare("SELECT v.codigo, v.fecha, vp.metodo, count(vp.metodo) as cantidad, SUM(vp.monto) as 
            //     total FROM ventas v LEFT JOIN venta_pago vp ON v.id = vp.venta_id 
            //     WHERE v.estatus = 'ACTIVO' AND v.fecha BETWEEN
            //     :desde AND :hasta GROUP BY vp.metodo ");
        }
        else{

            $query = $this->producto->connect()->prepare("SELECT p.codigo,p.nombre,p.precio_venta,p.stock,p.stock_min,
                p.stock_max, c.nombre as nombre_categoria, u.abreviatura
                FROM productos p 
                INNER JOIN categorias c 
                ON c.id = p.categoria_id 
                INNER JOIN unidades u 
                ON u.id = p.unidad_id 
                WHERE categoria_id = :categoria
                AND p.estatus = 'ACTIVO'
                ORDER BY c.nombre
            ");

            $query->bindParam(':categoria',$categoria_id);
            $categorias = false;
            // $query2 = $this->venta->connect()->prepare("SELECT v.codigo, v.fecha, vp.metodo, count(vp.metodo) as cantidad, SUM(vp.monto) as 
            //     total FROM ventas v LEFT JOIN venta_pago vp ON v.id = vp.venta_id 
            //     WHERE v.estatus = 'ACTIVO' AND v.usuario_id = :usuario AND v.fecha BETWEEN
            //     :desde AND :hasta GROUP BY vp.metodo ");
            // $query2->bindParam(':usuario',$usuario);
            $categoria = $this->categoria->getOne("categorias", $categoria_id);
        }
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        // $query2->bindParam(':desde',$desde);
        // $query2->bindParam(':hasta',$hasta);
        // $query2->execute();
        // $pagos = $query2->fetchAll(PDO::FETCH_OBJ);
        // $dolar = $this->venta->getAll('dolar');

        ob_start();
        if ($categorias) {
            View::getViewPDF('FormatosPDF.reporteProducto',[
                'productos' => $productos,
                // 'pagos' => $pagos,
                'dolar' => 1,
                // 'dolar' => $dolar[0]->precio,
                'categorias' => $categorias,
                'cantidad' => 0,
                'total' => 0
            ]);
        }
        else{
            View::getViewPDF('FormatosPDF.reporteProducto',[
                'productos' => $productos,
                // 'pagos' => $pagos,
                'dolar' => 1,
                // 'dolar' => $dolar[0]->precio,
                'categorias' => $categorias,
                'cantidad' => 0,
                'total' => 0,
                'categoria' =>$categoria->nombre
            ]);
        }
        
        $html = ob_get_clean();

        $this->crearPDF($html);
       
    }
    
}