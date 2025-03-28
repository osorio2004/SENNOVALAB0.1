<?php
namespace App\Models;
use PDO;
use PDOException;

require_once __DIR__ . "/BaseModel.php";

class ClasiDocModel extends BaseModel {
    public function __construct() {
        $this->table = "documento"; // Cambia esto a clasidocs
        parent::__construct();
    }

    public function getAll(): array {
        try {
            $sql = "SELECT * FROM {$this->table}"; // Selecciona todos los campos
            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error al obtener documentos: " . $ex->getMessage();
            return [];
        }
    }

    public function saveClasiDoc(string $nombre, ?string $descripcion = null): bool {
        try {
            $sql = "INSERT INTO {$this->table} (nombre, descripcion) VALUES (:nombre, :descripcion)";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":nombre", $nombre);
            $statement->bindParam(":descripcion", $descripcion);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al guardar: " . $ex->getMessage();
            return false;
        }
    }

    public function saveNewDoc($data): bool {
        try {
            $sql = "INSERT INTO clasidocs (id, creo, codigo, version, nombre, 
                    elaborado_por, revisado_por, aprobado_por, proceso, 
                    subproceso, clasificacion) 
                    VALUES (:id, :creo, :codigo, :version, :nombre, 
                    :elaborado_por, :revisado_por, :aprobado_por, :proceso, 
                    :subproceso, :clasificacion)";
                    
            $statement = $this->dbConnection->prepare($sql);
            return $statement->execute($data);
        } catch (PDOException $ex) {
            echo "Error al guardar documento: " . $ex->getMessage();
            return false;
        }
    }

    public function getClasiDoc($id) {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error en getClasiDoc: " . $ex->getMessage());
            return null;
        }
    }

    public function editClasiDoc(int $id, string $nombre, ?string $descripcion = null): bool {
        try {
            $sql = "UPDATE {$this->table} SET nombre = :nombre, descripcion = :descripcion WHERE id_clasificacion = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":nombre", $nombre);
            $statement->bindParam(":descripcion", $descripcion);
            $statement->bindParam(":id", $id);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al actualizar: " . $ex->getMessage();
            return false;
        }
    }

    public function deleteClasiDoc(int $id): bool {
        try {
            $sql = "DELETE FROM {$this->table} WHERE id_clasificacion = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id);
            return $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al eliminar: " . $ex->getMessage();
            return false;
        }
    }

    public function updateDoc(int $id, array $data): bool {
        try {
            $sql = "UPDATE {$this->table} SET 
                    codigo = :codigo,
                    version = :version,
                    nombre = :nombre,
                    proceso = :proceso,
                    subproceso = :subproceso,
                    clasificacion = :clasificacion
                    WHERE id = :id";
            
            $data['id'] = $id;
            $statement = $this->dbConnection->prepare($sql);
            return $statement->execute($data);
        } catch (PDOException $ex) {
            echo "Error al actualizar documento: " . $ex->getMessage();
            return false;
        }
    }
}