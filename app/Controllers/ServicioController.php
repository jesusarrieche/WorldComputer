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
