<?php

namespace app\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;


class PerfilController extends Controller{

    use Utility;
    
    private $usuario;
    private $rol;
    
    public function __construct() {
        
        $this->usuario = new Usuario;
        $this->rol = new Rol();
    }

    public function index(){
        $usuario = $this->usuario->getOne('usuarios', $_SESSION['id']);
        $usuario->documento = $this->desencriptar($usuario->documento);
        $usuario->direccion = $this->desencriptar($usuario->direccion);
        $usuario->telefono = $this->desencriptar($usuario->telefono);
        $usuario->email = $this->desencriptar($usuario->email);
        $doc = explode("-",$usuario->documento);
        $inicial_documento = $doc[0];
        $documento = $doc[1];
        $roles = $this->rol->listar();
        $seguridad_imgs = [
            'seguridad_img_0_.png', 'seguridad_img_1_.png', 'seguridad_img_2_.png', 'seguridad_img_3_.png'
        ];
        return View::getView('Usuario.perfil', [
            'usuario' => $usuario,
            'documento' => $documento,
            'inicial_documento' => $inicial_documento,
            'roles' => $roles,
            'seguridad_imgs' => $seguridad_imgs
        ]);
    }
}