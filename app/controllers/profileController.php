<?php
namespace App\Controllers;

class ProfileController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function view() {
        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Debug: Verificar contenido de la sesión
        // var_dump($_SESSION); exit();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /login/init');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $profileData = $this->model->getUserProfile($userId);

        if (!$profileData) {
            die("Error al cargar los datos del perfil");
        }

        // Ruta absoluta al archivo de vista
        $viewPath = __DIR__ . '/../../views/viewProfile.php';
        
        if (!file_exists($viewPath)) {
            die("La vista no existe en: " . $viewPath);
        }

        include_once $viewPath;
    }

    public function updatePhoto() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'error' => 'No autenticado']);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_photo'])) {
            $userId = $_SESSION['user_id'];
            $uploadDir = __DIR__ . '/../../public/uploads/profile_photos/';
            
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = uniqid() . '_' . basename($_FILES['profile_photo']['name']);
            $targetPath = $uploadDir . $fileName;
            $publicPath = '/uploads/profile_photos/' . $fileName;

            if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $targetPath)) {
                if ($this->model->updateProfilePhoto($userId, $publicPath)) {
                    $_SESSION['foto_perfil'] = $publicPath;
                    echo json_encode([
                        'success' => true, 
                        'photoPath' => $publicPath
                    ]);
                } else {
                    echo json_encode([
                        'success' => false, 
                        'error' => 'Error al actualizar la base de datos'
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false, 
                    'error' => 'Error al subir la imagen'
                ]);
            }
        }
    }
}