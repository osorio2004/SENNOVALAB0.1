<?php

namespace App\Models;

use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . '../models/BaseModel.php';

class DocumentoFormatoModel extends BaseModel {
    public function __construct() {
        $this->table = "documento_formato";
        parent::__construct();
    }

    public function saveDocumentoFormato($nombre, $descripcion) {
        try {
            $sql = "INSERT INTO $this->table (nombre, descripcion) VALUES (:nombre, :descripcion)";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al guardar el formato de documento > " . $ex->getMessage();
            return false;
        }
    }

    public function getDocumentoFormato($id) {
        try {
            $sql = "SELECT * FROM $this->table WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener el formato de documento > " . $ex->getMessage();
        }
    }

    public function editDocumentoFormato($id, $nombre, $descripcion) {
        try {
            $sql = "UPDATE $this->table SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al editar el formato de documento > " . $ex->getMessage();
        }
    }

    public function removeDocumentoFormato($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el formato de documento: " . $ex->getMessage();
            return false;
        }
    }
}
