<?php

namespace App\Controllers;

use App\Models\Servicio;
use App\Models\Cliente;
use App\Models\Empleado;

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
  }

  public function index(){
    session_start();
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
        "<a href='/WorldComputer/servicio/mostrar/". $this->encriptar($servicio->id) ."' class='mostrar btn btn-info'><i class='fas fa-search'></i></a>".
        "<a href='/WorldComputer/servicio/mostrar/". $this->encriptar($servicio->id) ."' class='editar btn btn-warning m-1'><i class='fas fa-pencil-alt'></i></a>".
        "<a href='". $this->encriptar($servicio->id) ."' class='eliminar btn btn-danger'><i class='fas fa-trash-alt'></i></a>";

    }

    http_response_code(200);

    echo json_encode([
    'data' => $servicios
    ]);

}

  public function ProvidedServices () {
    return View::getView('Servicio.providedServices');
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

}
