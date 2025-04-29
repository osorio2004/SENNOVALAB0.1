<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE . '../models/UsuarioModel.php';

class UsuarioController extends BaseController {
    public function __construct() {
        $this->layout = "admin_layout";
        parent::__construct();
    }

    public function initLogin(){
        if(isset($_POST['txtUser']) && isset($_POST['txtPassword'])){
            $user = trim($_POST['txtUser']) ?? null;
            $password = trim($_POST['txtPassword']) ?? null;
                if($user != "" && $password != ""){
                    // Se valida la existencia del usuario y constraseña en al BD
                    $loginObj = new UsuarioModel();
                    $resp = $loginObj->validarLogin($user, $password);
                    if($resp){
                        $this->redirectTo('/main');
                    }else{
                        $errors = "El usuario y/o contraseña incorrectos";
                    }
                } else {
                    $errors = "El usuario y/o contraseña no pueden ser vacíos";
                    
                }
                $data = [
                    'errors' => $errors
                ];
                $this->render('login/login.php', $data);
        } else {
            $this->render('login/login.php');
        }
    }

    public function view() {
        $usuarioObj = new UsuarioModel();
        $usuarios = $usuarioObj->getAll();
        $data = [
            "usuarios" => $usuarios,
            "title" => "Usuarios"
        ];
        $this->render('usuario/viewUsuario.php', $data);
    }

    public function viewOne($id) {
        $usuarioObj = new UsuarioModel();
        $usuarioInfo = $usuarioObj->getUsuario($id);
        
        $data = [
            "usuario" => $usuarioInfo,
            "title" => "Detalles del Usuario"
        ];
        $this->render('usuario/viewOneUsuario.php', $data);
    }

    // Nuevo método para ver el perfil del usuario
    public function viewProfile($id = null) {
        // Si no se proporciona ID, usar el ID de la sesión
        $profileId = $id ?? $_SESSION['id'];
        
        $usuarioObj = new UsuarioModel();
        $profileData = $usuarioObj->getProfileData($profileId);
        
        if (!$profileData) {
            $this->render('error/not_found', [
                'message' => 'Usuario no encontrado',
                'title' => 'Error'
            ]);
            return;
        }
        
        $data = [
            "profileData" => $profileData,
            "title" => "Perfil de " . $profileData->nombre
        ];
        $this->render('usuario/viewProfile.php', $data);
    }

    // Nuevo método para cambiar contraseña
    public function changePassword($id) {
        // Verificar que el usuario solo pueda cambiar su propia contraseña
        // a menos que sea admin
        if ($_SESSION['id'] != $id && $_SESSION['rol'] != 'super_admin') {
            $this->redirectTo('/usuario/viewProfile/'.$_SESSION['id']);
            return;
        }
        
        $usuarioObj = new UsuarioModel();
        $usuarioInfo = $usuarioObj->getUsuario($id);
        
        $data = [
            "usuario" => $usuarioInfo,
            "title" => "Cambiar Contraseña"
        ];
        $this->render('usuario/changePassword.php', $data);
    }

    // Nuevo método para actualizar la contraseña
    public function updatePassword() {
        if (isset($_POST['txtId'], $_POST['txtCurrentPassword'], $_POST['txtNewPassword'], $_POST['txtConfirmPassword'])) {
            $id = $_POST['txtId'];
            $currentPassword = $_POST['txtCurrentPassword'];
            $newPassword = $_POST['txtNewPassword'];
            $confirmPassword = $_POST['txtConfirmPassword'];
            
            // Validar que las nuevas contraseñas coincidan
            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = "Las contraseñas nuevas no coinciden";
                $this->redirectTo('/usuario/changePassword/'.$id);
                return;
            }
            
            $usuarioObj = new UsuarioModel();
            $usuario = $usuarioObj->getUsuario($id);
            
            // Verificar contraseña actual (excepto para super_admin)
            if ($_SESSION['rol'] != 'super_admin' && !password_verify($currentPassword, $usuario->password)) {
                $_SESSION['error'] = "La contraseña actual es incorrecta";
                $this->redirectTo('/usuario/changePassword/'.$id);
                return;
            }
            
            // Actualizar contraseña
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $usuarioObj->editUsuario($id, $usuario->nombre, $usuario->email, $hashedPassword, $usuario->rol);
            
            $_SESSION['success'] = "Contraseña actualizada correctamente";
            $this->redirectTo('/usuario/viewProfile/'.$id);
        }
    }

    public function new() {
        $data = [
            "title" => "Nuevo Usuario",
        ];
        $this->render('usuario/newUsuario.php', $data);
    }

    public function create() {
        if (isset($_POST['txtNombre'], $_POST['txtEmail'], $_POST['txtPassword'], $_POST['txtRol'])) {
            $nombre = $_POST['txtNombre'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $password = $_POST['txtPassword'] ?? null;
            $rol = $_POST['txtRol'] ?? null;
            $usuarioObj = new UsuarioModel();
            $usuarioObj->saveUsuario($nombre, $email, $password, $rol);
            $this->redirectTo("usuario/view");
        }
    }

    public function edit($id) {
        $usuarioObj = new UsuarioModel();
        $usuarioInfo = $usuarioObj->getUsuario($id);
        $data = [
            "usuario" => $usuarioInfo,
            "title" => "Editar Usuario"
        ];
        $this->render('usuario/editUsuario.php', $data);
    }

    public function update() {
        if (isset($_POST['txtId'], $_POST['txtNombre'], $_POST['txtEmail'], $_POST['txtPassword'], $_POST['txtRol'])) {
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            $email = $_POST['txtEmail'] ?? null;
            $password = $_POST['txtPassword'] ?? null;
            $rol = $_POST['txtRol'] ?? null;
            $usuarioObj = new UsuarioModel();
            $usuarioObj->editUsuario($id, $nombre, $email, $password, $rol);
            $this->redirectTo("usuario/view");
        }
    }

    public function delete($id) {
        $usuarioObj = new UsuarioModel();
        $usuarioInfo = $usuarioObj->getUsuario($id);
        $data = [
            "usuario" => $usuarioInfo,
            "title" => "Eliminar Usuario"
        ];
        $this->render('usuario/deleteUsuario.php', $data);
    }

    public function remove() {
        if (isset($_POST['txtId'])) {
            $id = $_POST['txtId'] ?? null;
            $usuarioObj = new UsuarioModel();
            $usuarioObj->removeUsuario($id);
            $this->redirectTo("usuario/view");
        }
    }
}