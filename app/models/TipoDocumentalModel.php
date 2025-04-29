<?php

namespace App\Models;

use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . '../models/BaseModel.php';

class TipoDocumentalModel extends BaseModel
{
    public function __construct()
    {
        $this->table = "tipodocumental";
        parent::__construct();
    }

    public function saveTipoDocumental($nombre)
    {
        try {
            $sql = "INSERT INTO $this->table (nombre) VALUES (:nombre)";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al guardar el Tipo Documental> " . $ex->getMessage();
            return false;
        }
    }

    public function getTipoDocumental($id)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE idTipoDocumental = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener el Tipo Documental> " . $ex->getMessage();
            return null;
        }
    }

    public function getAll(): array
    {
        try {
            $sql = "SELECT * FROM $this->table";
            $statement = $this->dbConnection->query($sql);
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener los Tipos Documentales> " . $ex->getMessage();
            return [];
        }
    }

    public function editTipoDocumental($id, $nombre)
    {
        try {
            $sql = "UPDATE $this->table SET nombre = :nombre WHERE idTipoDocumental = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al editar el Tipo Documental> " . $ex->getMessage();
            return false;
        }
    }

    public function removeTipoDocumental($id)
    {
        try {
            $sql = "DELETE FROM $this->table WHERE idTipoDocumental = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el Tipo Documental> " . $ex->getMessage();
            return false;
        }
    }
}
