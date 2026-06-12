<?php

class Empresa
{
    private $id;
    private $nome;
    private $email;
    private $cnpj;

    public function __construct($id, $nome, $email, $cnpj)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->cnpj = $cnpj;
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

    public function getCnpj()
    {
        return $this->cnpj;
    }
}