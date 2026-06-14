<?php
session_start();
require_once '../service/EmpresaService.php';
require_once '../config/validacao.php';

$mensagem = '';
$sucesso  = false;
$dados    = ['nome' => '', 'email' => '', 'cnpj' => '', 'telefone' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'nome'     => trim($_POST['nome']     ?? ''),
        'email'    => trim($_POST['email']    ?? ''),
        'cnpj'     => trim($_POST['cnpj']     ?? ''),
        'telefone' => trim($_POST['telefone'] ?? ''),
    ];

    $v = new Validacao();
    $v->obrigatorio('nome',     $dados['nome'],     'Nome da Empresa')
      ->obrigatorio('email',    $dados['email'],    'E-mail')
      ->email('email',          $dados['email'],    'E-mail')
      ->obrigatorio('cnpj',     $dados['cnpj'],     'CNPJ')
      ->cnpj('cnpj',            $dados['cnpj'],     'CNPJ')
      ->obrigatorio('telefone', $dados['telefone'], 'Telefone');

    if (!$v->valido()) {
        $mensagem = $v->getMensagem();
    } else {
        // Usando EmpresaService corretamente em vez de chamar apiRequest direto
        $service = new EmpresaService();
        $ok      = $service->cadastrar(array_merge($dados, ['status' => 'pendente']));

        if (!$ok) {
            $mensagem = 'Serviço indisponível ou erro ao realizar cadastro.';
        } else {
            $sucesso  = true;
            $mensagem = 'Cadastro realizado! Aguarde a aprovação da UniALFA para acessar o painel.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Empresa</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><h1>Portal de Estágios UniALFA</h1></header>
<div class="container">
    <div class="principal">
        <h2>Cadastro de Empresa</h2>

        <?php if ($mensagem): ?>
            <p class="<?= $sucesso ? 'msg-sucesso' : 'msg-erro' ?>"><?= $mensagem ?></p>
        <?php endif; ?>

        <?php if (!$sucesso): ?>
        <form method="POST" action="cadastro.php">
            <label for="nome">Nome da Empresa</label><br>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($dados['nome']) ?>" required><br><br>

            <label for="cnpj">CNPJ</label><br>
            <input type="text" id="cnpj" name="cnpj" value="<?= htmlspecialchars($dados['cnpj']) ?>"
                   placeholder="00000000000000" required><br><br>

            <label for="email">E-mail</label><br>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($dados['email']) ?>" required><br><br>

            <label for="telefone">Telefone</label><br>
            <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($dados['telefone']) ?>" required><br><br>

            <button type="submit" class="btn">Cadastrar</button>
            <a href="login.php" class="btn">Voltar</a>
        </form>
        <?php else: ?>
            <a href="login.php" class="btn">Ir para o Login</a>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
