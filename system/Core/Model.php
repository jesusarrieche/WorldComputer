<?php

namespace System\Core;

use Exception;
use PDO;

class Model extends Database{
    protected $error;
    public function getError() {
        return $this->error;
    }
    public function __construct(){
    }

    public function contar($table){
        try{
            $consulta = parent::connect()->query("SELECT * FROM $table WHERE estatus='ACTIVO'")->rowCount();
            return $consulta;
        
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function query($sql){
        try{
            $consulta = parent::connect()->prepare($sql);
            $consulta->execute();
            return $consulta;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function getOne($table, $id){
        try{
            $consulta= parent::connect()->prepare("SELECT * FROM $table WHERE id=$id");

            $consulta->execute();
            $objeto = $consulta->fetch(PDO::FETCH_OBJ);

            return $objeto;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function getAll($table, $condition = null){

        if(!is_null($condition)){
            $sql = "SELECT * FROM $table WHERE $condition";
        }else{
            $sql = "SELECT * FROM $table";
        }

        try{
            $consulta= parent::connect()->prepare($sql);

            $consulta->execute();
            $objeto = $consulta->fetchAll(PDO::FETCH_OBJ);

            return $objeto;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function getValorColumna($tabla, $columna, $condicion){
        
        $conexion = parent::connect();

        try {
            $query = $conexion->prepare("SELECT $columna FROM $tabla WHERE $condicion LIMIT 1");
            $query->execute();

            return $query->fetch(PDO::FETCH_COLUMN);
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function eliminar($tabla, $id){    //Metodo elimina logicamente un registro
        try{
            $consulta = parent::connect()->prepare("UPDATE $tabla SET estatus='INACTIVO' WHERE id=$id");

            return $consulta->execute();

        } catch (Exception $ex) {
            
            die("Error: ". $ex->getMessage());
        }
    }
    public function habilitar($tabla, $id){    //Metodo habilita un registro
        try{
            $consulta = parent::connect()->prepare("UPDATE $tabla SET estatus='ACTIVO' WHERE id=$id");

            return $consulta->execute();

        } catch (Exception $ex) {
            
            die("Error: ". $ex->getMessage());
        }
    }
}