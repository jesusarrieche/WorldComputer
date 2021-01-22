<?php

namespace App\Controllers;
use PDO;
use App\Models\Usuario;
use App\Traits\Utility;
use System\Core\Controller;
use System\Core\View;

class BitacoraController extends Controller{

    private $usuario;

    use Utility;

    public function __construct(){
        $this->usuario = new Usuario;
    }

    public function index(){
        // $band = false;
        // foreach ($_SESSION['permisos'] as $p):
        //     if ($p->permiso == "Inventario") {     
        //     $band = true;
        // }endforeach;   
        if ($_SESSION['rol']!=1) {
            header("Location: ".ROOT);
            return false;
        }
        return View::getView('Bitacora.index');
    }

    public function listar(){
        
        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
        http_response_code(404);
        return false;
        }
        $query = $this->usuario->query("SELECT b.*, Date_format(b.fecha, '%d/%m/%Y - %H:%i') as fecha, 
            CONCAT(u.nombre,' ',u.apellido) AS usuario FROM bitacora b INNER JOIN usuarios u ON b.usuario_id=u.id
            ORDER BY b.fecha DESC");
       
        $bitacora = $query->fetchAll(PDO::FETCH_OBJ);
        foreach($bitacora as $b){
            $b->button = 
            "<a href='bitacora/mostrar/". $this->encriptar($b->id) ."' class='mostrar btn btn-info'><i class='fas fa-search'></i></a>";
        }

        http_response_code(200);

        echo json_encode([
        'data' => $bitacora
        ]);
    }
    public function mostrar($param)
    {
        $param = $this->desencriptar($param);
        $query = $this->usuario->query("SELECT b.modulo, b.accion, b.descripcion, date_format(b.fecha,'%d/%m/%Y') AS fecha, 
            date_format(b.fecha,'%H:%i') AS hora, CONCAT(u.nombre,' ', u.apellido) AS usuario_nombre, u.documento as usuario_documento, u.usuario as usuario_username,
            r.nombre AS usuario_rol FROM bitacora b INNER JOIN usuarios u ON b.usuario_id=u.id 
            INNER JOIN roles r ON u.rol_id=r.id
            WHERE b.id=$param");
        $actividad = $query->fetch(PDO::FETCH_OBJ);
        http_response_code(200);

        echo json_encode([
            'data' => $actividad
        ]);

        exit();
    }
}