<?php

namespace app\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;


class UsuarioController extends Controller{

    use Utility;
    
    private $usuario;
    private $rol;
    
    public function __construct() {
        $this->usuario = new Usuario;
        $this->rol = new Rol();
    }

    public function index(){

        $roles = $this->rol->listar();
        
        return View::getView('Usuario.index', 'roles', $roles);
    }

    public function listar(){

        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }

        $usuarios = $this->usuario->listar();

        foreach($usuarios as $usuario){

            $usuario->button = 
            "<a href='Usuario/mostrar/". $this->encriptar($usuario->id) ."' class='mostrar btn btn-info'><i class='fas fa-search'></i></a>".
            "<a href='Usuario/mostrar/". $this->encriptar($usuario->id) ."' class='editar btn btn-warning m-1'><i class='fas fa-pencil-alt'></i></a>".
            "<a href='". $this->encriptar($usuario->id) ."' class='eliminar btn btn-danger'><i class='fas fa-trash-alt'></i></a>";

        }

        http_response_code(200);

        echo json_encode([
        'data' => $usuarios
        ]);

    }

    public function guardar(){

        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }

        $contrasena = $this->encriptar(strtoupper($this->limpiaCadena($_POST['contrasena'])));

        $usuario = new Usuario();

        $usuario->setId($_POST['id']);
        $usuario->setTipoDocumento($_POST['inicial_documento']);
        $usuario->setDocumento($_POST['documento']);
        $usuario->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
        $usuario->setApellido(strtoupper($this->limpiaCadena($_POST['apellido'])));
        $usuario->setDireccion(strtoupper($this->limpiaCadena($_POST['direccion'])));
        $usuario->setTelefono(strtoupper($this->limpiaCadena($_POST['telefono'])));
        $usuario->setEmail(strtoupper($this->limpiaCadena($_POST['correo'])));
        $usuario->setEstatus("ACTIVO");
        $usuario->setUsuario(strtoupper($this->limpiaCadena($_POST['usuario'])));
        $usuario->setPassword($contrasena);
        $usuario->setRolId(strtoupper($this->limpiaCadena($_POST['rolUsuario'])));

        $documento = $usuario->getTipoDocumento()."-".$usuario->getDocumento();

        $consultaDocumento = $this->usuario->query("SELECT * FROM usuarios WHERE documento='$documento'" ); // Verifica inexistencia de cedula, sies igual a la actual no la toma en cuenta puesto que si registramos un cambio en el nombre se mantiene la misma cedula y afectaria la consulta.

        if ($consultaDocumento->rowCount() >= 1) {

        http_response_code(200);

        echo json_encode([
            'titulo' => 'Documento Registrado',
            'mensaje' => $documento . ' Se encuentra registrado en nuestro sistema',
            'tipo' => 'error'
        ]);

        return false;

        } else {

            if($this->usuario->registrar($usuario)) {
                http_response_code(200);

                echo json_encode([
                'titulo' => 'Registro Exitoso',
                'mensaje' => 'Usuario registrado en nuestro sistema',
                'tipo' => 'success'
                ]);    
            } else{

                echo json_encode([
                'titulo' => 'Error',
                'mensaje' => $this->usuario->getError(),
                'tipo' => 'error'
                ]);  
            }
        }


    }

    public function actualizar(){

        $usuario = new Usuario();

        $usuario->setId($_POST['id']);
        $usuario->setTipoDocumento($_POST['inicial_documento']);
        $usuario->setDocumento($_POST['documento']);
        $usuario->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
        $usuario->setApellido(strtoupper($this->limpiaCadena($_POST['apellido'])));
        $usuario->setDireccion(strtoupper($this->limpiaCadena($_POST['direccion'])));
        $usuario->setTelefono(strtoupper($this->limpiaCadena($_POST['telefono'])));
        $usuario->setEmail(strtoupper($this->limpiaCadena($_POST['correo'])));
        $usuario->setUsuario(strtoupper($this->limpiaCadena($_POST['usuario'])));
        $usuario->setEstatus("ACTIVO");

        if($this->usuario->actualizar($usuario)){
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

    public function mostrar($param){
    
    $param = $this->desencriptar($param);

    $usuario = $this->usuario->getOne('usuarios', $param);

    http_response_code(200);

    echo json_encode([
    'data' => $usuario
    ]);
    }

    public function eliminar($id){
        
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'DELETE'){
        http_response_code(404);
        return false;
        }
        $id = $this->desencriptar($id);

        
        if($this->usuario->eliminar("usuarios", $id)){

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
