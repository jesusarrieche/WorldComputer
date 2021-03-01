<?php

namespace App\Controllers;

use System\Core\Controller;
use System\Core\View;
use App\Models\Configuracion;
use App\Models\Usuario;
use App\Traits\Utility;

class LoginController extends Controller{
    
    use Utility;

    private $usuario;

    public function __construct(){
        $this->usuario = new Usuario();
    }

    public function index(){
        $config = new Configuracion;
        $nombre = $config->obtenerNombre_sistema();
        setcookie ('title',$nombre,time()+60*60*24*365);
       
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
            // Validación del Captcha
            if (!isset($_POST['token-r'])) {
                http_response_code(404); 
                echo "Captcha";
                return false;
            }
            $googleToken = $_POST['token-r'];
           
            $recaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response=".$googleToken); 
            $recaptcha = json_decode($recaptcha);

            $recaptcha = (array) $recaptcha;

            // var_dump($recaptcha);
            if(!isset($recaptcha['success']) || !$recaptcha['success'] || $recaptcha['score'] < 0.3)
            {
                // header('Content-Type: application/json');
                http_response_code(404); 
                // echo json_encode([
                //     'error' => 'true',
                //     'title' => 'Error!',
                //     'message' => 'Ocurrió un problema al validar el Captcha'
                // ]);
                echo "Captcha";
                return false;
            }
            // var_dump($response);
            // echo $response->documento;

            $_SESSION['usuario'] = $response->usuario;
            $_SESSION['id'] = $response->id;
            $_SESSION['rol'] = $response->rol_id;
            $this->usuario->setRolId($response->rol_id);
            $permisos = $this->usuario->obtenerPermisos($this->usuario);
            $_SESSION['permisos'] = $permisos;
            header('Content-Type: application/json');
            http_response_code(200);


            echo json_encode([
                'success' => true
            ]);
        
        } else {
            // header('Content-Type: application/json');
            http_response_code(404); 
            // echo json_encode([
            //     'error' => 'true',
            //     'title' => '¡Usuario o contraseña incorrecta!',
            //     'message' => 'Por favor verifique el usuario y la contraseña'
            // ]);
            echo "Usuario o Contraseña";
            return false;
        }
        
        

    }

    public function linkRecuperacion () {

        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }

        unset($_SESSION['RC']);

        $this->usuario->setEmail($this->limpiaCadena($_POST['email']));

        $response = $this->usuario->obtenerId($this->usuario);

        if ($response) {
            $token = bin2hex(random_bytes(10));

            $_SESSION['RC'] = array(
                'token' => $this->encriptar($token),
                'usuario_id' => $response->id
            );

            $output = array(
                'link' => URL.'Login/recuperarContrasena/'.$token
            );
            echo json_encode($output);
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Error al finalizar la Sesion',
                'response' => $response,
                'usuario' => $this->usuario->getEmail(),
            ]);
        }
    }

    public function recuperarContrasena ($param) {
        $config = new Configuracion;
        $nombre = $config->obtenerNombre_sistema();

        $token = $this->encriptar($param);

        if ($token == $_SESSION['RC']['token']) {
            $usuario_id = $_SESSION['RC']['usuario_id'];
            $usuario = $this->usuario->getOne('usuarios', $usuario_id);
            return View::getSingleView('Login.RecuperarContrasena', [
                'usuario' => $usuario
            ]);
        } else {
            header("Location: ".ROOT);
            return false;
        }
    }

    public function cambioContrasena () {
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }

        $this->usuario->setPassword($this->encriptar($this->limpiaCadena($_POST['password'])));
        $this->usuario->setUsuario($this->limpiaCadena($_POST['user']));
        $this->usuario->setId($this->limpiaCadena($_POST['usuario_id']));

        $response = $this->usuario->recuperarContrasena($this->usuario);

        unset($_SESSION['id']);

        if ($response) {

            unset($_SESSION['RC']);

            echo json_encode([
                'tipo' => 'success',
                'titulo' => 'Contraseña actualizada.',
                'mensaje' => 'La contraseña asociada a su cuenta ha sido actualizada.',
            ]);
        } else {
            echo json_encode([
                'tipo' => 'error',
                'titulo' => 'Contraseña no actualizada.',
                'mensaje' => 'Ha ocurrido un problema al actualizar su contraseña.',
                'response' => $response,
                'usuario' => $this->usuario
            ]);
        }
    }

    public function logout() {
        unset($_COOKIE['title']);
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