<?php

namespace App\Controllers;

use App\Models\AnexoModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE . '../models/AnexoModel.php';

class AnexoController extends BaseController {
    public function __construct() {
        $this->layout = "admin_layout";
        parent::__construct();
    }

    public function view() {
        $anexoObj = new AnexoModel();
        $anexos = $anexoObj->getAll();
        $data = [
            "anexos" => $anexos,
            "title" => "Anexos"
        ];
        $this->render('anexo/viewAnexo.php', $data);
    }

    public function viewOne($id) {
        $anexoObj = new AnexoModel();
        $anexoInfo = $anexoObj->getAnexo($id);
        
        $data = [
            "anexo" => $anexoInfo,
            "title" => "Detalles del Anexo"
        ];
        $this->render('anexo/viewOneAnexo.php', $data);
    }

    public function new() {
        $data = [
            "title" => "Nuevo Anexo",
        ];
        $this->render('anexo/newAnexo.php', $data);
    }

    public function create() {
        if (isset($_POST['txtNombre'], $_POST['txtFecha']) && isset($_FILES['archivo'])) {
            $nombre = $_POST['txtNombre'] ?? null;
            $fecha = $_POST['txtFecha'] ?? null;

            // Manejar archivo subido
            $archivo = $_FILES['archivo'];
            $rutaDestino = '';

            if ($archivo['error'] == UPLOAD_ERR_OK) {
                $nombreArchivo = basename($archivo['name']);
                $rutaDestino = 'uploads/' . $nombreArchivo; // Carpeta 'uploads'
                move_uploaded_file($archivo['tmp_name'], MAIN_APP_ROUTE . '../public/' . $rutaDestino);
            }

            $anexoObj = new AnexoModel();
            $anexoObj->saveAnexo($nombre, $fecha, $rutaDestino);
            $this->redirectTo("anexo/view");
        }
    }

    public function edit($id) {
        $anexoObj = new AnexoModel();
        $anexoInfo = $anexoObj->getAnexo($id);
        $data = [
            "anexo" => $anexoInfo,
            "title" => "Editar Anexo"
        ];
        $this->render('anexo/editAnexo.php', $data);
    }

    public function update() {
        if (isset($_POST['txtId'], $_POST['txtNombre'], $_POST['txtFecha'])) {
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            $fecha = $_POST['txtFecha'] ?? null;
            $rutaArchivo = $_POST['rutaActual'] ?? '';

            // Si subieron un nuevo archivo
            if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
                $nombreArchivo = basename($_FILES['archivo']['name']);
                $rutaArchivo = 'uploads/' . $nombreArchivo;
                move_uploaded_file($_FILES['archivo']['tmp_name'], MAIN_APP_ROUTE . '../public/' . $rutaArchivo);
            }

            $anexoObj = new AnexoModel();
            $anexoObj->editAnexo($id, $nombre, $fecha, $rutaArchivo);
            $this->redirectTo("anexo/view");
        }
    }

    public function delete($id) {
        $anexoObj = new AnexoModel();
        $anexoInfo = $anexoObj->getAnexo($id);
        $data = [
            "anexo" => $anexoInfo,
            "title" => "Eliminar Anexo"
        ];
        $this->render('anexo/deleteAnexo.php', $data);
    }

    public function remove() {
        if (isset($_POST['txtId'])) {
            $id = $_POST['txtId'] ?? null;
            $anexoObj = new AnexoModel();
            $anexoObj->removeAnexo($id);
            $this->redirectTo("anexo/view");
        }
    }
}