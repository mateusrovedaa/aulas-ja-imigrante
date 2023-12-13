<?php

use App\Controllers\UsuarioController;

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

// criar
$router->post('/usuarios', function () {
    $request = json_decode(file_get_contents('php://input'), true);
    $usuarioController = new UsuarioController();
    $usuario = $usuarioController->salvar($request);
    echo $usuario;
});

// editar
$router->put('/usuarios/{id}', function ($id) {
    $request = json_decode(file_get_contents('php://input'), true);
    $usuarioController = new UsuarioController();
    $usuario = $usuarioController->atualizar($request, $id);
    echo $usuario;
});

// excluir
$router->delete('/usuarios/{id}', function ($id) {
    $usuarioController = new UsuarioController();
    $usuario = $usuarioController->apagar($id);
    echo $usuario;
});