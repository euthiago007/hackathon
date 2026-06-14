<?php
require_once __DIR__ . '/Usuario.php';

class Empresa extends Usuario
{
    private string $cnpj;
    private string $telefone;
    private string $status;

    public function __construct(int $id, string $nome, string $email, string $cnpj, string $telefone, string $status)
    {
        parent::__construct($id, $nome, $email);
        $this->cnpj     = $cnpj;
        $this->telefone = $telefone;
        $this->status   = strtoupper($status); // normaliza para maiúsculo
    }

    public function getCnpj(): string     { return $this->cnpj; }
    public function getTelefone(): string { return $this->telefone; }
    public function getStatus(): string   { return $this->status; }

    // Banco usa ENUM maiúsculo: APROVADA, PENDENTE, BLOQUEADA
    public function isAtiva(): bool { return $this->status === 'APROVADA'; }

    public function getTipoPerfil(): string { return 'Empresa'; }
    public function getAreaAcesso(): string { return 'Painel da Empresa'; }
    public function getLinkArea(): string   { return 'portal-empresa/dashboard.php'; }

    public static function fromArray(array $dados): self
    {
        return new self(
            (int)   ($dados['id']       ?? 0),
                    $dados['nome']      ?? '',
                    $dados['email']     ?? '',
                    $dados['cnpj']      ?? '',
                    $dados['telefone']  ?? '',
                    $dados['status']    ?? 'PENDENTE'
        );
    }
}
