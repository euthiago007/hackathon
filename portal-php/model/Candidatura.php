<?php

class Candidatura
{
    private int    $id;
    private int    $alunoId;
    private int    $vagaId;
    private string $status;

    public function __construct(int $id, int $alunoId, int $vagaId, string $status)
    {
        $this->id      = $id;
        $this->alunoId = $alunoId;
        $this->vagaId  = $vagaId;
        $this->status  = strtoupper($status); // normaliza para maiúsculo igual ao banco
    }

    public function getId(): int        { return $this->id; }
    public function getAlunoId(): int   { return $this->alunoId; }
    public function getVagaId(): int    { return $this->vagaId; }
    public function getStatus(): string { return $this->status; }

    // Banco usa: PENDENTE, EM_ANALISE, APROVADA, REJEITADA
    public function getStatusFormatado(): string
    {
        return match($this->status) {
            'APROVADA'   => '✅ Aprovada',
            'REJEITADA'  => '❌ Rejeitada',
            'EM_ANALISE' => '🔍 Em Análise',
            default      => '⏳ Pendente'
        };
    }

    public static function fromArray(array $dados): self
    {
        return new self(
            (int) ($dados['id']       ?? 0),
            (int) ($dados['aluno_id'] ?? 0),
            (int) ($dados['vaga_id']  ?? 0),
                  $dados['status']    ?? 'PENDENTE'
        );
    }
}
