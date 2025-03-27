<?php

namespace App\Controllers;

use App\Models\CentroModel;
use App\Models\RolModel;
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