<?php

namespace App\Models;

class Usuario
{
    private $id;
    private $nome;
    private $email;

    public function __construct($nome, $id = null, $email)
    {
        $this->nome = $nome;
        $this->id = $id;
        $this->email = $email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function __toString()
    {   
        return json_encode([
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email
        ]);
    }
}
