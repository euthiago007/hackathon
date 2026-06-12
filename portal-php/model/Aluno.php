<?php

class Aluno
{
    private $id;
    private $nome;
    private $email;
    private $curso;

    public function __construct($id, $nome, $email, $curso)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->curso = $curso;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCurso()
    {
        return $this->curso;
    }
}