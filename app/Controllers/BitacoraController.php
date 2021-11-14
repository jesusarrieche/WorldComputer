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
        if ($_SESSION['rol']!=1) {
            header("Location: ".ROOT);
            return false;
        }
        $usuarios = $this->usuario->getAll("usuarios", "1");
        foreach ($usuarios as $usuario) {
            $usuario->id = $this->encriptar($usuario->id);
        }
        return View::getView('Bitacora.index',
            [
                'usuarios'=>$usuarios
            ]
        );
    }

    public function listar($param = NULL){
        $method = $_SERVER['REQUEST_METHOD'];
        if( $method != 'POST'){
            http_response_code(404);
            return false;
        }
        if (isset($param)) {
            $b = explode('&',$param);
        }
        if (isset($b[0]) && $b[0]!="" || isset($b[1]) && $b[1]!="" || isset($b[2]) && $b[2]!="") {
            $first = false;
            if (isset($b[0]) && $b[0]!="") {
                $cond1 = "b.fecha BETWEEN '".$b[0]." 00:00:00' AND '".$b[0]." 23:59:59' ";
                $first = true;
            }
            if (isset($b[1]) && $b[1]!="") {
                $usuario_id = $this->desencriptar($b[1]);
                if (!$first) {
                    $cond2 = " b.usuario_id = ".$usuario_id." ";
                    $first = true;
                }
                else{
                    $cond2 = " AND b.usuario_id = ".$usuario_id." ";
                }
            }
            if (isset($b[2]) && $b[2]!="") {
                if (!$first) {
                    $cond3 = " b.modulo LIKE '%".$b[2]."%' ";
                    $first = true;
                }
                else{
                    $cond3 = " AND b.modulo LIKE '%".$b[2]."%' ";
                }
            }
            $sql = "SELECT b.*, Date_format(b.fecha, '%d/%m/%Y - %H:%i') as fecha, 
                CONCAT(u.nombre,' ',u.apellido) AS usuario FROM bitacora b INNER JOIN usuarios u ON b.usuario_id=u.id
                WHERE ";
            if (isset($cond1)) {
                $sql.=$cond1;
            }
            if (isset($cond2)) {
                $sql.=$cond2;
            }
            if (isset($cond3)) {
                $sql.=$cond3;
            }
            $sql .= " ORDER BY b.fecha DESC";
            
            $query = $this->usuario->query($sql);
        }
        else{
            $query = $this->usuario->query("SELECT b.*, Date_format(b.fecha, '%d/%m/%Y - %H:%i') as fecha, 
            CONCAT(u.nombre,' ',u.apellido) AS usuario FROM bitacora b INNER JOIN usuarios u ON b.usuario_id=u.id
            ORDER BY b.fecha DESC");
        }        
       
        $bitacora = $query->fetchAll(PDO::FETCH_OBJ);
        foreach($bitacora as $b){
            $exp = explode('"', $b->accion);//Desglosar la acción
            $expl = explode(' - ', $exp[1]);//Obtener el documento por su inicial y número
            if(count($expl) > 1){//Verificar si es un documento de persona
                $persona = $this->desencriptar($expl[0]).' - '.$expl[1];//Desencriptar documento
                $accion = $exp[0].'"'.$persona.'"';
                $b->accion = $accion;
            }
            
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
        $actividad->usuario_documento = $this->desencriptar($actividad->usuario_documento);
        $expA = explode('"', $actividad->accion);//Desglosar la acción
        $explA = explode(' - ', $expA[1]);//Obtener el documento por su inicial y número
        if(count($explA) > 1){//Verificar si es un documento de persona
            $persona = $this->desencriptar($explA[0]).' - '.$explA[1];//Desencriptar documento
            $accion = $expA[0].'"'.$persona.'"';
            $actividad->accion = $accion;

            $expD = explode('<br>', $actividad->descripcion);//Desglosar la descripción
            $descripcion = "";
            for ($i=0; $i < count($expD); $i++) { 
                $desencriptado = false;
                $explD = explode(': ', $expD[$i]);//Desglosar el campo de información
                if(count($explD) > 1){
                    if($explD[0] == "Documento" || $explD[0] == "Dirección"
                        || $explD[0] == "Teléfono" || $explD[0] == "E-mail"){//Verificar si es un dato encriptado
                        $explD[1] = $this->desencriptar($explD[1]);
                        $desencriptado = true;
                    }
                }
                if(!$desencriptado){
                    $descripcion .= $expD[$i] . '<br>';
                }
                else{//Agregar a la descripción el dato desencriptado
                    $descripcion .= $explD[0].': '.$explD[1].'<br>';
                }
                $actividad->descripcion = $descripcion;//Asignar la nueva descripción al objeto
            }
        }
        http_response_code(200);
        echo json_encode([
            'data' => $actividad
        ]);

        exit();
    }
}