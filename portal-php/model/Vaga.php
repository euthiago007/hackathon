<?php

class Vaga
{
    private int    $id;
    private string $titulo;
    private string $descricao;
    private string $requisitos;
    private float  $bolsa;
    private bool   $ativa;
    private int    $empresaId;

    public function __construct(int $id, string $titulo, string $descricao, string $requisitos, float $bolsa, bool $ativa, int $empresaId)
    {
        $this->id         = $id;
        $this->titulo     = $titulo;
        $this->descricao  = $descricao;
        $this->requisitos = $requisitos;
        $this->bolsa      = $bolsa;
        $this->ativa      = $ativa;
        $this->empresaId  = $empresaId;
    }

    public function getId(): int        { return $this->id; }
    public function getTitulo(): string { return $this->titulo; }
    public function getDescricao(): string  { return $this->descricao; }
    public function getRequisitos(): string { return $this->requisitos; }
    public function getBolsa(): float   { return $this->bolsa; }
    public function isAtiva(): bool     { return $this->ativa; }
    public function getEmpresaId(): int { return $this->empresaId; }

    public function getBolsaFormatada(): string
    {
        return 'R$ ' . number_format($this->bolsa, 2, ',', '.');
    }

    public static function fromArray(array $dados): self
    {
        return new self(
            (int)   ($dados['id']         ?? 0),
                    $dados['titulo']      ?? '',
                    $dados['descricao']   ?? '',
                    $dados['requisitos']  ?? '',
            (float) ($dados['bolsa']      ?? 0),
            (bool)  ($dados['ativa']      ?? false),
            (int)   ($dados['empresa_id'] ?? 0)
        );
    }
}
