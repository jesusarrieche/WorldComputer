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

    public function listarPrestados(){
        try{
            $consulta = parent::connect()->prepare("SELECT id, cantidad, precio, empleado_id, venta_id, servicio_id, created_at FROM detalle_servicio  ORDER BY created_at DESC");
            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function añadirDetalles($data){
        try{
            $dbh = parent::connect();

            $consulta = $dbh->prepare("INSERT INTO detalle_servicio(cantidad, precio, empleado_id, venta_id, servicio_id) VALUES (:cantidad, :precio, :empleado_id, :venta_id, :servicio_id)");

            $consulta->bindParam(":cantidad", $data['cantidad']);
            $consulta->bindParam(":precio", $data['precio']);
            $consulta->bindParam(":empleado_id", $data['empleado_id']);
            $consulta->bindParam(":venta_id", $data['venta_id']);
            $consulta->bindParam(":servicio_id", $data['servicio_id']);


            $consulta->execute();

            $lastId = $dbh->lastInsertId();
            
            return $lastId;
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }


}