<?php

namespace App\Models;

use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . '../models/BaseModel.php';

class DocumentoFormatoModel extends BaseModel {
    public function __construct() {
        $this->table = "documento_formato"; // Nombre de la tabla en la base de datos
        parent::__construct();
    }

    public function saveDocumentoFormato($codigo, $nombre, $tipo, $tipo_doc_formato, $fkProceso, $fkTipoDocumental) {
        try {
            $sql = "INSERT INTO $this->table (codigo, nombre, tipo, tipo_doc_formato, fkProceso, fkTipoDocumental) 
                    VALUES (:codigo, :nombre, :tipo, :tipo_doc_formato, :fkProceso, :fkTipoDocumental)";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':codigo', $codigo, PDO::PARAM_STR);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $statement->bindParam(':tipo_doc_formato', $tipo_doc_formato, PDO::PARAM_STR);
            $statement->bindParam(':fkProceso', $fkProceso, PDO::PARAM_INT);
            $statement->bindParam(':fkTipoDocumental', $fkTipoDocumental, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al guardar el Documento Formato> " . $ex->getMessage();
            return false;
        }
    }

    public function getAll() : array{
        try {
            // Asegúrate de hacer alias a idDocumentoFormato como 'id'
            $sql = "SELECT idDocumentoFormato AS id, nombre, codigo, tipo FROM $this->table";
            $stmt = $this->dbConnection->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener los Documentos Formato> " . $ex->getMessage();
            return [];
        }
    }

    public function getDocumentoFormato($id) {
        try {
            $sql = "SELECT * FROM $this->table WHERE idDocumentoFormato=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener el Documento Formato> " . $ex->getMessage();
        }
    }

    public function editDocumentoFormato($id, $codigo, $nombre, $tipo, $tipo_doc_formato, $fkProceso, $fkTipoDocumental) {
        try {
            $sql = "UPDATE $this->table 
                    SET codigo=:codigo, nombre=:nombre, tipo=:tipo, tipo_doc_formato=:tipo_doc_formato, 
                        fkProceso=:fkProceso, fkTipoDocumental=:fkTipoDocumental 
                    WHERE idDocumentoFormato=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':codigo', $codigo, PDO::PARAM_STR);
            $statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $statement->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $statement->bindParam(':tipo_doc_formato', $tipo_doc_formato, PDO::PARAM_STR);
            $statement->bindParam(':fkProceso', $fkProceso, PDO::PARAM_INT);
            $statement->bindParam(':fkTipoDocumental', $fkTipoDocumental, PDO::PARAM_INT);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al editar el Documento Formato> " . $ex->getMessage();
        }
    }

    public function removeDocumentoFormato($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE idDocumentoFormato=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "No se pudo eliminar el Documento Formato: " . $ex->getMessage();
            return false;
        }
    }
}
