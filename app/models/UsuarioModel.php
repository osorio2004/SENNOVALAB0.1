<?php

namespace App\Models;

use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . '../models/BaseModel.php';

class UsuarioModel extends BaseModel {
    public function __construct() {
        $this->table = "usuarios"; // Nombre de la tabla en la base de datos
        parent::__construct();
    }



    public function saveUsuario($nombre, $email, $password, $rol) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash de la contraseña
            $sql = "INSERT INTO $this->table (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR); // Guardar el hash
            $statement->bindParam(':rol', $rol, PDO::PARAM_STR);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al guardar el usuario>" . $ex->getMessage();
            return false; // Retornar false si hay un error
        }
    }

    public function getUsuario($id) {
        try {
            $sql = "SELECT * FROM $this->table WHERE id=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener el usuario>" . $ex->getMessage();
        }
    }

    public function editUsuario($id, $nombre, $email, $password, $rol) {
        try {
            $sql = "UPDATE $this->table SET nombre=:nombre, email=:email, password=:password, rol=:rol WHERE id=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $statement->bindParam(":email", $email, PDO::PARAM_STR);
            $statement->bindParam(":password", $password, PDO::PARAM_STR);
            $statement->bindParam(":rol", $rol, PDO::PARAM_STR);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al editar el usuario>" . $ex->getMessage();
        }
    }

    public function removeUsuario($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE id=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el usuario: " . $ex->getMessage();
            return false;
        }
    }

    public function validarLogin($email, $password){ // Contraseñaque llega del formulario
        $sql = "SELECT * FROM $this->table WHERE email=:email";
        $statement = $this->dbConnection->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $resultSet = [];
        while($row = $statement->fetch(PDO::FETCH_OBJ)){
            $resultSet [] = $row;
        }
        if(count($resultSet) > 0){
            $hash = $resultSet[0]->password; // Hash guardado en la base de datos
            if(password_verify($password, $hash)){
                $_SESSION['nombre'] = $resultSet[0]->nombre;
                $_SESSION['id'] = $resultSet[0]->id;
                $_SESSION['rol'] = $resultSet[0]->rol;
                $_SESSION['timeout'] = time();
                session_regenerate_id();
                return true;
            }
        }
        return false;
    }
}