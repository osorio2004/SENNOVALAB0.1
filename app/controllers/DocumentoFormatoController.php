<?php

namespace App\Controllers;

use App\Models\DocumentoFormatoModel;
use App\Models\ProcesoModel;
use App\Models\TipoDocumentalModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE . '../models/DocumentoFormatoModel.php';

class DocumentoFormatoController extends BaseController {
    public function __construct() {
        $this->layout = "admin_layout"; // Usar el layout de admin
        parent::__construct();
    }

    public function view() {
        $documentoFormatoObj = new DocumentoFormatoModel();
        $formatos = $documentoFormatoObj->getAll(); // ahora se llama formatos
        $data = [
            "formatos" => $formatos, // pasa la variable formatos
            "title" => "Documentos Formato"
        ];
        $this->render('documentoFormato/viewDocumentoFormato.php', $data);
    }

    public function viewOne($id) {
        $documentoFormatoObj = new DocumentoFormatoModel();
        $documentoFormatoInfo = $documentoFormatoObj->getDocumentoFormato($id);

        $data = [
            "documentoFormato" => $documentoFormatoInfo,
            "title" => "Detalle Documento Formato"
        ];
        $this->render('documentoFormato/viewOneDocumentoFormato.php', $data);
    }

    public function new() {
        $procesoModel = new ProcesoModel();
        $procesos = $procesoModel->getAll();

        $tipoDocumentalModel = new TipoDocumentalModel();
        $tiposDocumentales = $tipoDocumentalModel->getAll();

        $data = [
            "title" => "Nuevo Documento Formato",
            "procesos" => $procesos,
            "tiposDocumentales" => $tiposDocumentales
        ];
        $this->render('documentoFormato/newDocumentoFormato.php', $data);
    }

    public function create() {
        if (isset($_POST['txtCodigo'], $_POST['txtNombre'], $_POST['txtTipo'], $_POST['txtTipoDocFormato'], $_POST['txtFkProceso'], $_POST['txtFkTipoDocumental'])) {
            $codigo = $_POST['txtCodigo'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            $tipo = $_POST['txtTipo'] ?? null;
            $tipo_doc_formato = $_POST['txtTipoDocFormato'] ?? null;
            $fkProceso = $_POST['txtFkProceso'] ?? null;
            $fkTipoDocumental = $_POST['txtFkTipoDocumental'] ?? null;

            $documentoFormatoObj = new DocumentoFormatoModel();
            $documentoFormatoObj->saveDocumentoFormato($codigo, $nombre, $tipo, $tipo_doc_formato, $fkProceso, $fkTipoDocumental);
            $this->redirectTo("documentoFormato/view");
        }
    }

    public function edit($id) {
        $documentoFormatoObj = new DocumentoFormatoModel();
        $documentoFormatoInfo = $documentoFormatoObj->getDocumentoFormato($id);

        $procesoModel = new ProcesoModel();
        $procesos = $procesoModel->getAll();

        $tipoDocumentalModel = new TipoDocumentalModel();
        $tiposDocumentales = $tipoDocumentalModel->getAll();

        $data = [
            "documentoFormato" => $documentoFormatoInfo,
            "title" => "Editar Documento Formato",
            "procesos" => $procesos,
            "tiposDocumentales" => $tiposDocumentales
        ];
        $this->render('documentoFormato/editDocumentoFormato.php', $data);
    }

    public function update() {
        if (isset($_POST['txtId'], $_POST['txtCodigo'], $_POST['txtNombre'], $_POST['txtTipo'], $_POST['txtTipoDocFormato'], $_POST['txtFkProceso'], $_POST['txtFkTipoDocumental'])) {
            $id = $_POST['txtId'] ?? null;
            $codigo = $_POST['txtCodigo'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            $tipo = $_POST['txtTipo'] ?? null;
            $tipo_doc_formato = $_POST['txtTipoDocFormato'] ?? null;
            $fkProceso = $_POST['txtFkProceso'] ?? null;
            $fkTipoDocumental = $_POST['txtFkTipoDocumental'] ?? null;

            $documentoFormatoObj = new DocumentoFormatoModel();
            $documentoFormatoObj->editDocumentoFormato($id, $codigo, $nombre, $tipo, $tipo_doc_formato, $fkProceso, $fkTipoDocumental);
            $this->redirectTo("documentoFormato/view");
        }
    }

    public function delete($id) {
        $documentoFormatoObj = new DocumentoFormatoModel();
        $documentoFormatoInfo = $documentoFormatoObj->getDocumentoFormato($id);
        $data = [
            "documentoFormato" => $documentoFormatoInfo,
            "title" => "Eliminar Documento Formato"
        ];
        $this->render('documentoFormato/deleteDocumentoFormato.php', $data);
    }

    public function remove() {
        if (isset($_POST['txtId'])) {
            $id = $_POST['txtId'] ?? null;
            $documentoFormatoObj = new DocumentoFormatoModel();
            $documentoFormatoObj->removeDocumentoFormato($id);
            $this->redirectTo("documentoFormato/view");
        }
    }
}
