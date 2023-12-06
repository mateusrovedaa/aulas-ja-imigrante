<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\UsuarioController;

$router = new \Bramus\Router\Router();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

$router->get('/usuarios', function () {
    $usuarioController = new UsuarioController();
    $usuarios = $usuarioController->listarTodos();
    echo json_encode($usuarios);
});

$router->run();
