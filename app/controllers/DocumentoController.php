<?php

namespace App\Controllers;

use App\Models\DocumentoModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE . '../models/DocumentoModel.php';

class DocumentosController extends BaseController {
    public function __construct() {
        $this->layout = "admin_layout"; // Usar el layout de admin
        parent::__construct();
    }

    public function view() {
        $documentoObj = new DocumentoModel();
        $documentos = $documentoObj->getAll();
        $data = [
            "documentos" => $documentos,
            "titulo" => "Documentos"
        ];
        $this->render('documento/viewDocumento.php', $data); // Cambia la vista según tu estructura
    }


    public function create() {
        if (isset($_POST['txtTitulo'], $_POST['txtFechaCreacion'], $_POST['txtFechaEdicion'], $_POST['txtEstado'], $_POST['txtIdUsuarioCreador'], $_POST['txtIdCategoria'], $_POST['txtCodigo'], $_POST['txtVersion'], $_POST['txtIdUsuarioAprobo'], $_POST['txtIdUsuarioElaboro'])) {
            $titulo = $_POST['txtTitulo'] ?? null;
            $fechaCreacion = $_POST['txtFechaCreacion'] ?? null;
            $fechaEdicion = $_POST['txtFechaEdicion'] ?? null;
            $estado = $_POST['txtEstado'] ?? null;
            $idUsuarioCreador = $_POST['txtIdUsuarioCreador'] ?? null;
            $idCategoria = $_POST['txtIdCategoria'] ?? null;
            $codigo = $_POST['txtCodigo'] ?? null;
            $version = $_POST['txtVersion'] ?? null;
            $idUsuarioAprobo = $_POST['txtIdUsuarioAprobo'] ?? null;
            $idUsuarioElaboro = $_POST['txtIdUsuarioElaboro'] ?? null;

            $documentoObj = new DocumentoModel();
            $documentoObj->saveDocumento($titulo, $fechaCreacion, $fechaEdicion, $estado, $idUsuarioCreador, $idCategoria, $codigo, $version, $idUsuarioAprobo, $idUsuarioElaboro);
            $this->redirectTo("documento/view");
        }
    }

    public function edit($id) {
        $documentoObj = new DocumentoModel();
        $documentoInfo = $documentoObj->getDocumento($id);
        $data = [
            "documento" => $documentoInfo,
            "title" => "Editar Documento"
        ];
        $this->render('documento/editDocumento.php', $data);
    }

    public function update() {
        if (isset($_POST['txtId'], $_POST['txtTitulo'], $_POST['txtFechaCreacion'], $_POST['txtFechaEdicion'], $_POST['txtEstado'], $_POST['txtIdUsuarioCreador'], $_POST['txtIdCategoria'], $_POST['txtCodigo'], $_POST['txtVersion'], $_POST['txtIdUsuarioAprobo'], $_POST['txtIdUsuarioElaboro'])) {
            $id = $_POST['txtId'] ?? null;
            $titulo = $_POST['txtTitulo'] ?? null;
            $fechaCreacion = $_POST['txtFechaCreacion'] ?? null;
            $fechaEdicion = $_POST['txtFechaEdicion'] ?? null;
            $estado = $_POST['txtEstado'] ?? null;
            $idUsuarioCreador = $_POST['txtIdUsuarioCreador'] ?? null;
            $idCategoria = $_POST['txtIdCategoria'] ?? null;
            $codigo = $_POST['txtCodigo'] ?? null;
            $version = $_POST['txtVersion'] ?? null;
            $idUsuarioAprobo = $_POST['txtIdUsuarioAprobo'] ?? null;
            $idUsuarioElaboro = $_POST['txtIdUsuarioElaboro'] ?? null;

            $documentoObj = new DocumentoModel();
            $documentoObj->editDocumento($id, $titulo, $fechaCreacion, $fechaEdicion, $estado, $idUsuarioCreador, $idCategoria, $codigo, $version, $idUsuarioAprobo, $idUsuarioElaboro);
            $this->redirectTo("documento/view");
        }
    }

    public function delete($id) {
        $documentoObj = new DocumentoModel();
        $documentoInfo = $documentoObj->getDocumento($id);
        $data = [
            "documento" => $documentoInfo,
            "title" => "Eliminar Documento"
        ];
        $this->render('documento/deleteDocumento.php', $data);
    }

    public function remove() {
        if (isset($_POST['txtId'])) {
            $id = $_POST['txtId'] ?? null;
            $documentoObj = new DocumentoModel();
            $documentoObj->removeDocumento($id);
            $this->redirectTo("documento/view");
        }
    }
}