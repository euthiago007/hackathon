<?php
require_once '../service/CandidaturaService.php';
require_once '../service/VagaService.php';
require_once '../service/AlunoService.php';
require_once '../config/api.php';

$alunoId      = isset($_GET['aluno_id']) ? (int) $_GET['aluno_id'] : 0;
$candService  = new CandidaturaService();
$vagaService  = new VagaService();
$alunoService = new AlunoService();
$candidaturas = [];
$aluno        = null;
$offline      = false;

if ($alunoId > 0) {
    $aluno = $alunoService->buscarPorId($alunoId);

    if (!$aluno) {
        $offline = false;
        $erroAluno = 'Aluno não encontrado. Verifique seu ID.';
    } else {
        $candidaturas = $candService->listarPorAluno($alunoId);
        $offline      = $candService->ultimaRespostaOffline();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Minhas Candidaturas</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><h1>Minhas Candidaturas</h1></header>
<div class="container">

    <?php if ($alunoId <= 0): ?>
        <div class="principal">
            <h2>Consultar Candidaturas</h2>
            <form method="GET" action="minhas-candidaturas.php">
                <label for="aluno_id">Seu ID de Aluno</label><br>
                <input type="number" id="aluno_id" name="aluno_id" required min="1"><br><br>
                <button type="submit" class="btn">Buscar</button>
            </form>
        </div>
    <?php elseif (isset($erroAluno)): ?>
        <p class="msg-erro"><?= htmlspecialchars($erroAluno) ?></p>
        <a href="minhas-candidaturas.php" class="btn">Tentar novamente</a>
    <?php elseif ($offline): ?>
        <p class="msg-erro">Serviço indisponível no momento. Tente novamente em instantes.</p>
    <?php else: ?>
        <?php if ($aluno): ?>
            <p style="margin-bottom:20px">
                Candidaturas de <strong><?= htmlspecialchars($aluno->getNome()) ?></strong>
                — <?= htmlspecialchars($aluno->getCurso()) ?>
            </p>
        <?php endif; ?>

        <?php if (empty($candidaturas)): ?>
            <p style="text-align:center">Você ainda não se candidatou a nenhuma vaga.</p>
        <?php else: ?>
            <?php foreach ($candidaturas as $candidatura): ?>
                <?php $vaga = $vagaService->buscarPorId($candidatura->getVagaId()); ?>
                <div class="card-vaga">
                    <h2><?= $vaga ? htmlspecialchars($vaga->getTitulo()) : 'Vaga #' . $candidatura->getVagaId() ?></h2>
                    <?php if ($vaga): ?>
                        <p>Bolsa: <?= $vaga->getBolsaFormatada() ?></p>
                    <?php endif; ?>
                    <p><strong>Status:</strong> <?= $candidatura->getStatusFormatado() ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>

    <a href="vagas.php" class="btn">Ver Vagas</a>
    <a href="../index.php" class="btn">Início</a>

</div>
</body>
</html>
