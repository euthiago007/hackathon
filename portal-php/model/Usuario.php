<?php

abstract class Usuario
{
    protected int    $id;
    protected string $nome;
    protected string $email;

    public function __construct(int $id, string $nome, string $email)
    {
        $this->id    = $id;
        $this->nome  = $nome;
        $this->email = $email;
    }

    public function getId(): int      { return $this->id; }
    public function getNome(): string  { return $this->nome; }
    public function getEmail(): string { return $this->email; }

    // Método abstrato — polimorfismo: cada subclasse tem seu comportamento
    abstract public function getTipoPerfil(): string;
    abstract public function getAreaAcesso(): string;
    abstract public function getLinkArea(): string;
}
