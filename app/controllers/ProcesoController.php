<?php

namespace App\Controllers;

use App\Models\ProcesoModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE . '../models/ProcesoModel.php';

class ProcesoController extends BaseController {
    public function __construct() {
        $this->layout = "admin_layout";
        parent::__construct();
    }

    public function view() {
        $procesoObj = new ProcesoModel();
        $procesos = $procesoObj->getAll();
        $data = [
            "procesos" => $procesos,
            "title" => "Procesos"
        ];
        $this->render('proceso/viewProceso.php', $data);
    }

    public function viewOne($id) {
        $procesoObj = new ProcesoModel();
        $procesoInfo = $procesoObj->getProceso($id);

        $data = [
            "proceso" => $procesoInfo,
            "title" => "Detalles del Proceso"
        ];
        $this->render('proceso/viewOneProceso.php', $data);
    }

    public function new() {
        $data = [
            "title" => "Nuevo Proceso",
        ];
        $this->render('proceso/newProceso.php', $data);
    }

    public function create() {
        if (isset($_POST['txtNombre'], $_POST['txtSiglaCod'])) {
            $nombre = $_POST['txtNombre'] ?? null;
            $siglaCod = $_POST['txtSiglaCod'] ?? null;
            $procesoObj = new ProcesoModel();
            $procesoObj->saveProceso($nombre, $siglaCod);
            $this->redirectTo("proceso/view");
        }
    }

    public function edit($id) {
        $procesoObj = new ProcesoModel();
        $procesoInfo = $procesoObj->getProceso($id);
        $data = [
            "proceso" => $procesoInfo,
            "title" => "Editar Proceso"
        ];
        $this->render('proceso/editProceso.php', $data);
    }

    public function update() {
        if (isset($_POST['txtId'], $_POST['txtNombre'], $_POST['txtSiglaCod'])) {
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            $siglaCod = $_POST['txtSiglaCod'] ?? null;
            $procesoObj = new ProcesoModel();
            $procesoObj->editProceso($id, $nombre, $siglaCod);
            $this->redirectTo("proceso/view");
        }
    }

    public function delete($id) {
        $procesoObj = new ProcesoModel();
        $procesoInfo = $procesoObj->getProceso($id);
        $data = [
            "proceso" => $procesoInfo,
            "title" => "Eliminar Proceso"
        ];
        $this->render('proceso/deleteProceso.php', $data);
    }

    public function remove() {
        if (isset($_POST['txtId'])) {
            $id = $_POST['txtId'] ?? null;
            $procesoObj = new ProcesoModel();
            $procesoObj->removeProceso($id);
            $this->redirectTo("proceso/view");
        }
    }
}
