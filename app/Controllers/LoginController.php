<?php

namespace App\Controllers;

use System\Core\Controller;
use System\Core\View;
use App\Models\Usuario;
use App\Traits\Utility;

class LoginController extends Controller{
    
    use Utility;

    private $usuario;

    public function __construct(){
        $this->usuario = new Usuario();
    }

    public function index(){
        return View::getSingleView('Login.Login');
    }

    
    /**
     * SECURITY
     */

    public function login() {

        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }


        $this->usuario->setUsuario($this->limpiaCadena($_POST['user']));
        $this->usuario->setPassword($this->encriptar($this->limpiaCadena($_POST['password'])));
        
        
        $response = $this->usuario->checkUser($this->usuario);
        
        if($response) {

            // var_dump($response);
            // echo $response->documento;

            $_SESSION['usuario'] = $response->usuario;
            $_SESSION['id'] = $response->id;
            $_SESSION['rol'] = $response->rol_id;

            header('Content-Type: application/json');
            http_response_code(200);


            echo json_encode([
                'data' => $response
            ]);
        
        } else {
            header('Content-Type: application/json');
            http_response_code(404); 
            echo json_encode([
                'error' => 'true',
                'message' => 'Usuario o contraseña incorrecto'
            ]);
        }
        
        

    }

    public function logout() {

        if (session_destroy()) {

            http_response_code(200);
            header('Content-Type: application/json');

            echo json_encode([
                'message' => 'Sesion finalizada'
            ]);

        } else {

            http_response_code(404);
            header('Content-Type: application/json');

            echo json_encode([
                'error' => true,
                'message' => 'Error al finalizar la Sesion'
            ]);
        }

    }
}