<?php
session_start(); // Iniciar la sesión

//$db = require __DIR__ . '/../config/index.php';


require __DIR__ .'/../vendor/autoload.php';
require_once __DIR__ . '/../app/models/Usuario.php';
require_once __DIR__ . '/../app/models/Docente.php';
require_once __DIR__ . '/../app/models/Estudiante.php';

use Config\Database;
use App\controllers\AuthController;
use App\controllers\DocenteController;
use App\controllers\EstudianteController;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$databaseConfig = require 'C:\xampp\htdocs\MiproyectoMASP\config\conexion.php';
$database = new Config\Database($databaseConfig['db_host'], $databaseConfig['db_name'], $databaseConfig['db_user'], $databaseConfig['db_pass']);
$db = $database->getConnection();


$loader = new FilesystemLoader(__DIR__. '/../app/views');
$twig = new Environment($loader);

$AuthController = new AuthController($db);
$DocenteController = new DocenteController($twig, $db);
$EstudianteController = new EstudianteController($twig, $db);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Simplificación para probar
if ($uri === '/MiproyectoMASP/public/docente/crear' && $method === 'GET') {
    $DocenteController->mostrarFormularioRegistro();
}elseif ($uri === '/MiproyectoMASP/public/docentes' && $method === 'GET') {
    $DocenteController->listarDocentes();
} elseif ($uri === '/MiproyectoMASP/public/docente/registrar' && $method === 'POST') {
    $DocenteController->registrarDocente();
}elseif (strpos($uri, '/MiproyectoMASP/public/docentes/editar/') === 0 && $method === 'GET') {
    $id = basename($uri); // Obtiene la última parte de la URI (el ID)
    if (is_numeric($id)) {
        $DocenteController->mostrarFormularioEditar($id);
    } else {
        echo "ID de docente no válido en la URL.";
    }
} elseif (strpos($uri, '/MiproyectoMASP/public/docentes/eliminar/') === 0 && $method === 'GET') {
    $id = basename($uri); // Obtiene la última parte de la URI (el ID)
    if (is_numeric($id)) {
        $DocenteController->eliminarDocente($id);
    } else {
        echo "ID de docente no válido en la URL.";
    }
} elseif ($uri === '/MiproyectoMASP/public/docentes/actualizar' && $method === 'POST') {
    $DocenteController->actualizarDocente();
}elseif ($uri === '/MiproyectoMASP/public/registro' && $method === 'GET') {
    $AuthController->mostrarFormularioRegistro();
} elseif ($uri === '/MiproyectoMASP/public/registro' && $method === 'POST') {
    $AuthController->registrarUsuario();
} elseif ($uri === '/MiproyectoMASP/public/login' && $method === 'GET') {
    $AuthController->mostrarFormularioLogin();
} elseif ($uri === '/MiproyectoMASP/public/login' && $method === 'POST') {
    $AuthController->iniciarSesion();
} elseif ($uri === '/MiproyectoMASP/public/logout' && $method === 'GET') {
    $AuthController->cerrarSesion(); // <--- Aquí debes añadir la nueva ruta
}elseif (strpos($uri, '/MiproyectoMASP/public/home') === 0 && $method === 'GET') {
    $AuthController->mostrarHome();
} elseif ($uri === '/login' || $uri === '/') {
} elseif ($uri === '/MiproyectoMASP/public/' && $method === 'GET') {
    header('Location: /MiproyectoMASP/public/home');
    exit();
} elseif ($uri === '/MiproyectoMASP/public/estudiante/crear' && $method === 'GET') {
    $EstudianteController->mostrarFormularioRegistro();
} elseif ($uri === '/MiproyectoMASP/public/estudiante/registrar' && $method === 'POST') {
    $EstudianteController->registrarEstudiante();
} else {
    echo "Página no encontrada ";
}