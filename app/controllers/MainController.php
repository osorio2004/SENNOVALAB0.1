<?php

namespace App\Controllers;

require_once 'baseController.php';

class MainController extends BaseController {
    public function __construct() {
        $this->layout = "admin_layout"; // Usar el layout de admin
        parent::__construct();
    }

    public function view() {
        $data = [
            "title" => "Página Principal"
        ];
        $this->render('main/welcome.php', $data); // Renderizar la vista de bienvenida
    }
}