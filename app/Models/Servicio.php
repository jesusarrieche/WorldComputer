<?php

namespace App\Models;

use PDO;
use System\Core\Model;

class Servicio extends Model{

    private $servicio_id;
    private $descripcion;
    private $nombre;
    private $precio;

    public function getServicioId(){
        return $this->servicio_id;
    }

    public function setServicioId($servicio_id){
        $this->servicio_id = $servicio_id;
    }

    public function getProductoId(){
        return $this->descripcion;
    }

    public function setProductoId($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getnombre(){
        return $this->nombre;
    }

    public function setnombre($nombre){
        $this->nombre = $nombre;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function listar(){
        try{
            $consulta = parent::connect()->prepare("SELECT id, nombre, descripcion, precio, estatus, created_at FROM servicios WHERE estatus='ACTIVO' ORDER BY created_at DESC");
            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}