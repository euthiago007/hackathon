<?php
require_once __DIR__ . '/../config/api.php';
require_once __DIR__ . '/../model/Empresa.php';

class EmpresaService
{
    public function buscarPorId(int $id): ?Empresa
    {
        $dados = apiRequest('GET', '/empresa/' . $id);
        if (apiOffline($dados) || isset($dados['error']) || isset($dados['message'])) return null;
        return Empresa::fromArray($dados);
    }

    public function cadastrar(array $dados): bool
    {
        $resultado = apiRequest('POST', '/empresa', $dados);
        if (apiOffline($resultado) || isset($resultado['error'])) return false;
        // POST /empresa retorna o objeto criado — sucesso se tiver 'id'
        return isset($resultado['id']);
    }

    public function login(string $email, string $senha): ?Empresa
    {
        $resultado = apiRequest('POST', '/empresa/login', [
            'email' => $email,
            'senha' => $senha
        ]);

        if (apiOffline($resultado) || isset($resultado['message']) || isset($resultado['error'])) {
            return null;
        }

        $empresa = Empresa::fromArray($resultado);

        if (!$empresa->isAtiva()) return null;

        return $empresa;
    }
}
