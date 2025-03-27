<?php
namespace App\Controllers;
use App\Models\ClasiDocModel;

require_once __DIR__ . "/BaseController.php";
require_once __DIR__ . "/../models/ClasifiModel.php";

class ClasiDocController extends BaseController {
    public function __construct() {
        parent::__construct();
        $this->layout = "doc_layout";
    }
    
    public function index(){
        $this->view();
    }     
    
    
public function view(){
    $clasiDocObj = new ClasiDocModel();
    $clasiDocs = $clasiDocObj->getAll();
    
    $data = [
        "clasiDocs" => $clasiDocs,
        "titulo" => "Lista de Clasificación de Documentos"
    ];
    $this->layout = "classification_layout";
    $this->render('clasiDoc/view.php', $data);
}

public function new() {
    $data = [
        "titulo" => "Nuevo Documento",
        "layout" => "classification_layout"
    ];
    $this->layout = "classification_layout";
    $this->render('clasiDoc/newClasificacionDoc.php', $data);
}

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clasiDocObj = new ClasiDocModel();
            
            $data = [
                'id' => $_POST['id'],
                'creo' => $_SESSION['usuario'] ?? '',
                'codigo' => $_POST['codigo'],
                'version' => $_POST['version'],
                'nombre' => $_POST['nombre'],
                'elaborado_por' => $_POST['elaborado_por'],
                'revisado_por' => $_POST['revisado_por'],
                'aprobado_por' => $_POST['aprobado_por'],
                'proceso' => $_POST['proceso'],
                'subproceso' => $_POST['subproceso'],
                'clasificacion' => $_POST['clasificacion']
            ];
    
            $clasiDocObj->saveNewDoc($data);
            $this->redirectTo("clasiDoc/view");
        }
    }

    public function viewOne($id){
        $clasiDocObj = new ClasiDocModel();
        $clasiDocInfo = $clasiDocObj->getClasiDoc($id);
        $data = [
            "clasiDoc" => $clasiDocInfo,
            "titulo" => "Ver una Clasificación de Documento"
        ];
        $this->render("clasiDoc/viewOne.php", $data);
    }

    public function edit($id) {
        $clasiDocObj = new ClasiDocModel();
        $clasiDoc = $clasiDocObj->getClasiDoc($id);
        
        if (!$clasiDoc) {
            // Si no se encuentra el documento, redirigir a la vista principal
            $this->redirectTo("clasiDoc/view");
            return;
        }
    
        $data = [
            "clasiDoc" => $clasiDoc,
            "titulo" => "Editar Clasificación de Documento"
        ];
        
        $this->layout = "classification_layout";
        $this->render('clasiDoc/editCla.php', $data);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST["txtId"] ?? null;
            $data = [
                'codigo' => $_POST['codigo'],
                'version' => $_POST['version'],
                'nombre' => $_POST['nombre'],
                'proceso' => $_POST['proceso'],
                'subproceso' => $_POST['subproceso'],
                'clasificacion' => $_POST['clasificacion']
            ];
            
            $clasiDocObj = new ClasiDocModel();
            $clasiDocObj->updateDoc($id, $data);
            $this->redirectTo("clasiDoc/view");
        }
    }

    public function delete($id){
        $clasiDocObj = new ClasiDocModel();
        $clasiDocObj->deleteClasiDoc($id);
        $this->redirectTo("clasiDoc/view");
    }
}