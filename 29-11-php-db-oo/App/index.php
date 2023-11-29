<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;
use App\Models\User;

$db = new Database();

do {
    echo "
    [1] Cadastrar usuário
    [2] Listar usuários (utilizando for)
    [3] Listar 1 usuário
    [4] Apagar 1 usuário
    [5] Sair";
    echo "\n";
    $opcao = readline("Digite a opção desejada: ");

    if ($opcao == 1) {
        $nome = readline("Digite um nome: ");
        $usuario = new User($nome);
        $connection = $db->getConnection();
        $sql = "INSERT INTO teste (nome) VALUES ('" . $usuario->getNome() . "')";
        $stmt = $connection->query($sql);
    } else if ($opcao == 2) {
        $connection = $db->getConnection();
        $sql = "SELECT * FROM teste ORDER BY id";
        $stmt = $connection->query($sql);
        $usuariosDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($usuariosDB as $usuario) {
            echo "ID: " . $usuario['id'] . "\n";
            echo "Nome: " . $usuario['nome'] . "\n";
        }
    } else if ($opcao == 3) {
        $id = readline("Digite o id do usuário: ");
        $connection = $db->getConnection();
        $sql = "SELECT * FROM teste WHERE id = $id";
        $stmt = $connection->query($sql);
        $usuariosDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $usuario = new User($usuariosDB[0]['nome'], $usuariosDB[0]['id']);
        echo $usuario;

    } else if ($opcao == 4) {
        $id = readline("Digite o id do usuário para apagar: ");
        $connection = $db->getConnection();
        $sql = "DELETE FROM teste WHERE id = $id";
        $connection->query($sql);
    }
} while ($opcao != 5);
$db->closeConnection();
