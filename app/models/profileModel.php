<?php
namespace App\Models;

class ProfileModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserProfile($userId) {
        try {
            $query = "SELECT u.id, u.nombre, u.email, u.foto_perfil, r.nombre as rol 
                      FROM usuarios u 
                      JOIN roles r ON u.rol_id = r.id 
                      WHERE u.id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$userId]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error en getUserProfile: " . $e->getMessage());
            return false;
        }
    }

    public function updateProfilePhoto($userId, $photoPath) {
        try {
            $query = "UPDATE usuarios SET foto_perfil = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            return $stmt->execute([$photoPath, $userId]);
        } catch (\PDOException $e) {
            error_log("Error en updateProfilePhoto: " . $e->getMessage());
            return false;
        }
    }
}