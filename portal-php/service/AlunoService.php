<?php
require_once __DIR__ . '/../config/api.php';
require_once __DIR__ . '/../model/Aluno.php';

class AlunoService
{
    public function buscarPorId(int $id): ?Aluno
    {
        $dados = apiRequest('GET', '/aluno/' . $id);
        if (isset($dados['error']) || isset($dados['message'])) return null;
        return Aluno::fromArray($dados);
    }
}
