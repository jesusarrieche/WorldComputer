<?php

namespace app\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
// use App\Models\Asistencia;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;


class UsuarioController extends Controller{

    use Utility;
    
    private $usuario;
    private $rol;
    // private $asistencia;
    
    public function __construct() {
        
        $this->usuario = new Usuario;
        $this->rol = new Rol();
    }

    public function index(){
        $band = false;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Usuarios") {     
            $band = true;
        }endforeach;   
        if (!$band) {
            header("Location: ".ROOT);
            return false;
        }
        $roles = $this->rol->listar();
        $seguridad_imgs = [
            'seguridad_img_0_.png', 'seguridad_img_1_.png', 'seguridad_img_2_.png', 'seguridad_img_3_.png'
        ];
        return View::getView('Usuario.index', [
            'roles' => $roles,
            'seguridad_imgs' => $seguridad_imgs
        ]);
    }

    public function listar(){

        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }

        $usuarios = $this->usuario->listar();
        $editar = false;
        $eliminar = false;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Editar Usuarios") {     
            $editar = true;
        }endforeach;
        foreach ($_SESSION['permisos'] as $p):
            if ($p->permiso == "Eliminar Usuarios") {     
            $eliminar = true;
        }endforeach;
        foreach($usuarios as $usuario){
            $usuario->documento = $this->desencriptar($usuario->documento);
            $usuario->button = 
            "<a href=".ROOT."usuario/mostrar/". $this->encriptar($usuario->id) ."' class='mostrar btn btn-info mr-1 mb-1' title='Consultar'><i class='fas fa-search'></i></a>";
            if ($editar && $usuario->id != 1) {
                $usuario->button .= "<a href=".ROOT."usuario/mostrar/". $this->encriptar($usuario->id) ."' class='editar btn btn-warning mr-1 mb-1' title='Editar'><i class='fas fa-pencil-alt'></i></a>";
            }
            if ($eliminar && $usuario->id != 1) {
                if($usuario->estatus == "ACTIVO"){
                    $usuario->button .= "<a href='". $this->encriptar($usuario->id) ."' class='eliminar btn btn-danger mr-1 mb-1' title='Eliminar'><i class='fas fa-trash-alt'></i></a>";
                }
                else{
                    $usuario->button .= "<a href='". $this->encriptar($usuario->id) ."' class='estatusAnulado btn btn-outline-info mr-1 mb-1' title='Activar'><i class='fas fa-trash'></i></a>";
                }
            }
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

        $contrasena = $this->encriptarContrasena($this->limpiaCadena($_POST['contrasena']));
     
        $usuario = new Usuario();

        $usuario->setId($_POST['id']);
        $usuario->setDocumento($this->encriptar($this->limpiaCadena($_POST['inicial_documento'].'-'.$_POST['documento'])));
        $usuario->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
        $usuario->setApellido(strtoupper($this->limpiaCadena($_POST['apellido'])));
        $usuario->setDireccion($this->encriptar(strtoupper($this->limpiaCadena($_POST['direccion']))));
        $usuario->setTelefono($this->encriptar(strtoupper($this->limpiaCadena($_POST['telefono']))));
        $usuario->setEmail($this->encriptar(strtoupper($this->limpiaCadena($_POST['correo']))));
        $usuario->setEstatus("ACTIVO");
        $usuario->setUsuario(strtoupper($this->limpiaCadena($_POST['usuario'])));
        $usuario->setPassword($contrasena);
        $usuario->setSeguridad_img($this->decifrarImagen($this->limpiaCadena($_POST['seguridad_img'])));
        $usuario->setSeguridad_pregunta($this->limpiaCadena($_POST['seguridad_pregunta']));
        $usuario->setSeguridad_respuesta($this->encriptar($this->limpiaCadena($_POST['seguridad_respuesta'])));
        $usuario->setRolId(strtoupper($this->limpiaCadena($_POST['rolUsuario'])));

        $documento = $usuario->getDocumento();
        $consultaDocumento = $this->usuario->query("SELECT * FROM usuarios WHERE documento='$documento'" ); // Verifica inexistencia de cedula, si es igual a la actual no la toma en cuenta puesto que si registramos un cambio en el nombre se mantiene la misma cedula y afectaria la consulta.

        if ($consultaDocumento->rowCount() >= 1) {
            http_response_code(200);
            echo json_encode([
                'titulo' => 'Documento Registrado',
                'mensaje' => $this->desencriptar($documento) . ' Se encuentra registrado en nuestro sistema',
                'tipo' => 'error'
            ]);
            return false;

        } else {

            if($this->usuario->registrar($usuario)) {
                http_response_code(200);

                echo json_encode([
                'titulo' => 'Registro Exitoso',
                'mensaje' => 'Cliente registrado en nuestro sistema',
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
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }
        $usuario = new Usuario();
        
        $usuario->setId($_POST['id']);
        $usuario->setDocumento($this->encriptar($this->limpiaCadena($_POST['inicial_documento'].'-'.$_POST['documento'])));
        $usuario->setNombre(strtoupper($this->limpiaCadena($_POST['nombre'])));
        $usuario->setApellido(strtoupper($this->limpiaCadena($_POST['apellido'])));
        $usuario->setDireccion($this->encriptar(strtoupper($this->limpiaCadena($_POST['direccion']))));
        $usuario->setTelefono($this->encriptar(strtoupper($this->limpiaCadena($_POST['telefono']))));
        $usuario->setEmail($this->encriptar(strtoupper($this->limpiaCadena($_POST['correo']))));
        $usuario->setUsuario(strtoupper($this->limpiaCadena($_POST['usuario'])));
        $usuario->setEstatus("ACTIVO");
        if ($_POST['contrasena']!="") {
            $contrasena = $this->encriptarContrasena($this->limpiaCadena($_POST['contrasena']));
            $usuario->setPassword($contrasena);
        }
        if ($_POST['seguridad_img']!="") {
            $usuario->setSeguridad_img($this->decifrarImagen($this->limpiaCadena($_POST['seguridad_img'])));
        }
        $usuario->setSeguridad_pregunta($this->limpiaCadena($_POST['seguridad_pregunta']));
        if ($_POST['seguridad_respuesta']!="") {
            $usuario->setSeguridad_respuesta($this->encriptar($this->limpiaCadena($_POST['seguridad_respuesta'])));
        }
        if(isset($_POST['rolUsuario']) && $_POST['rolUsuario']!=""){
            $usuario->setRolId(strtoupper($this->limpiaCadena($_POST['rolUsuario'])));
        }
        else{
            $usuario->setRolId(strtoupper($this->limpiaCadena($_POST['rolUsuarioN'])));
        }
        if (isset($_POST['perfil']) && $_POST['perfil']!="") {
            if ($usuario->getId()==1 && $usuario->getRolId()!=1) {
                http_response_code(200);
                echo json_encode([
                    'titulo' => 'Alerta',
                    'mensaje' => 'Este usuario no puede perder el rol de "Super Administrador"',
                    'tipo' => 'error'
                ]);
                return false;
            }
        }
        
        if ($usuario->getRolId()!="1") {
            $admin = $this->usuario->query("SELECT id FROM usuarios WHERE rol_id=1 AND estatus='ACTIVO'")->rowCount();
            if($admin == 1){
                $usu = $this->usuario->getOne("usuarios",$usuario->getId());
                if($usu->rol_id=="1"){
                    echo json_encode([
                        'titulo' => 'Ocurrió un error',
                        'mensaje' => "El Sistema debe tener como mínimo un usuario de tipo Super Administrador",
                        'tipo' => 'error'
                    ]);
                    return false;
                } 
            }
        }
        if($this->usuario->actualizar($usuario)){
            if (isset($_POST['perfil']) && $_POST['perfil']!="") {
                $_SESSION['usuario'] = $usuario->getUsuario();
                $_SESSION['id'] = $usuario->getId();
                $_SESSION['rol'] = $usuario->getRolId();
                $this->usuario->setRolId($usuario->getRolId());
                $permisos = $this->usuario->obtenerPermisos($this->usuario);
                $_SESSION['permisos'] = $permisos;
            }
            http_response_code(200);

            echo json_encode([
                'titulo' => 'Actualización Exitosa',
                'mensaje' => 'Registro actualizado en nuestro sistema',
                'tipo' => 'success'
            ]);
        }else{

            echo json_encode([
                'titulo' => 'Error al Actualizar',
                'mensaje' => $this->usuario->getError(),
                'tipo' => 'error'
            ]);
        }

    }

    public function mostrar($param){
    
        $param = $this->desencriptar($param);

        $usuario = $this->usuario->getOne('usuarios', $param);
        $usuario->documento = $this->desencriptar($usuario->documento);
        $usuario->direccion = $this->desencriptar($usuario->direccion);
        $usuario->telefono = $this->desencriptar($usuario->telefono);
        $usuario->email = $this->desencriptar($usuario->email);
        http_response_code(200);
        echo json_encode([
            'data' => $usuario
        ]);
    }

    public function eliminar($id){
        
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
        http_response_code(404);
        return false;
        }
        $id = $this->desencriptar($id);
        
        $usu = $this->usuario->getOne("usuarios",$id);
       
        if ($usu->rol_id=="1") {
            $admin = $this->usuario->query("SELECT id FROM usuarios WHERE rol_id=1 AND estatus='ACTIVO'")->rowCount();
            if($admin == 1){
                echo json_encode([
                    'titulo' => 'Ocurrió un error',
                    'mensaje' => "El Sistema debe tener como mínimo un usuario de tipo Super Administrador",
                    'tipo' => 'error'
                ]);
                return false;
            }
        }
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
                'titulo' => 'Ocurrió un error!',
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
    
        if($this->usuario->habilitar("usuarios", $id)){
    
          http_response_code(200);
    
          echo json_encode([
            'titulo' => 'Registro habilitado!',
            'mensaje' => 'Registro habilitado en nuestro sistema',
            'tipo' => 'success'
          ]);
        }else{
          http_response_code(404);
    
          echo json_encode([
            'titulo' => 'Ocurrió un error!',
            'mensaje' => 'No se pudo habilitar el registro',
            'tipo' => 'error'
          ]);
        }
    }

    public function autenticar(){
        $method = $_SERVER['REQUEST_METHOD'];
        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }
        $usuario = new Usuario;
        $usuario->setSeguridad_img($this->decifrarImagen($this->limpiaCadena($_POST['seguridad_img'])));
        $usuario->setSeguridad_respuesta($this->encriptar($this->limpiaCadena($_POST['seguridad_respuesta'])));
        $usu = $this->usuario->autenticar($usuario);
        if(isset($usu->id)) {
            $_SESSION['sesion_autenticada'] = true;
            http_response_code(200);
            echo json_encode([
            'titulo' => 'Éxito',
            'mensaje' => 'Tu Usuario ha sido autenticado',
            'tipo' => 'success'
            ]);    
        } else{

            echo json_encode([
            'titulo' => 'Error',
            'mensaje' => 'Tienes un intento más, si fallas otra vez se cerrará la sesión',
            'tipo' => 'error'
            ]);  
        }
    }

    public function getSesionAutenticada(){
        $method = $_SERVER['REQUEST_METHOD'];
        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }
        // echo $_SESSION['sesion_autenticada'];
        echo json_encode([
            'titulo' => 'Éxito',
            'mensaje' => $_SESSION['sesion_autenticada'],
            'tipo' => 'success'
        ]);
    }
    public function getSeguridadPregunta(){
        $method = $_SERVER['REQUEST_METHOD'];
        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }
        $usuario = new Usuario;
        $usu = $usuario->obtenerSeguridadPregunta();
        echo json_encode([
            'titulo' => 'Éxito',
            'mensaje' => $usu->seguridad_pregunta,
            'tipo' => 'success'
        ]);
    }

    private function cifrar(){
        $img = "seguridad_img_0.png";
        $mensaje = $this->encriptar("Laptops");
        $res = $this->cifrarEnImagen($mensaje, $img);
        echo $res;
    }
    
    private function decifrar(){
        $img = "seguridad_img_0_.png";
        $res = $this->decifrarImagen($img);
        echo "<br>".$res;
        $res = $this->desencriptar($res);
        echo "<br>".$res;
    }
    public function des($p){
        echo $this->desencriptar($p);
    }
}
