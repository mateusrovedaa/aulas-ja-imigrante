<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\Usuario;
use App\Controllers\UsuarioController;

$usuarioController = new UsuarioController();

do {
    echo "
    [1] Cadastrar usuário
    [2] Listar usuários
    [3] Listar 1 usuário
    [4] Apagar 1 usuário
    [5] Editar 1 usuário
    [6] Sair";
    echo "\n";

    $opcao = readline("Digite a opção desejada: ");

    if ($opcao == 1) {
        $nome = readline("Digite um nome: ");
        $usuario = new Usuario($nome);
        echo $usuarioController->salvar($usuario);
    } else if ($opcao == 2) {
        $usuarios = $usuarioController->listarTodos();
        foreach ($usuarios as $usuario) {
            echo $usuario;
            echo "\n";
        }
    } else if ($opcao == 3) {
        $id = readline("Digite o id do usuário: ");
        $usuario = $usuarioController->recuperarUm($id);
        echo $usuario;
    } else if ($opcao == 4) {
        $id = readline("Digite o id do usuário para apagar: ");
        $usuarioController->apagar($id);
    } else if ($opcao == 5) {
        $id = readline("Digite o id do usuário para editar: ");
        $usuario = $usuarioController->recuperarUm($id);
        $usuario->setNome(readline("Digite o novo nome do usuário (" . $usuario->getNome() . "): ")); 
        echo $usuarioController->atualizar($usuario);
    }
} while ($opcao != 6);
