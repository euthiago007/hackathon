<?php
session_start();
require_once '../service/EmpresaService.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($email && $senha) {
        $service = new EmpresaService();
        $empresa = $service->login($email, $senha);

        if ($empresa) {
            $_SESSION['empresa_id']   = $empresa->getId();
            $_SESSION['empresa_nome'] = $empresa->getNome();
            header('Location: dashboard.php');
            exit;
        } else {
            $erro = 'E-mail não encontrado, empresa bloqueada ou credenciais inválidas.';
        }
    } else {
        $erro = 'Preencha todos os campos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Empresa</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header><h1>Portal de Estágios UniALFA</h1></header>

<div class="container">
    <div class="principal">
        <h2>Acesso da Empresa</h2>

        <?php if ($erro): ?>
            <p class="msg-erro"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <label for="email">E-mail</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="senha">Senha</label><br>
            <input type="password" id="senha" name="senha" required><br><br>

            <button type="submit" class="btn">Entrar</button>
        </form>

        <br>
        <p>Ainda não tem cadastro? <a href="cadastro.php">Cadastre sua empresa</a></p>
        <a href="../index.php" class="btn">Voltar ao Início</a>
    </div>
</div>

</body>
</html>
