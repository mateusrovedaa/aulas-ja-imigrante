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

    public function salvar($request)
    {
        try {
            $usuario = new Usuario($request['nome'], null, $request['email']);
            $usuarioCriado = $this->usuarioDAO->salvar($usuario);
            http_response_code(200);
            return $usuarioCriado;
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao inserir Usuario: " . $e->getMessage();
        }
    }

    public function atualizar($request, $id)
    {
        try {
            $usuario = new Usuario($request['nome'], $id, $request['email']);
            $usuarioAtualizado = $this->usuarioDAO->atualizar($usuario);
            if ($usuarioAtualizado) {
                http_response_code(200);
                return $usuarioAtualizado;
            } else {
                http_response_code(404);
                return "Usuario não encontrado";
            }
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao atualizar Usuario: " . $e->getMessage();
        }
    }

    public function apagar($id)
    {
        try {
            $usuarioApagado = $this->usuarioDAO->apagar($id);
            if ($usuarioApagado) {
                http_response_code(200);
                return "Usuario " . $id . " apagado";
            } else {
                http_response_code(404);
                return "Usuario não encontrado";
            }
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao atualizar Usuario: " . $e->getMessage();
        }
    }
}
