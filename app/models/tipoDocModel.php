<?php
namespace App\Models;
use PDO;
use PDOException;

require_once MAIN_APP_ROUTE."../models/BaseModel.php";

class TipoDocModel extends BaseModel{
    public function __construct(
        ?int $id = null,
        ?string $nombre = null,
        ?string $descripcion = null
    )
    {
        $this->table = "tipo_documento";
        parent::__construct();
    }

    public function getAll(): array {
        try {
            $sql = "SELECT id_tipo_doc, nombre, descripcion FROM {$this->table}";
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener tipos de documentos: ".$ex->getMessage();
            return [];
        }
    }

    public function saveTipoDoc(string $nombre, ?string $descripcion = null): bool {
        try {
            $sql = "INSERT INTO {$this->table} (nombre, descripcion) VALUES (:nombre, :descripcion)";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $statement->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $statement->execute();
            return true;
        } catch (PDOException $ex) {
            echo "Error al guardar el tipo de documento: ".$ex->getMessage();
            return false;
        }
    }

    public function getTipoDoc(int $idTipoDoc): ?object {
        try {
            $sql = "SELECT id_tipo_doc, nombre, descripcion FROM {$this->table} WHERE id_tipo_doc = :idTipoDoc";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idTipoDoc", $idTipoDoc, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return !empty($result) ? $result[0] : null;
        } catch (PDOException $ex) {
            echo "Error al obtener tipo de documento: ".$ex->getMessage();
            return null;
        }
    }

    public function editTipoDoc(int $idTipoDoc, string $nombre, ?string $descripcion = null): bool {
        try {
            $sql = "UPDATE {$this->table} SET nombre = :nombre, descripcion = :descripcion WHERE id_tipo_doc = :idTipoDoc";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $statement->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $statement->bindParam(":idTipoDoc", $idTipoDoc, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "No se pudo editar el tipo de documento: ".$ex->getMessage();
            return false;
        }
    }

    public function deleteTipoDoc(int $idTipoDoc): bool {
        try {
            $sql = "DELETE FROM {$this->table} WHERE id_tipo_doc = :idTipoDoc";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":idTipoDoc", $idTipoDoc, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el tipo de documento: ".$ex->getMessage();
            return false;
        }
    }
}