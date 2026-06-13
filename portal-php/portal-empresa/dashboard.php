<?php
require_once 'auth_check.php';
$nomeEmpresa = $_SESSION['empresa_nome'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel da Empresa</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header><h1>Painel da Empresa</h1></header>

<div class="container">
    <div class="principal">
        <h2>Bem-vinda, <?= htmlspecialchars($nomeEmpresa) ?>!</h2>
        <p>Gerencie suas vagas e acompanhe os candidatos.</p>

        <a href="criar-vaga.php" class="btn">+ Criar Vaga</a>
        <a href="minhas-vagas.php" class="btn">Minhas Vagas</a>
        <a href="logout.php" class="btn btn-danger">Sair</a>
    </div>
</div>

<footer>© 2026 Portal de Estágios UniALFA</footer>
</body>
</html>
