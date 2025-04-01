<?php
namespace App\Controllers;
use App\Models\TipoDocModel;
require_once "baseController.php";
require_once MAIN_APP_ROUTE."../models/TipoDocModel.php";

class TipoDocController extends BaseController {
    public function __construct() {
        parent::__construct();
        $this->layout = "doc_layout"; // Cambiamos el layout por defecto
    }
    
    public function index(){
        $this->view();
    }     
    
    public function view(){
        $tipoDocObj = new TipoDocModel();
        $tiposDocs = $tipoDocObj->getAll();
        $data = [
            "tiposDocs" => $tiposDocs,
            "titulo" => "Lista de procesos"
        ];
        $this->render('tipoDoc/view.php', $data);
    }

    public function new(){
        $this->render('tipoDoc/new.php', ["titulo" => "Nuevo Tipo de Documento"]);
    }

    public function create(){
        if (isset($_POST["txtNombre"])) {
            $nombre = $_POST["txtNombre"] ?? null;
            $descripcion = $_POST["txtDescripcion"] ?? null;
            $tipoDocObj = new TipoDocModel();
            $tipoDocObj->saveTipoDoc($nombre, $descripcion);
            $this->redirectTo("tipoDocUse/view");
        }
    }

    public function viewOne($id){
        $tipoDocObj = new TipoDocModel();
        $tipoDocInfo = $tipoDocObj->getTipoDoc($id);
        $data = [
            "tipoDoc" => $tipoDocInfo,
            "titulo" => "Ver un Tipo de Documento"
        ];
        $this->render("tipoDoc/viewOne.php", $data);
    }

    public function edit($id){
        $tipoDocObj = new TipoDocModel();
        $tipoDocInfo = $tipoDocObj->getTipoDoc($id);
        $data = [
            "tipoDoc" => $tipoDocInfo,
            "titulo" => "Editar Tipo de Documento"
        ];
        $this->render("tipoDoc/edit.php", $data);
    }

    public function update(){
        if (isset($_POST["txtNombre"])) {
            $id = $_POST["txtId"] ?? null;
            $nombre = $_POST["txtNombre"] ?? null;
            $descripcion = $_POST["txtDescripcion"] ?? null;
            $tipoDocObj = new TipoDocModel();
            $tipoDocObj->editTipoDoc($id, $nombre, $descripcion);
        }
        $this->redirectTo("tipoDocUse/view");
    }

    public function delete($id){
        $tipoDocObj = new TipoDocModel();
        $tipoDocObj->deleteTipoDoc($id);
        $this->redirectTo("tipoDocUse/view");
    }
}