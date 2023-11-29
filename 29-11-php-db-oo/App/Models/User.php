<?php

namespace App\Models;

class User
{
    private $id;
    private $nome;

    public function __construct($nome, $id = null)
    {
        $this->nome = $nome;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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
            'nome' => $this->nome
        ]);
    }
}
