<?php
class AñadirCategoriaController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index() {
        // Mostrar el formulario para añadir categoría
        include_once __DIR__ . '/../views/añadirCategoriaView.php';
    }

    public function agregarCategoria() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $descripcion = trim($_POST['descripcion']);

            // Validaciones
            if (empty($nombre)) {
                $error = "El nombre de la categoría es obligatorio.";
                include_once __DIR__ . '/../views/añadirCategoriaView.php';
                return;
            }

            if ($this->model->categoriaExiste($nombre)) {
                $error = "Ya existe una categoría con ese nombre.";
                include_once __DIR__ . '/../views/añadirCategoriaView.php';
                return;
            }

            // Intentar agregar la categoría
            if ($this->model->agregarCategoria($nombre, $descripcion)) {
                $success = "Categoría añadida correctamente.";
                include_once __DIR__ . '/../views/añadirCategoriaView.php';
            } else {
                $error = "Error al añadir la categoría.";
                include_once __DIR__ . '/../views/añadirCategoriaView.php';
            }
        } else {
            // Redirigir si no es POST
            header("Location: /añadirCategoria/view");
        }
    }
}
?>