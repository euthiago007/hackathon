<?php

class Vaga
{
    private $id;
    private $titulo;
    private $descricao;
    private $empresa;

    public function __construct($id, $titulo, $descricao, $empresa)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->empresa = $empresa;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }
}