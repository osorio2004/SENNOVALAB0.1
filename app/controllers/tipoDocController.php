<?php

namespace App\Controllers;

require_once "baseController.php";

class TipoDocController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->layout = "admin_layout"; // Cambiamos el layout por defecto
    }

    public function view()
    {
        $data = [
            "titulo" => "Lista de procesos"
        ];
        $this->render('tipoDoc/view.php', $data);
    }
}
