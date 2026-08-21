<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action) {
    case 'login':
        require_once "controllers/AuthController.php";
        (new AuthController())->login();
        break;

    case 'logout':
        require_once "controllers/AuthController.php";
        (new AuthController())->logout();
        break;

    case 'proyectos':
        require_once "controllers/ProyectoController.php";
        (new ProyectoController())->index();
        break;

    case 'crear_proyecto':
        require_once "controllers/ProyectoController.php";
        (new ProyectoController())->crear();
        break;

    case 'editar_proyecto':
        require_once "controllers/ProyectoController.php";
        (new ProyectoController())->editar();
        break;

    case 'eliminar_proyecto':
        require_once "controllers/ProyectoController.php";
        (new ProyectoController())->eliminar();
        break;

    case 'reporte_pdf':
        require_once "controllers/ProyectoController.php";
        (new ProyectoController())->reportePDF();
        break;

    case 'usuarios':
        require_once "controllers/UsuarioController.php";
        (new UsuarioController())->index();
        break;

    case 'crear_usuario':
        require_once "controllers/UsuarioController.php";
        (new UsuarioController())->crear();
        break;
    
    case 'eliminar_usuario':
        require_once "controllers/UsuarioController.php";
        (new UsuarioController())->eliminar();
        break;
        
    default:
        header("Location: index.php?action=login");
        exit;
        break;
}
?>