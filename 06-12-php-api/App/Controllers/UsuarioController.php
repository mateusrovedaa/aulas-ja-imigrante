<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\DAO\UsuarioDAO;

class UsuarioController
{
    private $usuarioDAO;

    public function __construct()
    {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function listarTodos()
    {
        try {
            $usuarios = $this->usuarioDAO->listarTodos();
            http_response_code(200);
            return $usuarios;
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao recuperar Usuarios: " . $e->getMessage();
        }
    }

    public function recuperarUm($id)
    {
        try {
            $usuario = $this->usuarioDAO->recuperarUsuarioPorId($id);
            if ($usuario) {
                http_response_code(200);
                return $usuario;
            } else {
                http_response_code(404);
                return "Usuario não encontrado";
            }
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao recuperar Usuario: " . $e->getMessage();
        }
    }

    public function salvar(Usuario $usuario)
    {
        try {
            $usuarioCriado = $this->usuarioDAO->salvar($usuario);
            return $usuarioCriado;
        } catch (\Exception $e) {
            echo "Erro ao inserir Usuario: " . $e->getMessage();
        }
    }

    public function atualizar($usuario)
    {
        try {
            $usuarioAtualizado = $this->usuarioDAO->atualizar($usuario);
            if ($usuarioAtualizado) {
                return $usuarioAtualizado;
            } else {
                echo "Usuario não encontrado";
            }
        } catch (\Exception $e) {
            echo "Erro ao atualizar Usuario: " . $e->getMessage();
        }
    }

    public function apagar($id)
    {
        try {
            $usuarioApagado = $this->usuarioDAO->apagar($id);
            if ($usuarioApagado) {
                echo "Usuario " . $id . " apagado";
            } else {
                echo "Usuario não encontrado";
            }
        } catch (\Exception $e) {
            echo "Erro ao atualizar Usuario: " . $e->getMessage();
        }
    }
}