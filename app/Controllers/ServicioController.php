<?php

namespace App\Controllers;

use App\Models\Servicio;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Venta;

use App\Models\Producto;

use App\Models\Compra;
use App\Models\Entrada;
use App\Models\Proveedor;

use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;

class ServicioController extends Controller{

  use Utility;

  private $servicio;

  public function __construct() {
      $this->cliente = new Cliente;
      $this->servicio = new Servicio;
      $this->empleado = new Empleado;
      $this->venta = new Venta;
  }

  public function index(){
    return View::getView('Servicio.index');
  }

  public function listar(){

    $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
        http_response_code(404);
        return false;
        }

        $servicios = $this->servicio->listar();

        foreach($servicios as $servicio){

        $servicio->button = 
        "<a href='/WorldComputer/Servicio/mostrar/". $this->encriptar($servicio->id) ."' class='mostrar btn btn-info'><i class='fas fa-search'></i></a>".
        "<a href='/WorldComputer/Servicio/mostrar/". $this->encriptar($servicio->id) ."' class='editar btn btn-warning m-1'><i class='fas fa-pencil-alt'></i></a>".
        "<a href='". $this->encriptar($servicio->id) ."' class='eliminar btn btn-danger'><i class='fas fa-trash-alt'></i></a>";

    }

    http_response_code(200);

    echo json_encode([
    'data' => $servicios
    ]);

}

  public function ProvidedServices () {

    $empleados = $this->empleado->listarCargo('TECNICO');
    $ventas = $this->venta->listar();
    $servicios = $this->servicio->listar();

    return View::getView('Servicio.providedServices');
  }

  public function listarPrestados(){

    $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
        http_response_code(404);
        return false;
        }

        $servicios = $this->servicio->listarPrestados();

        foreach($servicios as $servicio){

        $servicio->button = 
                "<a href='/WorldComputer/Servicio/mostrarPrestado/". $this->encriptar($servicio->id) ."' class='mostrar btn btn-info'><i class='fas fa-search'></i></a>".
                "<a href='/WorldComputer/Servicio/servicioPrestadoPDF/". $this->encriptar($servicio->id) ."' class='pdf btn btn-danger m-1'><i class='fas fa-file-pdf'></i></a>";

    }

    http_response_code(200);

    echo json_encode([
    'data' => $servicios
    ]);

}

  public function create(){

    $clientes = $this->cliente->listar();
    $servicios = $this->servicio->listar();
    $empleados = $this->empleado->listarCargo('TECNICO');

    return View::getView('Servicio.create', 
        [ 
            'clientes' => $clientes,
            'servicios' => $servicios,
            'empleados' => $empleados,
        ]);
  }

  /**
    CRUD
  ***/

    public function agregar(){

      #=== VENTA ===#
      
      $venta = new Venta;

      $num_documento = $this->venta->formatoDocumento($this->venta->ultimoDocumento());

      $venta->setNumeroDocumento($num_documento);
      $venta->setPersonaId($_POST['cliente']);

      $lastId = $venta->registrar($venta);

      #=== DETALLES SERVICIO ===#

      $servicioData = [
        'cantidad' => 1,
        'precio' => $_POST['precioServicio'],
        'empleado_id' => $_POST['empleado'],
        'venta_id' => $lastId,
        'servicio_id' => $_POST['servicio']
      ];
    
      $detalleServicio = $this->servicio->añadirDetalles($servicioData);

      $mensaje = 'Se ha registrado venta: '. $lastId . ' y servicio: '. $detalleServicio;

      http_response_code(200);

      echo json_encode([
        'titulo' => 'Venta Registrada!',
        'mensaje' => $mensaje,
        'tipo' => 'success'
      ]);
    }

    public function mostrarPrestado($param){
    
      $param = $this->desencriptar($param);

      $servicio = $this->servicio->getOne('detalle_servicio', $param);

      http_response_code(200);

      echo json_encode([
      'data' => $servicio
      ]);
    }

    public function mostrar($param){
    
      $param = $this->desencriptar($param);

      $servicio = $this->servicio->getOne('servicios', $param);

      http_response_code(200);

      echo json_encode([
      'data' => $servicio
      ]);
    }


    public function eliminar($id){
    
      $method = $_SERVER['REQUEST_METHOD'];

      if( $method != 'DELETE'){
      http_response_code(404);
      return false;
      }
      $id = $this->desencriptar($id);

      
      if($this->servicio->eliminar("servicios", $id)){

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
