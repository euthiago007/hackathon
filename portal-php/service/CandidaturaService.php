<?php
require_once __DIR__ . '/../config/api.php';
require_once __DIR__ . '/../model/Candidatura.php';

class CandidaturaService
{
    private bool $offline = false;

    public function ultimaRespostaOffline(): bool
    {
        return $this->offline;
    }

    public function listarPorVaga(int $vagaId): array
    {
        $dados = apiRequest('GET', '/candidatura?vaga_id=' . $vagaId);
        if (apiOffline($dados)) { $this->offline = true; return []; }
        if (!is_array($dados) || isset($dados['error'])) return [];

        $lista = [];
        foreach ($dados as $item) {
            $lista[] = Candidatura::fromArray($item);
        }
        return $lista;
    }

    public function listarPorAluno(int $alunoId): array
    {
        $dados = apiRequest('GET', '/candidatura?aluno_id=' . $alunoId);
        if (apiOffline($dados)) { $this->offline = true; return []; }
        if (!is_array($dados) || isset($dados['error'])) return [];

        $lista = [];
        foreach ($dados as $item) {
            $lista[] = Candidatura::fromArray($item);
        }
        return $lista;
    }

    public function buscarPorId(int $id): ?Candidatura
    {
        $dados = apiRequest('GET', '/candidatura/' . $id);
        if (apiOffline($dados) || isset($dados['error']) || isset($dados['message'])) return null;
        return Candidatura::fromArray($dados);
    }

    public function candidatar(int $alunoId, int $vagaId): bool
    {
        $resultado = apiRequest('POST', '/candidatura', [
            'aluno_id' => $alunoId,
            'vaga_id'  => $vagaId,
            'status'   => 'PENDENTE' // maiúsculo igual ao ENUM do banco
        ]);
        return !apiOffline($resultado) && !isset($resultado['error']);
    }

    public function atualizarStatus(int $id, string $status): bool
    {
        $atual = $this->buscarPorId($id);
        if (!$atual) return false;

        $resultado = apiRequest('PUT', '/candidatura/' . $id, [
            'aluno_id' => $atual->getAlunoId(),
            'vaga_id'  => $atual->getVagaId(),
            'status'   => strtoupper($status) // garante maiúsculo
        ]);
        return !apiOffline($resultado) && !isset($resultado['error']);
    }
}
