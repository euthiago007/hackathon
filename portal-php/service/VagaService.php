<?php
require_once __DIR__ . '/../config/api.php';
require_once __DIR__ . '/../model/Vaga.php';

class VagaService
{
    private bool $offline = false;

    public function ultimaRespostaOffline(): bool
    {
        return $this->offline;
    }

    public function listarAtivas(): array
    {
        $dados = apiRequest('GET', '/vaga');
        if (apiOffline($dados)) { $this->offline = true; return []; }
        if (isset($dados['error']) || !is_array($dados)) return [];

        $vagas = [];
        foreach ($dados as $item) {
            $vaga = Vaga::fromArray($item);
            if ($vaga->isAtiva()) {
                $vagas[] = $vaga;
            }
        }
        return $vagas;
    }

    public function listarPorEmpresa(int $empresaId): array
    {
        $dados = apiRequest('GET', '/vaga');
        if (apiOffline($dados)) { $this->offline = true; return []; }
        if (isset($dados['error']) || !is_array($dados)) return [];

        $vagas = [];
        foreach ($dados as $item) {
            $vaga = Vaga::fromArray($item);
            if ($vaga->getEmpresaId() === $empresaId) {
                $vagas[] = $vaga;
            }
        }
        return $vagas;
    }

    public function buscarPorId(int $id): ?Vaga
    {
        $dados = apiRequest('GET', '/vaga/' . $id);
        if (apiOffline($dados) || isset($dados['error']) || isset($dados['message'])) return null;
        return Vaga::fromArray($dados);
    }

    public function criar(array $dados): ?Vaga
    {
        // POST /vaga retorna o objeto criado
        $resultado = apiRequest('POST', '/vaga', $dados);
        if (apiOffline($resultado) || isset($resultado['error'])) return null;
        return Vaga::fromArray($resultado);
    }

    public function atualizar(int $id, array $dados): bool
    {
        // PUT /vaga/:id retorna { message } — não tenta montar objeto
        $resultado = apiRequest('PUT', '/vaga/' . $id, $dados);
        return !apiOffline($resultado) && !isset($resultado['error']);
    }

    public function excluir(int $id): bool
    {
        $resultado = apiRequest('DELETE', '/vaga/' . $id);
        return !apiOffline($resultado) && !isset($resultado['error']);
    }
}
