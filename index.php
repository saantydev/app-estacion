<?php
require_once 'env.php';
require_once 'controllers/EstacionController.php';

$controller = new EstacionController();
$url = $_GET['url'] ?? '';
$segments = explode('/', trim($url, '/'));

switch ($segments[0]) {
    case '':
    case 'landing':
        $controller->landing();
        break;
    case 'panel':
        $controller->panel();
        break;
    case 'detalle':
        $chipid = $segments[1] ?? '';
        $controller->detalle($chipid);
        break;
    default:
        $controller->landing();
        break;
}
?>