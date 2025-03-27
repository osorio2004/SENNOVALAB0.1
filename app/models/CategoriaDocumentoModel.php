<?php

namespace App\Models;

use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . '../models/BaseModel.php';

class CategoriaDocumentoModel extends BaseModel {
    public function __construct() {
        $this->table = "categoriadocumento"; // Nombre de la tabla en la base de datos
        parent::__construct();
    }

    public function saveCategoria($nombre, $descripcion) {
        try {
            $sql = "INSERT INTO $this->table (nombre, descripcion) VALUES (:nombre, :descripcion)";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al guardar la categoría>" . $ex->getMessage();
        }
    }

    public function getCategoria($id) {
        try {
            $sql = "SELECT * FROM $this->table WHERE idCategoria=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener la categoría>" . $ex->getMessage();
        }
    }

    public function editCategoria($id, $nombre, $descripcion) {
        try {
            $sql = "UPDATE $this->table SET nombre=:nombre, descripcion=:descripcion WHERE idCategoria=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $statement->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al editar la categoría>" . $ex->getMessage();
        }
    }

    public function removeCategoria($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idCategoria=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "No se pudo eliminar la categoría: " . $ex->getMessage();
            return false;
        }
    }
    public function getAll(): array {
        try {
            $sql = "SELECT * FROM $this->table";
            $statement = $this->dbConnection->query($sql);
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener las categorías>" . $ex->getMessage();
            return [];
        }
    }
}