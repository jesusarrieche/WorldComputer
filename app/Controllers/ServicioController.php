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
      $this->servicio = new Servicio;
      $this->producto = new Producto;
      $this->proveedor = new Proveedor;
      $this->compra = new Compra;
      $this->cliente = new Cliente;
  }

  public function index(){
    session_start();
    return View::getView('Servicio.index');
  }

  public function create(){

    $num_documento = $this->compra->formatoDocumento($this->compra->ultimoDocumento());
    $proveedores = $this->proveedor->getAll('proveedores', "estatus = 'ACTIVO'");
    $clientes = $this->cliente->listar();
    $servicios = $this->servicio->listar();
    $productos = $this->producto->getAll('v_inventario', "estatus = 'ACTIVO'");

    return View::getView('Servicio.create', 
        [ 
            'productos' => $productos, 
            'proveedores' => $proveedores,
            'clientes' => $clientes,
            'servicios' => $servicios,
            'numeroDocumento' => $num_documento
        ]);
}

}
