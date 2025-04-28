<?php

namespace App\Models;

use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . '../models/BaseModel.php';

class ProcesoModel extends BaseModel {
    public function __construct() {
        $this->table = "proceso";
        parent::__construct();
    }

    public function saveProceso($nombre, $siglaCod) {
        try {
            $sql = "INSERT INTO $this->table (nombre, siglaCod) VALUES (:nombre, :siglaCod)";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':siglaCod', $siglaCod, PDO::PARAM_STR);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al guardar el proceso > " . $ex->getMessage();
            return false;
        }
    }

    public function getProceso($id) {
        try {
            $sql = "SELECT * FROM $this->table WHERE idproceso = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener el proceso > " . $ex->getMessage();
        }
    }

    public function editProceso($id, $nombre, $siglaCod) {
        try {
            $sql = "UPDATE $this->table SET nombre = :nombre, siglaCod = :siglaCod WHERE idproceso = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':siglaCod', $siglaCod, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al editar el proceso > " . $ex->getMessage();
        }
    }

    public function removeProceso($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idproceso = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el proceso: " . $ex->getMessage();
            return false;
        }
    }
}
