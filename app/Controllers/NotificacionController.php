<?php

namespace app\Controllers;

use App\Models\Notificacion;
use App\Traits\Utility;
use System\Core\Controller;

class NotificacionController extends Controller{
    private $notificacion;

    use Utility;

    public function __construct(){
        $this->notificacion = new Notificacion;
    }

    public function listar(){

        $method = $_SERVER['REQUEST_METHOD'];

        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }

        $notificaciones = $this->notificacion->listar(3);

        header('Content-Type: application/json');

        http_response_code(200);

        echo json_encode([
        'data' => $notificaciones
        ]);

    }

 
}