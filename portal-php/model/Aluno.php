<?php
require_once __DIR__ . '/Usuario.php';

class Aluno extends Usuario
{
    private string $matricula;
    private string $curso;

    public function __construct(int $id, string $nome, string $email, string $matricula, string $curso)
    {
        parent::__construct($id, $nome, $email);
        $this->matricula = $matricula;
        $this->curso     = $curso;
    }

    public function getMatricula(): string { return $this->matricula; }
    public function getCurso(): string     { return $this->curso; }

    // Polimorfismo — implementação específica do Aluno
    public function getTipoPerfil(): string { return 'Aluno'; }
    public function getAreaAcesso(): string { return 'Portal do Aluno'; }
    public function getLinkArea(): string   { return 'portal-aluno/vagas.php'; }

    public static function fromArray(array $dados): self
    {
        return new self(
            (int)   ($dados['id']       ?? 0),
                    $dados['nome']      ?? '',
                    $dados['email']     ?? '',
                    $dados['matricula'] ?? '',
                    $dados['curso']     ?? ''
        );
    }
}
