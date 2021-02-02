<?php

namespace App\Models;

use PDO;
use System\Core\Model;

class Inventario extends Model{

    public function listar(){

        $conexion = parent::connect();

        try {
            $query = $conexion->query("SELECT * FROM v_inventario");
            
            return $query->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function bajoStock ($producto_id) {
    	$conexion = parent::connect();

        try {
            $query = $conexion->prepare("SELECT * FROM v_inventario WHERE stock <= stock_min AND id = :producto_id");
            $query->bindParam(':producto_id',$producto_id);
            $query->execute();

            return ($query->rowCount() > 0) ? true : false;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


}