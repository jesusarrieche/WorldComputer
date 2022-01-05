<?php

namespace App\Controllers;

use System\Core\Controller;
use System\Core\View;
use App\Models\Configuracion;
use App\Models\Usuario;
use App\Traits\Utility;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';


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
        $response = $this->usuario->checkUser($this->usuario);
        
        if($response) {
            if($response->estatus != 'ACTIVO'){
                echo json_encode([
                    'titulo' => '¡Usuario Bloqueado!',
                    'mensaje' => 'El Usuario se encuentra bloqueado',
                    'tipo' => 'error',
                ]);
                return false;
            }
            if(!$this->verificarContrasena($this->limpiaCadena($_POST['password']),$response->password)){
                $id = $response->id;
                $usuario = $response->usuario;
                if(isset($_SESSION['sesion_fallos_iniciar_tiempo'])){
                    $tiempo = time();
                    $tiempo_transcurrido = $tiempo - $_SESSION['sesion_fallos_iniciar_tiempo'];
                    $tiempo_limite = 60 * 60 * 12;
                    if($tiempo_transcurrido > $tiempo_limite){
                        $_SESSION['sesion_fallos_iniciar'] = null;
                    }
                }
                if(isset($_SESSION['sesion_fallos_iniciar']["$usuario"])){
                    $_SESSION['sesion_fallos_iniciar']["$usuario"] += 1;
                }
                else{
                    $_SESSION['sesion_fallos_iniciar']["$usuario"] = 1;
                    $_SESSION['sesion_fallos_iniciar_tiempo'] = time();
                }
                $fallos = $_SESSION['sesion_fallos_iniciar']["$usuario"];
                if($fallos >= 3){
                    session_destroy();
                    $this->usuario->eliminar('usuarios', $id);
                    $mensaje = "La Contraseña ingresada es incorrecta. El Usuario ha sido bloqueado";
                }
                else{
                    $mensaje = "La Contraseña ingresada es incorrecta. Intento fallido número $fallos. Al tercer intento fallido se bloqueará su Usuario";
                }
                echo json_encode([
                    'titulo' => '¡Contraseña incorrecta!',
                    'mensaje' => $mensaje,
                    'tipo' => 'error',
                    'fallos' => $fallos
                ]);
                return false;
            }
            // Validación del Captcha
            // if (!isset($_POST['token-r'])) {
            //     echo json_encode([
            //         'titulo' => '¡Error!',
            //         'mensaje' => 'Ocurrió un problema al validar el Captcha',
            //         'tipo' => 'error',
            //     ]);
            //     return false;
            // }
            // $googleToken = $_POST['token-r'];
            // $recaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response=".$googleToken); 
            // $recaptcha = json_decode($recaptcha);
            // $recaptcha = (array) $recaptcha;
            // if(!isset($recaptcha['success']) || !$recaptcha['success'] || $recaptcha['score'] < 0.3)
            // {
            //     echo json_encode([
            //         'titulo' => '¡Error!',
            //         'mensaje' => 'Ocurrió un problema al validar el Captcha',
            //         'tipo' => 'error',
            //     ]);
            //     return false;
            // }

            $_SESSION['usuario'] = $response->usuario;
            $_SESSION['id'] = $response->id;
            $_SESSION['rol'] = $response->rol_id;
            $_SESSION['sesion_autenticada'] = false;
            $_SESSION['sesion_fallos_autenticacion'] = 0;
            $this->usuario->setRolId($response->rol_id);
            $permisos = $this->usuario->obtenerPermisos($this->usuario);
            $_SESSION['permisos'] = $permisos;
            http_response_code(200);
            echo json_encode([
                'tipo' => 'success', 'mensaje' => 'Sesión Iniciada'
            ]);        
        } else {
            echo json_encode([
                'titulo' => '¡Usuario incorrecto!',
                'mensaje' => 'Por favor verifique el usuario',
                'tipo' => 'error',
            ]);
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
            $usuario = $this->usuario->getOne('usuarios', $response->id);

            $token = bin2hex(random_bytes(10));

            $_SESSION['RC'] = array(
                'token' => $this->encriptar($token),
                'usuario_id' => $response->id
            );
            $link = URL.'Login/recuperarContrasena/'.$token;
            $output = array(
                'link' => URL.'Login/recuperarContrasena/'.$token
            );
            require 'vendor/autoload.php';

            //Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'hector.noguera03@gmail.com';                     //SMTP username
                $mail->Password   = '';                               //SMTP password
                $mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;   //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->CharSet = 'UTF-8';                              
            
                //Recipients
                $mail->setFrom($mail->Username, 'World & Computer');
                $mail->addAddress($usuario->email, $usuario->nombre." ".$usuario->apellido);     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                $mail->addReplyTo($mail->Username, 'Información');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');
            
                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
            
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Recuperación de Acceso - World & Computer';
                $mail->Body    = '<h2>¿Recuperar Acceso?</h2><br>
                        Si solicitaste un restablecimiento de contraseña para tu usuario "'.$usuario->usuario.'" del sistema World & Computer, usa el link que aparece a 
                        continuación para completar el proceso. Si no solicitaste esto, puedes ignorar este correo electrónico. <br>
                        '.$link;
                $mail->AltBody    = '¿Recuperar Acceso? 
                        Si solicitaste un restablecimiento de contraseña para tu usuario "'.$usuario->usuario.'" del sistema World & Computer, usa el link que aparece a 
                        continuación para completar el proceso. Si no solicitaste esto, puedes ignorar este correo electrónico.  
                        '.$link;
                
            
                $mail->send();
                // echo 'Message has been sent';
                echo json_encode([
                    'error' => false,
                    'message' => 'Enlace de recuperación enviado al correo '.$usuario->email,
                ]);
            } catch (Exception $e) {
                // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                echo json_encode([
                    'error' => true,
                    'message' => 'No se pudo enviar el correo. Lo sentimos! Intente de nuevo.',
                ]);
            }
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Correo no registrado.',
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