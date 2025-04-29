<?php

namespace App\Models;

use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . '../models/BaseModel.php';

class AnexoModel extends BaseModel {
    public function __construct() {
        $this->table = "anexo";
        parent::__construct();
    }

    public function saveAnexo($nombre, $fecha, $rutaArchivo) {
        try {
            $sql = "INSERT INTO $this->table (nombre, fecha, ruta_archivo) 
                    VALUES (:nombre, :fecha, :ruta_archivo)";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $statement->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $statement->bindParam(":ruta_archivo", $rutaArchivo, PDO::PARAM_STR);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al guardar el anexo: " . $ex->getMessage();
            return false;
        }
    }

    public function getAll() : array {
        try {
            $sql = "SELECT * FROM $this->table ORDER BY fecha DESC";
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener los anexos: " . $ex->getMessage();
            return [];
        }
    }

    public function getAnexo($id) {
        try {
            $sql = "SELECT * FROM $this->table WHERE idAnexo = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener el anexo: " . $ex->getMessage();
            return null;
        }
    }

    public function editAnexo($id, $nombre, $fecha, $rutaArchivo) {
        try {
            $sql = "UPDATE $this->table 
                    SET nombre = :nombre, fecha = :fecha, ruta_archivo = :ruta 
                    WHERE idAnexo = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $statement->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $statement->bindParam(":ruta", $rutaArchivo, PDO::PARAM_STR);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al editar el anexo: " . $ex->getMessage();
            return false;
        }
    }

    public function removeAnexo($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idAnexo = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al eliminar el anexo: " . $ex->getMessage();
            return false;
        }
    }
}