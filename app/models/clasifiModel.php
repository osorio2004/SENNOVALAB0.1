<?php

namespace App\Models;

use PDO;
use PDOException;

require_once __DIR__ . "/BaseModel.php";

class ClasiDocModel extends BaseModel
{
    public function __construct()
    {
        $this->table = "documento"; // Cambia esto a clasidocs
        parent::__construct();
    }

    public function getAll(): array
    {
        try {
            $sql = "SELECT d.*, 
                    u1.nombre as creador,
                    u2.nombre as elaborador,
                    u3.nombre as aprobador,
                    c.nombre as categoria,
                    d.proceso,  -- Asegúrate de incluir el proceso
                    d.subproceso -- Asegúrate de incluir el subproceso
                    FROM documento d
                    LEFT JOIN usuarios u1 ON d.idUsuarioCreador = u1.id
                    LEFT JOIN usuarios u2 ON d.idUsuarioElaboro = u2.id
                    LEFT JOIN usuarios u3 ON d.idUsuarioAprobo = u3.id
                    LEFT JOIN categoriadocumento c ON d.idCategoria = c.idCategoria
                    ORDER BY d.fechaCreacion DESC";

            $statement = $this->dbConnection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error al obtener documentos: " . $ex->getMessage());
            return [];
        }
    }

    public function saveClasiDoc(string $nombre, ?string $descripcion = null): bool
    {
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

    public function saveNewDoc($data): bool
    {
        try {
            $sql = "INSERT INTO documento (
                idDocumento,
                titulo,
                fechaCreacion,
                fechaEdicion,
                estado,
                idUsuarioCreador,
                idCategoria,
                codigo,
                version,
                idUsuarioAprobo,
                idUsuarioElaboro,
                proceso, // Asegúrate de que este campo está en la consulta
                subproceso // Asegúrate de que este campo está en la consulta
            ) VALUES (
                :id,
                :nombre,
                CURDATE(),
                CURDATE(),
                'Activo',
                :idUsuarioCreador,
                :idCategoria,
                :codigo,
                :version,
                :idUsuarioAprobo,
                :idUsuarioElaboro,
                :proceso, // Asegúrate de que este campo está en la consulta
                :subproceso // Asegúrate de que este campo está en la consulta
            )";

            $statement = $this->dbConnection->prepare($sql);
            return $statement->execute([
                ':id' => $data['id'],
                ':nombre' => $data['nombre'],
                ':idUsuarioCreador' => $data['elaborado_por'],
                ':idCategoria' => $data['clasificacion'],
                ':codigo' => $data['codigo'],
                ':version' => $data['version'],
                ':idUsuarioAprobo' => $data['aprobado_por'],
                ':idUsuarioElaboro' => $data['elaborado_por'],
                ':proceso' => $data['proceso'], // Asegúrate de que este campo está en la consulta
                ':subproceso' => $data['subproceso'] // Asegúrate de que este campo está en la consulta
            ]);
        } catch (PDOException $ex) {
            error_log("Error al guardar documento: " . $ex->getMessage());
            return false;
        }
    }   

    public function getClasiDoc($id)
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE idDocumento = :id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            error_log("Error en getClasiDoc: " . $ex->getMessage());
            return null;
        }
    }

    public function editClasiDoc(int $id, string $nombre, ?string $descripcion = null): bool
    {
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

    public function deleteClasiDoc(int $id): bool
    {
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

    public function updateDoc(int $id, array $data): bool
    {
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
