<?php

namespace App\Models;

use PDO;
use System\Core\Model;

class Notificacion extends Model{

    private $id;
    private $usuario_id;
    private $titulo;
    private $mensaje;
    private $autor;
    private $estatus;

    public function __construct(){
    }

    /**
     * Getter and Setter
     */

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getUsuarioId(){
        return $this->usuario_id;
    }

    public function setUsuarioId($id){
        $this->usuario_id = $id;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    public function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }

    public function getAutor(){
        return $this->autor;
    }

    public function setAutor($autor){
        $this->autor = $autor;
    }

    public function getEstatus(){
        return $this->estatus;
    }

    public function setEstatus($estatus){
        $this->estatus = $estatus;
    }

    /**
     * METODOS
     */

    public function cambiarEstatus($id){
        $conexion = parent::connect();

        try {
            $conexion->beginTransaction();

            $query = $conexion->prepare("SELECT estatus FROM notificaciones WHERE id = '$id' LIMIT 1");
            $query->execute();

            $estatus = $query->fetch(PDO::FETCH_COLUMN);

            if($estatus == 'ACTIVO'){
                $query2 = $conexion->prepare("UPDATE $tabla SET estatus = 'INACTIVO' WHERE id = '$id'");
                // $query3 = $conexion->prepare("UPDATE $tabla2 SET estatus = 'INACTIVO' WHERE $referencia = '$id'");

                $query2->execute();
                // $query3->execute();

                $conexion->commit();

                return true;

            }elseif($estatus == 'INACTIVO'){
                $query2 = $conexion->prepare("UPDATE $tabla SET estatus = 'ACTIVO' WHERE id = '$id'");
                // $query3 = $conexion->prepare("UPDATE $tabla2 SET estatus = 'ACTIVO' WHERE $referencia = '$id'");

                $query2->execute();
                // $query3->execute();

                $conexion->commit();

                return true;


            }else {
                return false;
            }

        } catch (Exception $e) {
            $conexion->rollBack();
            return $e->getMessage();
        }
    }

    public function listar($limit) {
        try{
            $sql = 
           "SELECT * FROM notificaciones WHERE estatus = 'ACTIVO' ORDER BY created_at DESC LIMIT $limit";
      
              $consulta = parent::connect()->prepare($sql);
              $consulta->execute();
              
              return $consulta->fetchAll(PDO::FETCH_OBJ);
              
          } catch (Exception $ex) {
              die($ex->getMessage());
          }
    }

    public function crear ($usuario_id,$producto_id,$titulo,$mensaje) {
        $dbh = parent::connect();
        $consulta = $dbh->prepare("INSERT INTO notificaciones(usuario_id, producto_id, titulo, mensaje) VALUES (:usuario_id,:producto_id, :titulo, :mensaje)");

        $consulta->bindParam(":usuario_id", $usuario_id);
        $consulta->bindParam(":producto_id", $producto_id);
        $consulta->bindParam(":titulo", $titulo);
        $consulta->bindParam(":mensaje", $mensaje);

        $consulta->execute();
    }

    public function yaNotificado ($producto_id) {
        $conexion = parent::connect();

        try {
            $query = $conexion->prepare("SELECT * FROM notificaciones WHERE producto_id = :producto_id AND estatus = 'ACTIVO'");
            $query->bindParam(':producto_id',$producto_id);
            $query->execute();

            return ($query->rowCount() > 0) ? true : false;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function dismissNotificacion ($id) {
        $conexion = parent::connect();
        try {
            $query = $conexion->prepare("UPDATE notificaciones SET estatus = 'INACTIVO' WHERE id = :id");
            $query->bindParam(':id',$id);
            $query->execute();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}