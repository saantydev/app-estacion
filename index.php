<?php
session_start();
require_once 'env.php';
require_once 'controllers/EstacionController.php';
require_once 'controllers/AuthController.php';

// Configurar conexión a base de datos
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$url = $_GET['url'] ?? '';
$segments = explode('/', trim($url, '/'));

switch ($segments[0]) {
    case '':
    case 'landing':
        $controller = new EstacionController();
        $controller->landing();
        break;
    case 'panel':
        $controller = new EstacionController();
        $controller->panel();
        break;
    case 'detalle':
        $chipid = $segments[1] ?? '';
        $controller = new EstacionController();
        $controller->detalle($chipid);
        break;
    case 'login':
        $controller = new AuthController($pdo);
        $controller->login();
        break;
    case 'register':
        $controller = new AuthController($pdo);
        $controller->register();
        break;
    case 'validate':
        $token_action = $segments[1] ?? '';
        $controller = new AuthController($pdo);
        $controller->validate($token_action);
        break;
    case 'blocked':
        $token = $segments[1] ?? '';
        $controller = new AuthController($pdo);
        $controller->blocked($token);
        break;
    case 'recovery':
        $controller = new AuthController($pdo);
        $controller->recovery();
        break;
    case 'reset':
        $token_action = $segments[1] ?? '';
        $controller = new AuthController($pdo);
        $controller->reset($token_action);
        break;
    case 'logout':
        $controller = new AuthController($pdo);
        $controller->logout();
        break;
    default:
        $controller = new EstacionController();
        $controller->landing();
        break;
}
?>