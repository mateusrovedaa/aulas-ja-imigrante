<?php

namespace App\Models\DAO;

use App\Models\Usuario;
use App\Core\Database;

class UsuarioDAO
{
    private $table = 'teste';
    private $db;
    private $connection;

    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->getConnection();
    }

    public function listarTodos()
    {
        try {
            $sql = "SELECT * FROM $this->table ORDER BY id";
            $stmt = $this->connection->query($sql);
            $usuarios = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $this->db->closeConnection();

            return $usuarios;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function recuperarUsuarioPorId($usuarioId)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$usuarioId]);
            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            $this->db->closeConnection();
            
            if ($usuario) {
                $usuarioData = new Usuario($usuario["nome"], $usuario["id"]);
                return $usuarioData;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function salvar(Usuario $usuario)
    {
        try {
            $sql = "INSERT INTO $this->table (nome) VALUES (?)";
            $stmt = $this->connection->prepare($sql);

            $stmt->execute([$usuario->getNome()]);

            $this->db->closeConnection();

            if ($stmt->rowCount() > 0) {
                $usuarioId = $this->connection->lastInsertId();
                $usuarioData = $this->recuperarUsuarioPorId($usuarioId);
                return $usuarioData;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function atualizar($usuario)
    {
        try {
            $sql = "UPDATE $this->table SET nome = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$usuario->getNome(), $usuario->getId()]);
            
            $this->db->closeConnection();

            if ($stmt->rowCount() > 0) {
                $usuarioApagar = $this->recuperarUsuarioPorId($usuario->getId());
                return $usuarioApagar;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function apagar($id)
    {
        try {
            $usuarioApagar = $this->recuperarUsuarioPorId($id);
            
            if ($usuarioApagar) {
                $sql = "DELETE FROM $this->table WHERE id = ?";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$id]);
                $this->db->closeConnection();
            } 
            return $usuarioApagar;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}