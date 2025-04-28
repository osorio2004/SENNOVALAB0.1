<?php

namespace App\Models;

use PDO;
use PDOException;

class BaseModel
{
    protected $dbConnection;
    protected $table;

    public function __construct()
    {
        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            $dsn = DRIVER . ':host=' . HOST . ';dbname=' . DATABASE;
            $this->dbConnection = new PDO($dsn, USERNAME_DB, PASSWORD_DB, $options);
        } catch (PDOException $ex) {
            echo "Error>" . $ex->getMessage();
        }
    } // Cierra el constructor

    public function getAll(): array
    {
        try {

            $sql = "SELECT * FROM $this->table";
            $statement = $this->dbConnection->query($sql);

            // Verificar si hay registros
            $result = $statement->fetchAll(PDO::FETCH_OBJ);


            return $result;
        } catch (PDOException $ex) {
            echo "Error en consulta>{$ex->getMessage()}";
            return [];
        }
    }
}
