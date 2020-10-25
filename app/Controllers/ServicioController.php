<?php

namespace App\Controllers;

use App\Models\Servicio;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;


class ServicioController extends Controller{

  use Utility;

  private $servicio;

  public function __construct() {
      $this->servicio = new Servicio;
  }

  public function index(){
    session_start();
    return View::getView('Servicio.index');
  }

}
