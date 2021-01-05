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
           "SELECT * FROM notificaciones ORDER BY created_at DESC LIMIT $limit";
      
              $consulta = parent::connect()->prepare($sql);
              $consulta->execute();
              
              return $consulta->fetchAll(PDO::FETCH_OBJ);
              
          } catch (Exception $ex) {
              die($ex->getMessage());
          }
    }
}