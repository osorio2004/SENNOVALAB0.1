<?php

namespace App\Controllers;

use App\Models\DocumentoFormatoModel;
use App\Models\ProcesoModel;
use App\Models\TipoDocumentalModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE . '../models/DocumentoFormatoModel.php';
require_once MAIN_APP_ROUTE . '../models/ProcesoModel.php';
require_once MAIN_APP_ROUTE . '../models/TipoDocumentalModel.php';

class TipoDocumentalController extends BaseController {
    public function __construct() {
        $this->layout = "admin_layout";
        parent::__construct();
    }

    public function view() {
        $tipoDocumentalObj = new TipoDocumentalModel();
        $tiposDocumentales = $tipoDocumentalObj->getAll();
        $data = [
            "tiposDocumentales" => $tiposDocumentales,
            "title" => "Tipos Documentales"
        ];
        $this->render('tipoDocumental/viewTipoDocumental.php', $data);
    }

    public function viewOne($id) {
        $tipoDocumentalObj = new TipoDocumentalModel();
        $tipoDocumental = $tipoDocumentalObj->getTipoDocumental($id);
        $data = [
            "tipoDocumental" => $tipoDocumental,
            "title" => "Detalle Tipo Documental"
        ];
        $this->render('tipoDocumental/viewOneTipoDocumental.php', $data);
    }

    public function new() {
        $data = ["title" => "Nuevo Tipo Documental"];
        $this->render('tipoDocumental/newTipoDocumental.php', $data);
    }

    public function create() {
        if (isset($_POST['txtNombre'])) {
            $nombre = $_POST['txtNombre'] ?? null;

            $tipoDocumentalObj = new TipoDocumentalModel();
            $tipoDocumentalObj->saveTipoDocumental($nombre);
            $this->redirectTo("tipoDocumental/view");
        }
    }

    public function edit($id) {
        $tipoDocumentalObj = new TipoDocumentalModel();
        $tipoDocumental = $tipoDocumentalObj->getTipoDocumental($id);
        $data = [
            "tipoDocumental" => $tipoDocumental,
            "title" => "Editar Tipo Documental"
        ];
        $this->render('tipoDocumental/editTipoDocumental.php', $data);
    }

    public function update() {
        if (isset($_POST['txtId'], $_POST['txtNombre'])) {
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;

            $tipoDocumentalObj = new TipoDocumentalModel();
            $tipoDocumentalObj->editTipoDocumental($id, $nombre);
            $this->redirectTo("tipoDocumental/view");
        }
    }

    public function delete($id) {
        $tipoDocumentalObj = new TipoDocumentalModel();
        $tipoDocumental = $tipoDocumentalObj->getTipoDocumental($id);
        $data = [
            "tipoDocumental" => $tipoDocumental,
            "title" => "Eliminar Tipo Documental"
        ];
        $this->render('tipoDocumental/deleteTipoDocumental.php', $data);
    }

    public function remove() {
        if (isset($_POST['txtId'])) {
            $id = $_POST['txtId'] ?? null;

            $tipoDocumentalObj = new TipoDocumentalModel();
            $tipoDocumentalObj->removeTipoDocumental($id);
            $this->redirectTo("tipoDocumental/view");
        }
    }
}
