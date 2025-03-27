<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

require_once MAIN_APP_ROUTE . '../controllers/BaseController.php';
require_once MAIN_APP_ROUTE . '../models/UsuarioModel.php';

class LoginController extends BaseController
{
    public function __construct()
    {
        $this->layout = "login_layout";
    }

    public function initLogin()
    {
        if (isset($_POST['txtUser']) && isset($_POST['txtPassword'])) {
            $user = trim($_POST['txtUser']) ?? null;
            $password = trim($_POST['txtPassword']) ?? null;
            if ($user != "" && $password != "") {
                // Se valida la existencia del usuario y constraseña en al BD
                $loginObj = new UsuarioModel();
                $resp = $loginObj->validarLogin($user, $password);
                if ($resp) {
                    $_SESSION['timeout'] = time(); // Añadir esta línea
                    $this->redirectTo('main');
                } else {
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
    public function logoutLogin()
    {
        session_destroy();
        header('Location: /login/init');
    }
}
