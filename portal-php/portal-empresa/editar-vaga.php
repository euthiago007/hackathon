<?php
require_once 'auth_check.php';
require_once '../service/VagaService.php';
require_once '../config/validacao.php';

$id        = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$empresaId = (int) $_SESSION['empresa_id'];
$mensagem  = '';
$sucesso   = false;

if ($id <= 0) { header('Location: minhas-vagas.php'); exit; }

$service = new VagaService();
$vaga    = $service->buscarPorId($id);

if (!$vaga) { header('Location: minhas-vagas.php'); exit; }
if ($vaga->getEmpresaId() !== $empresaId) { header('Location: minhas-vagas.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo     = trim($_POST['titulo']     ?? '');
    $bolsa      = trim($_POST['bolsa']      ?? '');
    $requisitos = trim($_POST['requisitos'] ?? '');
    $descricao  = trim($_POST['descricao']  ?? '');
    $ativa      = isset($_POST['ativa']);

    $v = new Validacao();
    $v->obrigatorio('titulo',     $titulo,     'Título')
      ->minimo('titulo',          $titulo,     3, 'Título')
      ->obrigatorio('bolsa',      $bolsa,      'Bolsa')
      ->numeroPositivo('bolsa',   $bolsa,      'Bolsa')
      ->obrigatorio('requisitos', $requisitos, 'Requisitos')
      ->obrigatorio('descricao',  $descricao,  'Descrição');

    if (!$v->valido()) {
        $mensagem = $v->getMensagem();
    } else {
        $ok = $service->atualizar($id, [
            'titulo'     => $titulo,
            'descricao'  => $descricao,
            'requisitos' => $requisitos,
            'bolsa'      => (float) $bolsa,
            'ativa'      => $ativa,
            'empresa_id' => $empresaId
        ]);

        if (!$ok) {
            $mensagem = 'Serviço indisponível ou erro ao atualizar vaga.';
        } else {
            $sucesso  = true;
            $mensagem = 'Vaga atualizada com sucesso!';
            // Recarrega os dados atualizados da API
            $vaga = $service->buscarPorId($id) ?? $vaga;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Vaga</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><h1>Editar Vaga</h1></header>
<div class="container">
    <div class="principal">

        <?php if ($mensagem): ?>
            <p class="<?= $sucesso ? 'msg-sucesso' : 'msg-erro' ?>"><?= $mensagem ?></p>
        <?php endif; ?>

        <form method="POST" action="editar-vaga.php?id=<?= $id ?>">
            <label for="titulo">Título da Vaga</label><br>
            <input type="text" id="titulo" name="titulo"
                   value="<?= htmlspecialchars($vaga->getTitulo()) ?>" required><br><br>

            <label for="bolsa">Bolsa (R$)</label><br>
            <input type="number" id="bolsa" name="bolsa" step="0.01" min="0"
                   value="<?= $vaga->getBolsa() ?>" required><br><br>

            <label for="requisitos">Requisitos</label><br>
            <input type="text" id="requisitos" name="requisitos"
                   value="<?= htmlspecialchars($vaga->getRequisitos()) ?>" required><br><br>

            <label for="descricao">Descrição</label><br>
            <textarea id="descricao" name="descricao" rows="6"><?= htmlspecialchars($vaga->getDescricao()) ?></textarea><br><br>

            <label>
                <input type="checkbox" name="ativa" <?= $vaga->isAtiva() ? 'checked' : '' ?>>
                Vaga Ativa
            </label><br><br>

            <button type="submit" class="btn">Atualizar Vaga</button>
            <a href="minhas-vagas.php" class="btn">Voltar</a>
        </form>

    </div>
</div>
</body>
</html>
