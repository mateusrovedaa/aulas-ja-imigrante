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
            $usuarios = [];
            $usuarios = $this->usuarioDAO->listarTodos();
            foreach($usuarios as $usuario){
                $u = new Usuario($usuario['nome'], $usuario['id']);
                $usuarios[] = $u;
            }
            return $usuarios;
        } catch (\Exception $e) {
            echo "Erro ao recuperar Usuarios: " . $e->getMessage();
        }
    }

    public function recuperarUm($id)
    {
        try {
            $usuario = $this->usuarioDAO->recuperarUsuarioPorId($id);
            if ($usuario) {
                return $usuario;
            } else {
                echo "Usuario não encontrado";
            }
        } catch (\Exception $e) {
            echo "Erro ao recuperar Usuario: " . $e->getMessage();
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