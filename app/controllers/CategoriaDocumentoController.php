<?php

namespace App\Controllers;

use App\Models\CategoriaDocumentoModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE . '../models/CategoriaDocumentoModel.php';

class CategoriaDocumentoController extends BaseController
{
    public function __construct()
    {
        $this->layout = "admin_layout";
        parent::__construct();
    }

    public function view()
    {
        $categoriaObj = new CategoriaDocumentoModel();
        $categorias = $categoriaObj->getAll();
        $data = [
            "categorias" => $categorias,
            "title" => "Categorías de Documentos"
        ];
        $this->render('categoriadocumento/viewCategoriaDocumento.php', $data);
    }

    public function new()
    {
        $data = [
            "title" => "Nueva Categoría de Documento"
        ];
        $this->render('categoriadocumento/newCategoriaDocumento.php', $data);
    }

    public function create()
    {
        if (isset($_POST['txtNombre'], $_POST['txtDescripcion'])) {
            $nombre = $_POST['txtNombre'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $categoriaObj = new CategoriaDocumentoModel();
            $categoriaObj->saveCategoria($nombre, $descripcion);
            $this->redirectTo("categoriadocumento/view");
        }
    }

    public function edit($id)
    {
        $categoriaObj = new CategoriaDocumentoModel();
        $categoriaInfo = $categoriaObj->getCategoria($id);
        $data = [
            "categoria" => $categoriaInfo,
            "title" => "Editar Categoría de Documento"
        ];
        $this->render('categoriadocumento/editCategoriaDocumento.php', $data);
    }

    public function update()
    {
        if (isset($_POST['txtId'], $_POST['txtNombre'], $_POST['txtDescripcion'])) {
            $id = $_POST['txtId'] ?? null;
            $nombre = $_POST['txtNombre'] ?? null;
            $descripcion = $_POST['txtDescripcion'] ?? null;
            $categoriaObj = new CategoriaDocumentoModel();
            $categoriaObj->editCategoria($id, $nombre, $descripcion);
            $this->redirectTo("categoriadocumento/view");
        }
    }

    public function delete($id)
    {
        $categoriaObj = new CategoriaDocumentoModel();
        $categoriaInfo = $categoriaObj->getCategoria($id);
        $data = [
            "categoria" => $categoriaInfo,
            "title" => "Eliminar Categoría de Documento"
        ];
        $this->render('categoriadocumento/deleteCategoriaDocumento.php', $data);
    }

    public function remove()
    {
        if (isset($_POST['txtId'])) {
            $id = $_POST['txtId'] ?? null;
            $categoriaObj = new CategoriaDocumentoModel();
            $categoriaObj->removeCategoria($id);
            $this->redirectTo("categoriadocumento/view");
        }
    }
}
