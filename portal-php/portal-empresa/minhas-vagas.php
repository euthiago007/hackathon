<?php
require_once 'auth_check.php';
require_once '../service/VagaService.php';

$empresaId = (int) $_SESSION['empresa_id'];
$service   = new VagaService();
$vagas     = $service->listarPorEmpresa($empresaId);
$offline   = $service->ultimaRespostaOffline();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Minhas Vagas</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><h1>Minhas Vagas</h1></header>
<div class="container">

    <?php if ($offline): ?>
        <p class="msg-erro">Serviço indisponível no momento. Tente novamente em instantes.</p>
    <?php elseif (empty($vagas)): ?>
        <p style="text-align:center">Nenhuma vaga cadastrada ainda.</p>
    <?php else: ?>
        <?php foreach ($vagas as $vaga): ?>
            <div class="card-vaga">
                <h2><?= htmlspecialchars($vaga->getTitulo()) ?></h2>
                <p>Bolsa: <?= $vaga->getBolsaFormatada() ?></p>
                <p>Status: <?= $vaga->isAtiva() ? 'Ativa' : 'Inativa' ?></p>
                <a href="editar-vaga.php?id=<?= $vaga->getId() ?>" class="btn">Editar</a>
                <a href="candidatos.php?vaga_id=<?= $vaga->getId() ?>" class="btn">Candidatos</a>
                <a href="excluir-vaga.php?id=<?= $vaga->getId() ?>"
                   class="btn btn-danger"
                   onclick="return confirm('Excluir esta vaga?')">Excluir</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <a href="criar-vaga.php" class="btn">+ Nova Vaga</a>
    <a href="dashboard.php" class="btn">Voltar ao Painel</a>

</div>
</body>
</html>
