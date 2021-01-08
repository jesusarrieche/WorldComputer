<?php

namespace App\Models;

use PDO;
use System\Core\Model;

class Servicio extends Model{

    private $id;
    private $descripcion;
    private $nombre;
    private $precio;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
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
    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    // Servicios
    public function listar(){
        try{
            $consulta = parent::connect()->prepare("SELECT id, nombre, descripcion, precio, estatus, created_at FROM servicios WHERE estatus='ACTIVO' ORDER BY created_at DESC");
            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function registrar(Servicio $servicio){
        try{
            $consulta = parent::connect()->prepare("INSERT INTO servicios(nombre, descripcion, precio) "
                . "VALUES (:nombre, :descripcion, :precio)");
        
        
            $nombre = $servicio->getNombre();
            $descripcion = $servicio->getDescripcion();
            $precio = $servicio->getPrecio();
            
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(":descripcion", $descripcion);
            $consulta->bindParam(":precio", $precio);
            
            return $consulta->execute();
            
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    public function actualizar(Servicio $servicio){
        try{
            $consulta = parent::connect()->prepare("UPDATE servicios SET nombre=:nombre, descripcion=:descripcion, precio=:precio,estatus=:estatus WHERE id=:id");


            $id = $servicio->getId();
            $nombre = $servicio->getNombre();
            $descripcion = $servicio->getDescripcion();
            $precio = $servicio->getPrecio();
            $estatus = "ACTIVO";
            
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(':descripcion', $descripcion);
            $consulta->bindParam(':precio', $precio);
            $consulta->bindParam(":estatus", $estatus);

            return $consulta->execute();
                    
        } catch (Exception $ex) {
            return $ex->getMessage();            
        }
    }
    // Servicios Prestados
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