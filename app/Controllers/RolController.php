<?php

namespace App\Controllers;

use App\Models\Rol;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;

class RolController extends Controller {

	private $rol;
	
	use Utility;

	public function __construct(){
		$this->rol = new Rol;
    }
    
    public function index(){
        return View::getView('Rol.index');
    }

	public function listar(){

        $roles = $this->rol->listar();
        
        $cont = 1;
        foreach($roles AS $rol){

            $rol->numero = $cont;
            $rol->button = 
            "<a href='rol/mostrar/". $this->encriptar($rol->id) ."' class='mostrar btn btn-info'><i class='fas fa-search'></i></a>".
            "<a href='rol/mostrar/". $this->encriptar($rol->id) ."' class='editar btn btn-warning m-1'><i class='fas fa-pencil-alt'></i></a>".
            "<a href='". $this->encriptar($rol->id) ."' class='eliminar btn btn-danger'><i class='fas fa-trash-alt'></i></a>";

            $cont++;
        }

		echo json_encode([
			'data' => $roles
		]);

		exit();
		
    }
    public function guardar()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }

        $rol = new Rol();
        $rol->setNombre($_POST['nombre']);
        $rol->setDescripcion($_POST['descripcion']);
        $rol->setPermisos($_POST['permisos']);
        if($this->rol->registrar($rol)) {
            http_response_code(200);

            echo json_encode([
            'titulo' => 'Registro Exitoso',
            'mensaje' => 'Rol registrado en nuestro sistema',
            'tipo' => 'success'
            ]);    
        } else{

            echo json_encode([
            'titulo' => 'Error',
            'mensaje' => $this->rol->getError(),
            'tipo' => 'error'
            ]);  
        }
    }
    public function mostrar($param){
    
        $param = $this->desencriptar($param);
    
        $rol = $this->rol->mostrar($param);
    
        http_response_code(200);
    
        echo json_encode([
            'data' => $rol
        ]);
    }

    public function actualizar(){

        $rol = new rol();

        $rol->setId($_POST['id']);
        $rol->setNombre($_POST['nombre']);
        $rol->setDescripcion($_POST['descripcion']);
        $rol->setPermisos($_POST['permisos']);

        if($this->rol->actualizar($rol)){
        http_response_code(200);

        echo json_encode([
            'titulo' => 'Actualizacion Exitosa',
            'mensaje' => 'Registro actualizado en nuestro sistema',
            'tipo' => 'success'
        ]);
        }else{
        http_response_code(404);

        echo json_encode([
            'titulo' => 'Error',
            'mensaje' => $this->usuario->getError(),
            'tipo' => 'error'
        ]);  
        }

    }

    public function eliminar($id){
        
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'DELETE'){
        http_response_code(404);
        return false;
        }
        $id = $this->desencriptar($id);

        
        if($this->rol->eliminar("roles", $id)){

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