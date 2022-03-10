<?php

namespace App\Models;

use Exception;
use PDO;

class Usuario extends Persona{

    private $usuario;
    private $password;
    private $seguridad_img;
    private $seguridad_pregunta;
    private $seguridad_respuesta;
    private $rol_id;

    public function __construct(){
    }

    public function getUsuario(){
        return $this->usuario;
    }
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function getSeguridad_img(){
        return $this->seguridad_img;
    }
    public function setSeguridad_img($seguridad_img){
        $this->seguridad_img = $seguridad_img;
    }
    public function getSeguridad_pregunta(){
        return $this->seguridad_pregunta;
    }
    public function setSeguridad_pregunta($seguridad_pregunta){
        $this->seguridad_pregunta = $seguridad_pregunta;
    }
    public function getSeguridad_respuesta(){
        return $this->seguridad_respuesta;
    }
    public function setSeguridad_respuesta($seguridad_respuesta){
        $this->seguridad_respuesta = $seguridad_respuesta;
    }

    public function getRolId(){
        return $this->rol_id;
    }
    public function setRolId($rol_id){
        $this->rol_id = $rol_id;
    }

    public function listar(){
        try{
            $user = $_SESSION['usuario'];
            $consulta = parent::connect()->prepare("SELECT u.id, u.documento, CONCAT(u.nombre, ' ', u.apellido) AS nombre, u.usuario, r.nombre AS rol, u.telefono, u.estatus FROM 
                usuarios u
                    JOIN
                roles r
                    ON r.id = u.rol_id
                WHERE u.usuario != '$user' ORDER BY u.estatus, u.created_at DESC");

            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    public function listarActivos(){
        try{

            $user = $_SESSION['usuario'];

            $consulta = parent::connect()->prepare("SELECT u.id, u.documento, CONCAT(u.nombre, ' ', u.apellido) AS nombre, u.usuario, r.nombre AS rol, u.telefono, u.estatus FROM 
                usuarios u
                    JOIN
                roles r
                    ON r.id = u.rol_id
                WHERE u.usuario != '$user' AND u.estatus='ACTIVO' ORDER BY u.created_at DESC");

            $consulta->execute();
            
            return $consulta->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function registrar(Usuario $usuario){
        try{
            $dbh = parent::connect();
            $consulta = $dbh->prepare("INSERT INTO usuarios(rol_id,documento, nombre, apellido, direccion, telefono, 
                email, usuario, password, seguridad_img, seguridad_pregunta, seguridad_respuesta) VALUES (:rol_id,:documento, :nombre, :apellido, :direccion, 
                :telefono, :email, :usuario, :password, :seguridad_img, :seguridad_pregunta, :seguridad_respuesta)");

            $documento = $usuario->getDocumento();
            $nombre = $usuario->getNombre();
            $apellido = $usuario->getApellido();
            $direccion = $usuario->getDireccion();
            $telefono = $usuario->getTelefono();
            $email = $usuario->getEmail();
            $usuario_name = $usuario->getUsuario();
            $password = $usuario->getPassword();
            $seguridad_img = $usuario->getSeguridad_img();
            $seguridad_pregunta = $usuario->getSeguridad_pregunta();
            $seguridad_respuesta = $usuario->getSeguridad_respuesta();
            $rol_id = $usuario->getRolId();

            $consulta->bindParam(":rol_id", $rol_id);
            $consulta->bindParam(":documento", $documento);
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(":apellido", $apellido);
            $consulta->bindParam(":direccion", $direccion);
            $consulta->bindParam(":telefono", $telefono);
            $consulta->bindParam(":email", $email);
            $consulta->bindParam(":usuario", $usuario_name);
            $consulta->bindParam(":password", $password);
            $consulta->bindParam(":seguridad_img", $seguridad_img);
            $consulta->bindParam(":seguridad_pregunta", $seguridad_pregunta);
            $consulta->bindParam(":seguridad_respuesta", $seguridad_respuesta);

            return $consulta->execute();

        }catch(Exception $ex){
            $this->error = $ex->getMessage();
            return false;
        }
    }

    public function actualizar(Usuario $u){
        try{
            $id = $u->getId();
            $documento = $u->getDocumento();
            $nombre = $u->getNombre();
            $apellido = $u->getApellido();
            $direccion = $u->getDireccion();
            $telefono = $u->getTelefono();
            $email = $u->getEmail(); 
            $usuario = $u->getUsuario(); 
            $rol_id = $u->getRolId(); 
            $password = $u->getPassword(); 
            $seguridad_img = $u->getSeguridad_img(); 
            $seguridad_pregunta = $u->getSeguridad_pregunta(); 
            $seguridad_respuesta = $u->getSeguridad_respuesta(); 
            $estatus = "ACTIVO";
            $sql_extra = "";
            if($password != "")
            {
                $sql_extra .= ", password = '$password' ";
            }
            if($seguridad_img != "")
            {
                $sql_extra .= ", seguridad_img = '$seguridad_img' ";
            }
            if($seguridad_respuesta != "")
            {
                $sql_extra .= ", seguridad_respuesta = '$seguridad_respuesta' ";
            }
            $consulta = parent::connect()->prepare("UPDATE usuarios SET documento=:documento, 
                nombre=:nombre, apellido=:apellido, direccion=:direccion, telefono=:telefono, 
                email=:email, usuario=:usuario,rol_id=:rol_id, seguridad_pregunta=:seguridad_pregunta, 
                estatus=:estatus $sql_extra
                WHERE id=:id");
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":documento", $documento);
            $consulta->bindParam(":nombre", $nombre);
            $consulta->bindParam(":apellido", $apellido);
            $consulta->bindParam(":direccion", $direccion);
            $consulta->bindParam(":telefono", $telefono);
            $consulta->bindParam(":email", $email);
            $consulta->bindParam(":usuario", $usuario);
            $consulta->bindParam(":seguridad_pregunta", $seguridad_pregunta);
            $consulta->bindParam(":rol_id", $rol_id);
            $consulta->bindParam(":estatus", $estatus);

            return $consulta->execute();
                    
        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
            return false;
        }
    }

    /**
     * SECURITY
     */
    
    public function checkUser(Usuario $user) {
        try {
            $query = parent::connect()->prepare("SELECT id, documento, nombre, apellido, email, usuario, estatus, rol_id, password FROM usuarios WHERE usuario=:usuario");
            // $query = parent::connect()->prepare("SELECT id, documento, nombre, apellido, email, usuario, estatus, rol_id FROM usuarios WHERE estatus='ACTIVO' AND usuario=:usuario AND password=:password");
            
            $query->bindParam(":usuario", $user->usuario);
            // $query->bindParam(":password", $user->password);
            
            $query->execute();
            $user = $query->fetch(PDO::FETCH_OBJ);
            return $user;
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function obtenerPermisos(Usuario $user) {
        try {
            $query = parent::connect()->prepare("SELECT p.nombre as permiso FROM roles r 
                INNER JOIN rol_permiso rp ON r.id=rp.rol_id INNER JOIN permisos p ON rp.permiso_id=p.id WHERE r.id=:rol_id 
                ORDER BY rp.permiso_id");
            
            $query->bindParam(":rol_id", $user->rol_id);
            
            $query->execute();
            
            $permisos = $query->fetchAll(PDO::FETCH_OBJ);
            foreach($permisos as $p){
                $p->permiso = ucwords($p->permiso);
            }
            return $permisos;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function consultarDocumento ($documento) {
        try {
            $query = parent::connect()->prepare("SELECT nombre, apellido FROM usuarios WHERE documento = :documento");
            $query->bindParam(":documento", $documento);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);

        } catch ( Exception $e ) {
            die($e->getMessage());
        }
    }
    public function obtenerId (Usuario $user) {
        try {
            $email = $user->getEmail();
            $query = parent::connect()->prepare("SELECT id FROM usuarios WHERE email=:email");
            $query->bindParam(":email", $email);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);

        } catch ( Exception $e ) {
            die($e->getMessage());
        }
    }
    public function obtenerSeguridadPregunta() {
        try {
            $id = $_SESSION['id'];
            $query = parent::connect()->prepare("SELECT seguridad_pregunta FROM usuarios WHERE id=:id");
            $query->bindParam(":id", $id);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);

        } catch ( Exception $e ) {
            die($e->getMessage());
        }
    }

    public function autenticar(Usuario $u) {
        try {
            $id = $_SESSION['id'];
            $seguridad_img = $u->getSeguridad_img(); 
            $seguridad_respuesta = $u->getSeguridad_respuesta(); 
            $query = parent::connect()->prepare("SELECT id, usuario FROM usuarios WHERE id=:id 
                AND seguridad_img=:seguridad_img AND seguridad_respuesta=:seguridad_respuesta");
            $query->bindParam(":id", $id);
            $query->bindParam(":seguridad_img", $seguridad_img);
            $query->bindParam(":seguridad_respuesta", $seguridad_respuesta);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);

        } catch ( Exception $e ) {
            die($e->getMessage());
        }
    }

    public function recuperarContrasena(Usuario $user) {
        try {
            $_SESSION['id'] = $user->getId();
            $consulta = parent::connect()->prepare("UPDATE usuarios SET password=:password, estatus='ACTIVO' WHERE usuario = :usuario");
            $consulta->bindParam(":password", $user->password);
            $consulta->bindParam(":usuario", $user->usuario);
            return $consulta->execute();
        } catch ( Exception $e ) {
            die($e->getMessage());
        }
    }

}