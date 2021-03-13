<?php

namespace App\Controllers;

use App\Models\Compra;
use App\Models\Venta;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Proveedor;
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
    private $proveedor;
    private $cliente;
    private $categoria;
    private $empleado;
    private $servicio;
	
	use Utility;

	public function __construct(){
        
        $this->compra = new Compra;
        $this->venta = new Venta;
        $this->usuario = new Usuario;
        $this->categoria = new Categoria;
        $this->cliente = new Cliente;
        $this->proveedor = new Proveedor;
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
                usuarios WHERE estatus='ACTIVO'");
        $query->execute();
        $usuarios = $query->fetchAll(PDO::FETCH_OBJ);
        $clientes = $this->cliente->getClientes();
        $productos = $this->producto->getProductos();

        return View::getView('Reporte.ventas',[
            'usuarios' => $usuarios,
            'productos' => $productos,
            'clientes' => $clientes
        ]);
    }

    public function servicios () {
        $tecnicos = $this->empleado->getTecnicos();
        $clientes = $this->cliente->getClientes();
        $servicios = $this->servicio->getServicios();

        return View::getView('Reporte.servicios',[
            'tecnicos' => $tecnicos,
            'servicios' => $servicios,
            'clientes' => $clientes
        ]);
    }

    public function productos () {
        $categorias = $this->categoria->getCategorias();
        $productos = $this->producto->getProductos();

        return View::getView('Reporte.productos',[
            'categorias' => $categorias,
            'productos' => $productos
        ]);
    }

    public function compras () {
        $proveedores = $this->proveedor->getProveedores();
        $productos = $this->producto->getProductos();

        return View::getView('Reporte.compras',[
            'proveedores' => $proveedores,
            'productos' => $productos
        ]);
    }
    public function estadisticasVentas()
    {
        
        $usuario = $_POST['vendedor']; 
        $cliente_id = $_POST['cliente']; 
        $producto_id = $_POST['producto'];
        $desde = $_POST['desde']; 
        $hasta = $_POST['hasta']; 
        $desde.= " 00:00:00";
        $hasta.= " 23:59:59";
        $vendedores = true;
        $clientes = true;
        $productos = true;
        $limit = 8;

        for ($i=0; $i < $limit; $i++) { 
            $productosN[$i] = "";
            $productosC[$i] = "";
            $clientesN[$i] = "";
            $clientesC[$i] = "";

        }

        //Consulta de productos
        // if ($producto_id == 0) {
            $sql = "SELECT p.nombre as producto, COUNT(d.producto_id) as cantidad
                FROM ventas v 
                INNER JOIN detalle_venta d 
                ON d.venta_id=v.id
                INNER JOIN productos p 
                ON d.producto_id = p.id
                INNER JOIN clientes c 
                ON v.cliente_id = c.id
                WHERE v.estatus = 'ACTIVO'";

            if($usuario != 0){
                $vendedores = false;
                $sql .= " AND v.usuario_id = :usuario ";
                $vendedor = $this->usuario->getOne("usuarios", $usuario);
            }
            if($cliente_id != 0){
                $clientes = false;
                $sql .= " AND v.cliente_id = :cliente ";
                $cliente = $this->cliente->getOne("clientes", $cliente_id);
            }
            if($producto_id != 0){
                $productos = false;
                $sql .= " AND d.producto_id = :producto ";
                $producto = $this->producto->getOne("productos", $producto_id);
            }

            $sql .= " AND v.fecha BETWEEN :desde AND :hasta GROUP BY d.producto_id ORDER BY cantidad DESC LIMIT $limit";
            $query = $this->venta->connect()->prepare($sql);

            if (!$vendedores) {
                $query->bindParam(':usuario',$usuario);
            }
            if (!$clientes) {
                $query->bindParam(':cliente',$cliente_id);
            }
            if (!$productos) {
                $query->bindParam(':producto',$producto_id);
            }


            $query->bindParam(':desde',$desde);
            $query->bindParam(':hasta',$hasta);
            $query->execute();
            $productos = $query->fetchAll(PDO::FETCH_OBJ);
            for ($i=0; $i < count($productos); $i++) { 
                $productosN[$i] = $productos[$i]->producto;
                $productosC[$i] = $productos[$i]->cantidad;
            }
        // }

        //Consulta clientes
        $sqlD = "SELECT CONCAT(c.nombre,' ',c.apellido) as nombre, COUNT(v.cliente_id) as cantidad
            FROM ventas v 
            INNER JOIN clientes c 
            ON v.cliente_id = c.id
            WHERE v.estatus = 'ACTIVO'";

        if($usuario != 0){
            $vendedores = false;
            $sqlD .= " AND v.usuario_id = :usuario ";
            // $vendedor = $this->usuario->getOne("usuarios", $usuario);
        }
        if($cliente_id != 0){
            $clientes = false;
            $sqlD .= " AND v.cliente_id = :cliente ";
            // $cliente = $this->cliente->getOne("clientes", $cliente_id);
        }
        if($producto_id != 0){
            $productos = false;
            $sqlD .= " AND v.id IN (SELECT venta_id FROM detalle_venta WHERE producto_id = :producto) ";
            // $producto = $this->producto->getOne("productos", $producto_id);
        }

        $sqlD .= " AND v.fecha BETWEEN :desde AND :hasta GROUP BY v.cliente_id ORDER BY cantidad LIMIT $limit";
        $queryD = $this->venta->connect()->prepare($sqlD);

        if (!$vendedores) {
            $queryD->bindParam(':usuario',$usuario);
        }
        if (!$clientes) {
            $queryD->bindParam(':cliente',$cliente_id);
        }
        if (!$productos) {
            $queryD->bindParam(':producto',$producto_id);
        }


        $queryD->bindParam(':desde',$desde);
        $queryD->bindParam(':hasta',$hasta);
        $queryD->execute();
        $clientes = $queryD->fetchAll(PDO::FETCH_OBJ);
        // var_dump($productos);
        
        // var_dump($productos);
        
        for ($i=0; $i < count($clientes); $i++) { 
            $clientesN[$i] = $clientes[$i]->nombre;
            $clientesC[$i] = $clientes[$i]->cantidad;
        }
    //    echo $productosN[0]."<br>";
    //    echo $productosN[1]."<br>";
    //    echo $productosN[2]."<br>";
    var_dump($clientesN);
    
    echo "<br>";
    var_dump($clientesC);
        // $productosN = [$productos[0]->producto,"Arroz","Maiz"];
        return View::getView('Reporte.estadisticasVentas',[
            'productosN' =>$productosN,
            'productosC' =>$productosC,
            'clientesN' =>$clientesN,
            'clientesC' =>$clientesC,
            'vendedor' =>$_POST['vendedor'],
            'cliente' =>$_POST['cliente'],
            'producto' =>$_POST['producto'],
            'desde' =>$_POST['desde'],
            'hasta' =>$_POST['hasta'],
            'vendedores' =>$vendedores,
            'clientes' =>$clientes,
            'productos' =>$productos
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
        $cliente_id = $_POST['cliente']; 
        $producto_id = $_POST['producto'];
        $desde = $_POST['desde']; 
        $hasta = $_POST['hasta']; 
        $desde.= " 00:00:00";
        $hasta.= " 23:59:59";
        $vendedor = NULL;
        $vendedores = true;
        $clientes = true;
        $productos = true;

        $sql = "SELECT v.codigo, date_format(v.fecha, '%d-%m-%Y %r') as fecha,
        c.nombre as cliente, CONCAT(u.nombre, ' ', u.apellido) as vendedor, ROUND(SUM(d.precio*d.cantidad*(1+v.impuesto/100)),2) as total,
        ROUND(SUM(d.precio*d.cantidad*(1+v.impuesto/100)*v.dolar),2) as totalBss
        FROM ventas v 
        INNER JOIN clientes c 
        ON v.cliente_id = c.id 
        INNER JOIN usuarios u 
        ON v.usuario_id = u.id 
        INNER JOIN detalle_venta d 
        ON d.venta_id=v.id
        WHERE v.estatus = 'ACTIVO'";

        if($usuario != 0){
            $vendedores = false;
            $sql .= " AND v.usuario_id = :usuario ";
            $vendedor = $this->usuario->getOne("usuarios", $usuario);
        }
        if($cliente_id != 0){
            $clientes = false;
            $sql .= " AND v.cliente_id = :cliente ";
            $cliente = $this->cliente->getOne("clientes", $cliente_id);
        }
        if($producto_id != 0){
            $productos = false;
            $sql .= " AND d.producto_id = :producto ";
            $producto = $this->producto->getOne("productos", $producto_id);
        }

        $sql .= " AND v.fecha BETWEEN :desde AND :hasta GROUP BY d.venta_id ORDER BY v.fecha DESC";

        $query = $this->venta->connect()->prepare($sql);

        if (!$vendedores) {
            $query->bindParam(':usuario',$usuario);
        }
        if (!$clientes) {
            $query->bindParam(':cliente',$cliente_id);
        }
        if (!$productos) {
            $query->bindParam(':producto',$producto_id);
        }


        $query->bindParam(':desde',$desde);
        $query->bindParam(':hasta',$hasta);
        $query->execute();
        $ventas = $query->fetchAll(PDO::FETCH_OBJ);

        $output = array(
            'ventas' => $ventas,
            'desde' => $desde,
            'hasta' => $hasta,
            'dolar' => 1,
            'vendedores' => $vendedores,
            'clientes' => $clientes,
            'productos' => $productos,
            'cantidad' => 0,
            'total' => 0
        );

        if (!$vendedores) $output += ['vendedor' =>$vendedor->nombre." ".$vendedor->apellido];
        if (!$clientes) $output += ['cliente' => $cliente->nombre." ".$cliente->apellido];
        if (!$productos) $output += ['producto' => $producto->nombre];

        ob_start();
        View::getViewPDF('FormatosPDF.reporteVenta',$output);

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
        $cliente_id = $_POST['cliente']; 
        $servicio_id = $_POST['servicio']; 
        $desde = $_POST['desde']; 
        $hasta = $_POST['hasta']; 
        $desde.= " 00:00:00";
        $hasta.= " 23:59:59";
        $tecnicos = true;
        $clientes = true;
        $serviciosFiltro = true;

        $sql = "SELECT p.codigo, date_format(p.fecha, '%d-%m-%Y %r') as fecha,
        c.nombre as cliente, CONCAT(e.nombre, ' ', e.apellido) as empleado, ROUND(SUM(d.precio),2) as total, ROUND(SUM(d.precio*p.dolar),2) as totalBss, 
        COUNT(d.id) as servicios_cantidad,s.nombre as nombre_servicio
        FROM servicios_prestados p INNER JOIN clientes c ON p.cliente_id = c.id 
        INNER JOIN empleados e 
        ON p.empleado_id = e.id 
        INNER JOIN detalle_servicio d 
        ON d.servicio_prestado_id=p.id 
        INNER JOIN servicios s
        ON  d.servicio_id = s.id
        WHERE p.estatus = 'ACTIVO'";

        if($empleado != 0){
            $tecnicos = false;
            $sql .= " AND p.empleado_id = :empleado ";
            $tecnico = $this->empleado->getOne("empleados", $empleado);
        }
        if($cliente_id != 0){
            $clientes = false;
            $sql .= " AND p.cliente_id = :cliente ";
            $cliente = $this->cliente->getOne("clientes", $cliente_id);
        }
        if($servicio_id != 0){
            $serviciosFiltro = false;
            $sql .= " AND s.id = :servicio ";
            $servicio = $this->servicio->getOne("servicios", $servicio_id);
        }

        $sql .= " AND p.fecha BETWEEN :desde AND :hasta GROUP BY d.servicio_prestado_id ORDER BY p.fecha DESC";

        $query = $this->servicio->connect()->prepare($sql);

        if ($empleado != 0) {
            $query->bindParam(':empleado',$empleado);
        }
        if ($cliente_id != 0) {
            $query->bindParam(':cliente',$cliente_id);
        }
        if ($servicio_id != 0) {
            $query->bindParam(':servicio',$servicio_id);
        }

        $query->bindParam(':desde',$desde);
        $query->bindParam(':hasta',$hasta);
        $query->execute();
        $servicios = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($servicios as $s) {
            if ($s->servicios_cantidad>1) {
                $s->nombre_servicio = "VARIOS";
            }
        }
        ob_start();

        $output = array(
            'servicios' => $servicios,
            'desde' => $desde,
            'hasta' => $hasta,
            'dolar' => 1,
            'tecnicos' => $tecnicos,
            'clientes' => $clientes,
            'serviciosFiltro' => $serviciosFiltro,
            'cantidad' => 0,
            'total' => 0,
        );

        if (!$tecnicos) $output += ['tecnico' => $tecnico->nombre." ".$tecnico->apellido];
        if (!$clientes) $output += ['cliente' => $cliente->nombre." ".$cliente->apellido];
        if (!$serviciosFiltro) $output += ['servicio' => $servicio->nombre];

        View::getViewPDF('FormatosPDF.reporteServicio',$output);
        
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
        $producto_id = $_POST['producto'];
        $categorias = true;
        $productosFiltro = true;

        $sql = "SELECT * FROM v_inventario
        WHERE estatus = 'ACTIVO'";
        if($categoria_id != "TODOS"){
            $categorias = false;
            $sql .= " AND categoria = :categoria";
            $categoria = $categoria_id;
        }
        if($producto_id != "TODOS"){
            $productosFiltro = false;
            $sql .= " AND nombre = :producto ";
            $producto = $producto_id;
        }
        $sql .= " ORDER BY nombre";
        $query = $this->producto->connect()->prepare($sql);

        if ($categoria_id != "TODOS") {
            $query->bindParam(':categoria',$categoria_id);
        }
        if ($producto_id != "TODOS") {
            $query->bindParam(':producto',$producto_id);
        }

        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);

        $output = array(
            'productos' => $productos,
            'dolar' => 1,
            'categorias' => $categorias,
            'productosFiltro' => $productosFiltro,
            'cantidad' => 0,
            'total' => 0
        );

        if (!$categorias) $output += ['categoria' => $categoria];
        if (!$productosFiltro) $output += ['producto' => $producto];

        ob_start();
        View::getViewPDF('FormatosPDF.reporteProducto',$output);
        
        $html = ob_get_clean();

        $this->crearPDF($html);
       
    }
    
    public function reporteCompra()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }  
        $proveedor_id = $_POST['proveedor']; 
        $producto_id = $_POST['producto']; 
        $desde = $_POST['desde']; 
        $hasta = $_POST['hasta']; 
        $desde.= " 00:00:00";
        $hasta.= " 23:59:59";
        $tecnico = NULL;
        $proveedores = true;
        $productos = true;

        $sql = "SELECT c.codigo, date_format(c.fecha, '%d-%m-%Y %r') as fecha,
            c.impuesto, ROUND(SUM(d.costo*d.cantidad),2) as total, ROUND(SUM(d.costo*d.cantidad*c.dolar),2) as totalBss, p.razon_social as proveedor
            FROM compras c 
            INNER JOIN detalle_compra d 
            ON d.compra_id = c.id 
            INNER JOIN proveedores p 
            ON p.id = c.proveedor_id 
            WHERE c.estatus = 'ACTIVO'";

        if($proveedor_id != 0){
            $proveedores = false;
            $sql .= " AND c.proveedor_id = :proveedor";
            $proveedor = $this->proveedor->getOne("proveedores", $proveedor_id);
        }
        if($producto_id != 0){
            $productos = false;
            $sql .= " AND d.producto_id = :producto ";
            $producto = $this->producto->getOne("productos", $producto_id);
        }

        $sql .= " AND c.fecha BETWEEN :desde AND :hasta GROUP BY d.compra_id ORDER BY c.fecha DESC";

        $query = $this->compra->connect()->prepare($sql); 

        if ($proveedor_id != 0) {
            $query->bindParam(':proveedor',$proveedor_id);
        }
        if ($producto_id != 0) {
            $query->bindParam(':producto',$producto_id);
        }

        $query->bindParam(':desde',$desde);
        $query->bindParam(':hasta',$hasta);
        $query->execute();
        $compras = $query->fetchAll(PDO::FETCH_OBJ);

        $output = array(
            'compras' => $compras,
            'desde' => $desde,
            'hasta' => $hasta,
            'dolar' => 1,
            'proveedores' => $proveedores,
            'productos' => $productos,
            'cantidad' => 0,
            'total' => 0
        );

        if (!$proveedores) $output += ['proveedor' => $proveedor->razon_social];
        if (!$productos) $output += ['producto' => $producto->nombre];

        ob_start();
        View::getViewPDF('FormatosPDF.reporteCompra',$output);
        
        $html = ob_get_clean();

        $this->crearPDF($html);
       
    }
}