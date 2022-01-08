<?php

namespace System\Core;

use PDO;

class Database {
    private $driver = 'mysql';
    private $host = SERVER;
    private $dbname = BD;
    private $user = USER;
    private $password = PASS;

    public function __construct(){
        $this->connect();
    }

    public function connect(){
        $connection = new PDO("$this->driver:host=$this->host; dbname=$this->dbname", $this->user, $this->password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec("SET CHARACTER SET utf8;");//Para poder enviar caracteres especiales UTF8 a la DB. Está sentencia no es válida en todos los gestores de DB
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
        }
        else{
            $id = 1;
        }
        $connection->exec("SET @usuario_id = $id;");
        
        // echo 'Conexion exitosa';
        return $connection;
    }
}