<?php

namespace App\Controllers;

use App\Models\AnexoModel;
use App\Models\ProcesoModel;

require_once 'baseController.php';
require_once MAIN_APP_ROUTE . '../models/AnexoModel.php';

class AnexoController extends BaseController
{
    public function __construct()
    {
        $this->layout = "admin_layout";
        parent::__construct();
    }

    public function view()
    {
        $anexoObj = new AnexoModel();
        $procesoModel = new ProcesoModel(); // Cargar el modelo de Proceso
        $anexos = $anexoObj->getAll();

        // Obtener todos los procesos para poder mapear la sigla
        $procesos = $procesoModel->getAll();
        $procesoMap = [];

        // Crear un mapa de procesos por ID
        foreach ($procesos as $proceso) {
            $procesoMap[$proceso->idproceso] = $proceso->siglaCod; // Mapeamos la sigla por ID
        }

        $data = [
            "anexos" => $anexos,
            "procesoMap" => $procesoMap, // Pasar el mapa de procesos a la vista
            "title" => "Anexos"
        ];
        $this->render('anexo/viewAnexo.php', $data);
    }
    
    public function viewOne($id)
    {
        $anexoObj = new AnexoModel();
        $procesoModel = new ProcesoModel();

        $anexo = $anexoObj->getAnexo($id);
        $procesos = $procesoModel->getAll();

        // Crear mapa de procesos para mostrar la sigla
        $procesoMap = [];
        foreach ($procesos as $proceso) {
            $procesoMap[$proceso->idproceso] = $proceso->siglaCod;
        }

        $data = [
            "anexo" => $anexo,
            "procesoMap" => $procesoMap,
            "title" => "Detalle del Anexo"
        ];

        $this->render('anexo/viewOneAnexo.php', $data);
    }

    public function new()
    {
        $procesoModel = new ProcesoModel();
        $procesos = $procesoModel->getAll(); // Obtener todos los procesos

        $data = [
            "title" => "Nuevo Anexo",
            "procesos" => $procesos // Pasar los procesos a la vista
        ];
        $this->render('anexo/newAnexo.php', $data);
    }
    public function create()
    {
        if (isset($_POST['txtNombre'], $_POST['txtFecha'], $_POST['procesoId']) && isset($_FILES['archivo'])) {
            $nombre = $_POST['txtNombre'];
            $fecha = $_POST['txtFecha'];
            $procesoId = $_POST['procesoId'];
            $archivo = $_FILES['archivo'];

            if ($archivo['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = basename($archivo['name']);
                $archivoTmp = $archivo['tmp_name'];
                $mimeType = mime_content_type($archivoTmp);
                $nombreUnico = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $nombreArchivo);

                $supabaseUrl = 'https://canzxiiywvxkfrfleqeh.supabase.co';
                $supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImNhbnp4aWl5d3Z4a2ZyZmxlcWVoIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDg4NzQwNDAsImV4cCI6MjA2NDQ1MDA0MH0.icK_XzY9XOVdybcWmFi0YYQQYoS_2_dFLsDKU7UhxZg'; // tu clave larga
                $bucket = 'files';

                // Leer contenido del archivo
                $contenidoArchivo = file_get_contents($archivoTmp);
                if (!$contenidoArchivo) {
                    echo "Error al leer el archivo temporal.";
                    return;
                }

                // Subir a Supabase
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "$supabaseUrl/storage/v1/object/$bucket/$nombreUnico");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $contenidoArchivo);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Authorization: Bearer $supabaseKey",
                    "Content-Type: $mimeType",
                    "x-upsert: true"
                ]);

                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                if ($httpCode >= 200 && $httpCode < 300) {
                    $rutaArchivo = "$supabaseUrl/storage/v1/object/public/$bucket/$nombreUnico";
                    $anexoObj = new AnexoModel();
                    $anexoObj->saveAnexo($nombre, $fecha, $rutaArchivo, $procesoId);
                    $this->redirectTo("anexo/view");
                } else {
                    echo "Error al subir el archivo a Supabase. Código: $httpCode";
                    echo "<pre>$response</pre>"; // 👈 muestra detalle del error
                }
            } else {
                echo "Error al subir el archivo.";
            }
        } else {
            echo "Todos los campos son requeridos.";
        }
    }

    public function edit($id)
    {
        $anexoObj = new AnexoModel();
        $anexoInfo = $anexoObj->getAnexo($id);
        $data = [
            "anexo" => $anexoInfo,
            "title" => "Editar Anexo"
        ];
        $this->render('anexo/editAnexo.php', $data);
    }

    public function update()
    {
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

    public function delete($id)
    {
        $anexoObj = new AnexoModel();
        $anexoInfo = $anexoObj->getAnexo($id);
        $data = [
            "anexo" => $anexoInfo,
            "title" => "Eliminar Anexo"
        ];
        $this->render('anexo/deleteAnexo.php', $data);
    }

    public function remove()
    {
        if (isset($_POST['txtId'])) {
            $id = $_POST['txtId'] ?? null;
            $anexoObj = new AnexoModel();
            $anexoObj->removeAnexo($id);
            $this->redirectTo("anexo/view");
        }
    }
}
