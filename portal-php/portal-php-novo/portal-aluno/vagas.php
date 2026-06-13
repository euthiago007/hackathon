<?php
require_once '../service/VagaService.php';
require_once '../config/api.php';

$service  = new VagaService();
$vagas    = $service->listarAtivas();
$offline  = $service->ultimaRespostaOffline();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Vagas Disponíveis</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><h1>Vagas Disponíveis</h1></header>
<div class="container">

    <?php if ($offline): ?>
        <p class="msg-erro">Serviço indisponível no momento. Tente novamente em instantes.</p>
    <?php elseif (empty($vagas)): ?>
        <p style="text-align:center">Nenhuma vaga disponível no momento.</p>
    <?php else: ?>
        <?php foreach ($vagas as $vaga): ?>
            <div class="card-vaga">
                <h2><?= htmlspecialchars($vaga->getTitulo()) ?></h2>
                <p>Bolsa: <?= $vaga->getBolsaFormatada() ?></p>
                <a href="descricao.php?id=<?= $vaga->getId() ?>" class="btn">Ver Descrição</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <a href="../index.php" class="btn">Voltar ao Início</a>

</div>
</body>
</html>
