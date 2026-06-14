<?php
require_once 'auth_check.php';
require_once '../service/CandidaturaService.php';
require_once '../service/AlunoService.php';

$vagaId   = isset($_GET['vaga_id']) ? (int) $_GET['vaga_id'] : 0;
$mensagem = '';
$sucesso  = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cid    = (int) ($_POST['candidatura_id'] ?? 0);
    $status = $_POST['status'] ?? 'PENDENTE';

    $service = new CandidaturaService();
    $ok      = $service->atualizarStatus($cid, $status);
    $sucesso  = $ok;
    $mensagem = $ok ? 'Status atualizado com sucesso!' : 'Erro ao atualizar status.';
}

$candService  = new CandidaturaService();
$alunoService = new AlunoService();
$candidaturas = $candService->listarPorVaga($vagaId);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Candidatos</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><h1>Candidatos da Vaga #<?= $vagaId ?></h1></header>
<div class="container">

    <?php if ($mensagem): ?>
        <p class="<?= $sucesso ? 'msg-sucesso' : 'msg-erro' ?>"><?= htmlspecialchars($mensagem) ?></p>
    <?php endif; ?>

    <?php if (empty($candidaturas)): ?>
        <p style="text-align:center">Nenhum candidato ainda.</p>
    <?php else: ?>
        <?php foreach ($candidaturas as $candidatura): ?>
            <?php $aluno = $alunoService->buscarPorId($candidatura->getAlunoId()); ?>
            <div class="card-vaga">
                <h2><?= $aluno ? htmlspecialchars($aluno->getNome()) : 'Aluno #' . $candidatura->getAlunoId() ?></h2>
                <?php if ($aluno): ?>
                    <p>Curso: <?= htmlspecialchars($aluno->getCurso()) ?></p>
                    <p>E-mail: <?= htmlspecialchars($aluno->getEmail()) ?></p>
                <?php endif; ?>
                <p>Status atual: <?= $candidatura->getStatusFormatado() ?></p>

                <form method="POST" action="candidatos.php?vaga_id=<?= $vagaId ?>" style="display:inline">
                    <input type="hidden" name="candidatura_id" value="<?= $candidatura->getId() ?>">
                    <select name="status">
                        <?php
                        // Valores em maiúsculo igual ao ENUM do banco
                        $opcoes = [
                            'PENDENTE'   => 'Pendente',
                            'EM_ANALISE' => 'Em Análise',
                            'APROVADA'   => 'Aprovada',
                            'REJEITADA'  => 'Rejeitada',
                        ];
                        foreach ($opcoes as $valor => $label):
                        ?>
                            <option value="<?= $valor ?>" <?= $candidatura->getStatus() === $valor ? 'selected' : '' ?>>
                                <?= $label ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn">Atualizar</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <a href="minhas-vagas.php" class="btn">Voltar às Vagas</a>

</div>
</body>
</html>
