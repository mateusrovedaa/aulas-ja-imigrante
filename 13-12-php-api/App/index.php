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

$router->get('/usuarios/{id}', function ($id) {
    $usuarioController = new UsuarioController();
    $usuario = $usuarioController->recuperarUm($id);
    echo $usuario;
});

$router->post('/usuarios', function () {
    $request = json_decode(file_get_contents('php://input'), true);
    $usuarioController = new UsuarioController();
    $usuario = $usuarioController->salvar($request);
    echo $usuario;
});

$router->put('/usuarios/{id}', function ($id) {
    $request = json_decode(file_get_contents('php://input'), true);
    $usuarioController = new UsuarioController();
    $usuario = $usuarioController->atualizar($request, $id);
    echo $usuario;
});

$router->delete('/usuarios/{id}', function ($id) {
    $usuarioController = new UsuarioController();
    $usuario = $usuarioController->apagar($id);
    echo $usuario;
});

$router->run();
