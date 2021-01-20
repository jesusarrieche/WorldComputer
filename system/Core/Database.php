<?php

namespace System\Core;

use PDO;

class Database {
    private $driver = 'mysql';
    private $host = 'localhost';
    private $dbname = 'world_computer';
    private $user = 'root';
    private $password = 'informatica';

    public function __construct(){
        $this->connect();
    }

    public function connect(){
        $connection = new PDO("$this->driver:host=$this->host; dbname=$this->dbname", $this->user, $this->password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_SESSION['id'])) {
            $connection->exec("SET @usuario_id = ".$_SESSION['id'].";");
        }
        
        // echo 'Conexion exitosa';
        return $connection;
    }
}