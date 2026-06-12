<?php

class Candidatura
{
    private $id;
    private $aluno;
    private $vaga;
    private $status;

    public function __construct($id, $aluno, $vaga, $status)
    {
        $this->id = $id;
        $this->aluno = $aluno;
        $this->vaga = $vaga;
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAluno()
    {
        return $this->aluno;
    }

    public function getVaga()
    {
        return $this->vaga;
    }

    public function getStatus()
    {
        return $this->status;
    }
}