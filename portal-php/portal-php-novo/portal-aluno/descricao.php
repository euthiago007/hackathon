<?php
require_once '../service/VagaService.php';

$id      = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$service = new VagaService();
$vaga    = $id > 0 ? $service->buscarPorId($id) : null;

if (!$vaga) {
    header('Location: vagas.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Descrição da Vaga</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header><h1>Descrição da Vaga</h1></header>

<div class="container">
    <div class="principal">
        <h2><?= htmlspecialchars($vaga->getTitulo()) ?></h2>
        <p><strong>Bolsa:</strong> <?= $vaga->getBolsaFormatada() ?></p>
        <p><strong>Requisitos:</strong> <?= htmlspecialchars($vaga->getRequisitos()) ?></p>
        <p><strong>Descrição:</strong><br><?= nl2br(htmlspecialchars($vaga->getDescricao())) ?></p>

        <?php if ($vaga->isAtiva()): ?>
            <a href="candidatura.php?vaga_id=<?= $vaga->getId() ?>" class="btn">Candidatar-se</a>
        <?php else: ?>
            <p class="msg-erro">Esta vaga está encerrada.</p>
        <?php endif; ?>

        <a href="vagas.php" class="btn">Voltar</a>
    </div>
</div>
</body>
</html>
