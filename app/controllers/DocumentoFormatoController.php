<?php

namespace App\Controllers;

use App\Models\DocumentoFormatoModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE . '../models/DocumentoFormatoModel.php';

class DocumentoFormatoController extends BaseController {
    public function __construct() {
        $this->layout = "admin_layout";
        parent::__construct();
    }

    public function view() {
        $formatoObj = new DocumentoFormatoModel();
        $formatos = $formatoObj->getAll();
        $data = [
            "formatos" => $formatos,
            "title" => "Formatos de Documento"
        ];
        $this->render('documentoFormato/viewDocumentoFormato.php', $data);
    }

    public function viewOne($id) {
        $formatoObj = new DocumentoFormatoModel();
        $formatoInfo = $formatoObj->getDocumentoFormato($id);

        $data = [
            "formato" => $formatoInfo,
            "title" => "Detalles del Formato"
        ];
        $this->render('documentoFormato/viewOneDocumentoFormato.php', $data);
    }

    public function new() {
        $data = [
            "title" => "Nuevo Formato de Documento",
        ];
        $this->render('documentoFormato/newDocumentoFormato.php', $data);
    }

    public function create() {
        if (isset($_POST['txtNombre'], $_POST['txtDescripcion'])) {
            $nombre = $_POST['txtNombre'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $formatoObj = new DocumentoFormatoModel();
            $formatoObj->saveDocumentoFormato($nombre, $descripcion);
            $this->redirectTo("documentoFormato/view");
        }
    }

    public function edit($id) {
        $formatoObj = new DocumentoFormatoModel();
        $formatoInfo = $formatoObj->getDocumentoFormato($id);
        $data = [
            "formato" => $formatoInfo,
            "title" => "Editar Formato de Documento"
        ];
        $this->render('documentoFormato/editDocumentoFormato.php', $data);
    }

    public function update() {
        if (isset($_POST['txtId'], $_POST['txtNombre'], $_POST['txtDescripcion'])) {
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $formatoObj = new DocumentoFormatoModel();
            $formatoObj->editDocumentoFormato($id, $nombre, $descripcion);
            $this->redirectTo("documentoFormato/view");
        }
    }

    public function delete($id) {
        $formatoObj = new DocumentoFormatoModel();
        $formatoInfo = $formatoObj->getDocumentoFormato($id);
        $data = [
            "formato" => $formatoInfo,
            "title" => "Eliminar Formato de Documento"
        ];
        $this->render('documentoFormato/deleteDocumentoFormato.php', $data);
    }

    public function remove() {
        if (isset($_POST['txtId'])) {
            $id = $_POST['txtId'] ?? null;
            $formatoObj = new DocumentoFormatoModel();
            $formatoObj->removeDocumentoFormato($id);
            $this->redirectTo("documentoFormato/view");
        }
    }
}
