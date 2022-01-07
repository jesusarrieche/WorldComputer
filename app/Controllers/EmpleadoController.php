<?php

namespace App\Controllers;

use App\Models\Empleado;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;


class EmpleadoController extends Controller{

  use Utility;

  private $empleado;

  public function __construct() {
      $this->empleado = new Empleado;
  }

  public function index(){
    $band = false;
    foreach ($_SESSION['permisos'] as $p):
        if ($p->permiso == "Empleados") {     
        $band = true;
    }endforeach;   
    if (!$band) {
        header("Location: ".ROOT);
        return false;
    }
    return View::getView('Empleado.index');
  }
  
  public function listar(){

    $method = $_SERVER['REQUEST_METHOD'];

    if( $method != 'POST'){
      http_response_code(404);
      return false;
    }

    $empleados = $this->empleado->listar();

    $editar = false;
    $eliminar = false;
    foreach ($_SESSION['permisos'] as $p):
        if ($p->permiso == "Editar Empleados") {     
        $editar = true;
    }endforeach;
    foreach ($_SESSION['permisos'] as $p):
        if ($p->permiso == "Eliminar Empleados") {     
        $eliminar = true;
    }endforeach;
    foreach($empleados as $empleado){
      $empleado->documento = $this->desencriptar($empleado->documento);
      $empleado->telefono = $this->desencriptar($empleado->telefono);
      $empleado->button = 
      "<a href=".ROOT."empleado/mostrar/". $this->encriptar($empleado->id) ."' class='mostrar btn btn-info mr-1 mb-1' title='Consultar'><i class='fas fa-search'></i></a>";
      if ($editar) {
          $empleado->button .= "<a href=".ROOT."empleado/mostrar/". $this->encriptar($empleado->id) ."' class='editar btn btn-warning mr-1 mb-1' title='Editar'><i class='fas fa-pencil-alt'></i></a>";
      }
      if ($eliminar) {
          if($empleado->estatus == "ACTIVO"){
              $empleado->button .= "<a href='". $this->encriptar($empleado->id) ."' class='eliminar btn btn-danger mr-1 mb-1' title='Eliminar'><i class='fas fa-trash-alt'></i></a>";
          }
          else{
              $empleado->button .= "<a href='". $this->encriptar($empleado->id) ."' class='estatusAnulado btn btn-outline-info mr-1 mb-1' title='Activar'><i class='fas fa-trash'></i></a>";
          }
      }
    }

    http_response_code(200);

    echo json_encode([
      'data' => $empleados
    ]);

  }

  public function guardar(){

    $method = $_SERVER['REQUEST_METHOD'];

    if( $method != 'POST'){
      http_response_code(404);
      return false;
    }

    $empleado = new Empleado();

    $empleado->setId($_POST['id']);
    $empleado->setDocumento($this->encriptar($this->limpiaCadena($_POST['inicial_documento'].'-'.$_POST['documento'])));
    $empleado->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
    $empleado->setApellido(strtoupper($this->limpiaCadena($_POST['apellido'])));
    $empleado->setDireccion($this->encriptar(strtoupper($this->limpiaCadena($_POST['direccion']))));
    $empleado->setTelefono($this->encriptar(strtoupper($this->limpiaCadena($_POST['telefono']))));
    $empleado->setEmail($this->encriptar(strtoupper($this->limpiaCadena($_POST['correo']))));
    $empleado->setCargo(strtoupper($this->limpiaCadena($_POST['cargo'])));
    $empleado->setEstatus("ACTIVO");

    $documento = $empleado->getDocumento();
    $consultaDocumento = $this->empleado->query("SELECT * FROM empleados WHERE documento='$documento'" ); // Verifica inexistencia de cedula, sies igual a la actual no la toma en cuenta puesto que si registramos un cambio en el nombre se mantiene la misma cedula y afectaria la consulta.

    if ($consultaDocumento->rowCount() >= 1) {
      $documento = $this->desencriptar($documento);
      http_response_code(200);
      echo json_encode([
        'titulo' => 'Documento Registrado',
        'mensaje' => $documento . ' Se encuentra registrado en nuestro sistema',
        'tipo' => 'error'
      ]);

      return false;

    }

    if($this->empleado->registrar($empleado))
    {
      http_response_code(200);

      echo json_encode([
        'titulo' => 'Registro Exitoso',
        'mensaje' => 'Empleado registrado en nuestro sistema',
        'tipo' => 'success'
      ]);
    }
    else{
      echo json_encode([
        'titulo' => 'Error',
        'mensaje' => $this->empleado->getError(),
        'tipo' => 'error'
        ]);  
    }

  }

  public function actualizar(){

    $empleado = new Empleado();

    $empleado->setId($_POST['id']);
    $empleado->setDocumento($this->encriptar($this->limpiaCadena($_POST['inicial_documento'].'-'.$_POST['documento'])));
    $empleado->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
    $empleado->setApellido(strtoupper($this->limpiaCadena($_POST['apellido'])));
    $empleado->setDireccion($this->encriptar(strtoupper($this->limpiaCadena($_POST['direccion']))));
    $empleado->setTelefono($this->encriptar(strtoupper($this->limpiaCadena($_POST['telefono']))));
    $empleado->setEmail($this->encriptar(strtoupper($this->limpiaCadena($_POST['correo']))));
    $empleado->setCargo(strtoupper($this->limpiaCadena($_POST['cargo'])));
    $empleado->setEstatus("ACTIVO");

    if($this->empleado->actualizar($empleado)){
      http_response_code(200);

      echo json_encode([
        'titulo' => 'Actualización Exitosa',
        'mensaje' => 'Registro actualizado en nuestro sistema',
        'tipo' => 'success'
      ]);
    }else{

      echo json_encode([
        'titulo' => 'Error al Actualizar',
        'mensaje' => $this->empleado->getError(),
        'tipo' => 'error'
      ]);
    }

  }

  public function mostrar($param){

    $param = $this->desencriptar($param);
    
    $empleado = $this->empleado->getOne('empleados', $param);
    $empleado->documento = $this->desencriptar($empleado->documento);
    $empleado->direccion = $this->desencriptar($empleado->direccion);
    $empleado->telefono = $this->desencriptar($empleado->telefono);
    $empleado->email = $this->desencriptar($empleado->email);
    http_response_code(200);

    echo json_encode([
      'data' => $empleado
    ]);
  }

  public function eliminar($id){

    $method = $_SERVER['REQUEST_METHOD'];

    if( $method != 'POST'){
      http_response_code(404);
      return false;
    }

    $id = $this->desencriptar($id);

    if($this->empleado->eliminar("empleados", $id)){

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

    if($this->empleado->habilitar("empleados", $id)){

      http_response_code(200);

      echo json_encode([
        'titulo' => 'Registro habilitado!',
        'mensaje' => 'Registro habilitado en nuestro sistema',
        'tipo' => 'success'
      ]);
    }else{
      http_response_code(404);

      echo json_encode([
        'titulo' => 'Ocurio un error!',
        'mensaje' => 'No se pudo habilitar el registro',
        'tipo' => 'error'
      ]);
    }
    

}

}
