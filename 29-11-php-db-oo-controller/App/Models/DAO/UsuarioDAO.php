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
            $Usuarios = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $this->db->closeConnection();

            return $Usuarios;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function recuperarUsuarioPorId($UsuarioId)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$UsuarioId]);
            $Usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            $this->db->closeConnection();
            
            if ($Usuario) {
                $UsuarioData = new Usuario($Usuario["nome"], $Usuario["id"]);
                return $UsuarioData;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function create(Usuario $Usuario)
    {
        try {
            $sql = "INSERT INTO $this->table (nome) VALUES (?)";
            $stmt = $this->connection->prepare($sql);

            $stmt->execute([$Usuario->getNome()]);

            $this->db->closeConnection();

            if ($stmt->rowCount() > 0) {
                $UsuarioId = $this->connection->lastInsertId();
                $UsuarioData = $this->recuperarUsuarioPorId($UsuarioId);
                return $UsuarioData;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function atualizar($Usuario)
    {
        try {
            $sql = "UPDATE $this->table SET nome = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$Usuario->getNome(), $Usuario->getId()]);
            
            $this->db->closeConnection();

            if ($stmt->rowCount() > 0) {
                $UsuarioData = $this->recuperarUsuarioPorId($Usuario->getId());
                return $UsuarioData;
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
            $UsuarioToapagar = $this->recuperarUsuarioPorId($id);
            
            if ($UsuarioToapagar) {
                $sql = "DELETE FROM $this->table WHERE id = ?";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$id]);
                $this->db->closeConnection();
            } 
            return $UsuarioToapagar;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}