<?php
// Cargar la configuración global
require_once '../app/config/global.php';

// Cargar los controladores necesarios
require_once '../app/controllers/LoginController.php';
require_once '../app/controllers/UsuarioController.php';
require_once '../app/controllers/MainController.php';
require_once '../app/controllers/CategoriaDocumentoController.php';
require_once '../app/controllers/tipoDocController.php';
require_once '../app/controllers/ProcesoController.php';
require_once '../app/controllers/DocumentoFormatoController.php';
require_once '../app/controllers/TipoDocumentalController.php';
require_once '../app/controllers/AnexoController.php';

// Obtener la URL solicitada
$url = $_SERVER['REQUEST_URI'];

// Cargar las rutas definidas
$routes = include_once '../app/config/routes.php';

// Inicializar la variable para la ruta coincidente
$matchedRoute = null;

// Buscar la ruta coincidente
foreach ($routes as $route => $routeConfig) {
    if (preg_match("#^$route$#", $url, $matches)) {
        $matchedRoute = $routeConfig;
        break;
    }
}

// Si se encuentra una ruta coincidente, ejecutar el controlador y la acción
if ($matchedRoute) {
    $controllerName = $matchedRoute['controller'];
    $actionName = $matchedRoute['action'];
    if (class_exists($controllerName) && method_exists($controllerName, $actionName)) {
        $parameters = array_slice($matches, 1);
        $controller = new $controllerName();
        // Llamar al método de acción
        $controller->$actionName(...$parameters);
    } else {
        // Manejar el caso donde el controlador o la acción no existen
        echo "Error: Controlador o acción no encontrados.";
    }
} else {
    // Redirigir a la página de inicio de sesión si no se encuentra una ruta coincidente
    header('Location: /login/init');
}