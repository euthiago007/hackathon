<?php
require_once '../service/CandidaturaService.php';
require_once '../service/VagaService.php';
require_once '../service/AlunoService.php';
require_once '../config/validacao.php';

$vagaId   = isset($_GET['vaga_id']) ? (int) $_GET['vaga_id'] : 0;
$mensagem = '';
$sucesso  = false;
$alunoId  = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vagaId  = (int) ($_POST['vaga_id']  ?? 0);
    $alunoId = (int) ($_POST['aluno_id'] ?? 0);

    $v = new Validacao();
    $v->obrigatorio('aluno_id', (string) $alunoId, 'ID do Aluno')
      ->numeroPositivo('aluno_id', (string) $alunoId, 'ID do Aluno');

    if ($vagaId <= 0) {
        $mensagem = 'Vaga inválida.';
    } elseif (!$v->valido()) {
        $mensagem = $v->getMensagem();
    } else {
        $alunoService = new AlunoService();
        $aluno        = $alunoService->buscarPorId($alunoId);

        if (!$aluno) {
            $mensagem = 'Aluno não encontrado. Verifique seu ID.';
        } else {
            $service = new CandidaturaService();
            $ok      = $service->candidatar($alunoId, $vagaId);

            if (!$ok) {
                $mensagem = 'Erro ao enviar candidatura. Tente novamente.';
            } else {
                $sucesso  = true;
                $mensagem = 'Candidatura enviada com sucesso!';
            }
        }
    }
}

$vagaService = new VagaService();
$vaga        = $vagaId > 0 ? $vagaService->buscarPorId($vagaId) : null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Candidatura</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><h1>Enviar Candidatura</h1></header>
<div class="container">
    <div class="principal">

        <?php if ($vaga): ?>
            <h2><?= htmlspecialchars($vaga->getTitulo()) ?></h2>
            <p>Bolsa: <?= $vaga->getBolsaFormatada() ?></p>
        <?php endif; ?>

        <?php if ($mensagem): ?>
            <p class="<?= $sucesso ? 'msg-sucesso' : 'msg-erro' ?>"><?= htmlspecialchars($mensagem) ?></p>
        <?php endif; ?>

        <?php if (!$sucesso): ?>
        <form method="POST" action="cantidatura.php">
            <input type="hidden" name="vaga_id" value="<?= $vagaId ?>">

            <label for="aluno_id">Seu ID de Aluno</label><br>
            <input type="number" id="aluno_id" name="aluno_id"
                   value="<?= $alunoId > 0 ? $alunoId : '' ?>"
                   required min="1"><br><br>

            <button type="submit" class="btn">Enviar Candidatura</button>
            <a href="descricao.php?id=<?= $vagaId ?>" class="btn">Voltar</a>
        </form>
        <?php else: ?>
            <a href="minhas-candidaturas.php?aluno_id=<?= $alunoId ?>" class="btn">Ver minhas candidaturas</a>
            <a href="vagas.php" class="btn">Ver mais vagas</a>
        <?php endif; ?>

    </div>
</div>
</body>
</html>
