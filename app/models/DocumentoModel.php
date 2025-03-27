<?php

namespace App\Models;

use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . '../models/BaseModel.php';

class DocumentoModel extends BaseModel {
    public function __construct() {
        $this->table = "documento"; // Nombre de la tabla en la base de datos
        parent::__construct();
    }

    public function saveDocumento($titulo, $fechaCreacion, $fechaEdicion, $estado, $idUsuarioCreador, $idCategoria, $codigo, $version, $idUsuarioAprobo, $idUsuarioElaboro) {
        try {
            $sql = "INSERT INTO $this->table (titulo, fechaCreacion, fechaEdicion, estado, idUsuarioCreador, idCategoria, codigo, version, idUsuarioAprobo, idUsuarioElaboro) VALUES (:titulo, :fechaCreacion, :fechaEdicion, :estado, :idUsuarioCreador, :idCategoria, :codigo, :version, :idUsuarioAprobo, :idUsuarioElaboro)";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $statement->bindParam(':fechaCreacion', $fechaCreacion, PDO::PARAM_STR);
            $statement->bindParam(':fechaEdicion', $fechaEdicion, PDO::PARAM_STR);
            $statement->bindParam(':estado', $estado, PDO::PARAM_STR);
            $statement->bindParam(':idUsuarioCreador', $idUsuarioCreador, PDO::PARAM_INT);
            $statement->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
            $statement->bindParam(':codigo', $codigo, PDO::PARAM_STR);
            $statement->bindParam(':version', $version, PDO::PARAM_INT);
            $statement->bindParam(':idUsuarioAprobo', $idUsuarioAprobo, PDO::PARAM_INT);
            $statement->bindParam(':idUsuarioElaboro', $idUsuarioElaboro, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al guardar el documento>" . $ex->getMessage();
        }
    }

    public function getDocumento($id) {
        try {
            $sql = "SELECT * FROM $this->table WHERE idDocumento=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener el documento>" . $ex->getMessage();
        }
    }

    public function editDocumento($id, $titulo, $fechaCreacion, $fechaEdicion, $estado, $idUsuarioCreador, $idCategoria, $codigo, $version, $idUsuarioAprobo, $idUsuarioElaboro) {
        try {
            $sql = "UPDATE $this->table SET titulo=:titulo, fechaCreacion=:fechaCreacion, fechaEdicion=:fechaEdicion, estado=:estado, idUsuarioCreador=:idUsuarioCreador, idCategoria=:idCategoria, codigo=:codigo, version=:version, idUsuarioAprobo=:idUsuarioAprobo, idUsuarioElaboro=:idUsuarioElaboro WHERE idDocumento=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":titulo", $titulo, PDO::PARAM_STR);
            $statement->bindParam(":fechaCreacion", $fechaCreacion, PDO::PARAM_STR);
            $statement->bindParam(":fechaEdicion", $fechaEdicion, PDO::PARAM_STR);
            $statement->bindParam(":estado", $estado, PDO::PARAM_STR);
            $statement->bindParam(":idUsuarioCreador", $idUsuarioCreador, PDO::PARAM_INT);
            $statement->bindParam(":idCategoria", $idCategoria, PDO::PARAM_INT);
            $statement->bindParam(":codigo", $codigo, PDO::PARAM_STR);
            $statement->bindParam(":version", $version, PDO::PARAM_INT);
            $statement->bindParam(":idUsuarioAprobo", $idUsuarioAprobo, PDO::PARAM_INT);
            $statement->bindParam(":idUsuarioElaboro", $idUsuarioElaboro, PDO::PARAM_INT);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al editar el documento>" . $ex->getMessage();
        }
    }

    public function removeDocumento($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idDocumento=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el documento: " . $ex->getMessage();
            return false;
        }
    }
    public function getAll(): array {
        try {
            $sql = "SELECT * FROM $this->table";
            $statement = $this->dbConnection->query($sql);
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener los documentos>" . $ex->getMessage();
            return [];
        }
    }
}