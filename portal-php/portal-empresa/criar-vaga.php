<?php
require_once 'auth_check.php';
require_once '../service/VagaService.php';
require_once '../config/validacao.php';

$empresaId = (int) $_SESSION['empresa_id'];
$mensagem  = '';
$sucesso   = false;
$dados     = ['titulo' => '', 'bolsa' => '', 'requisitos' => '', 'descricao' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'titulo'     => trim($_POST['titulo']     ?? ''),
        'bolsa'      => trim($_POST['bolsa']      ?? ''),
        'requisitos' => trim($_POST['requisitos'] ?? ''),
        'descricao'  => trim($_POST['descricao']  ?? ''),
    ];

    $v = new Validacao();
    $v->obrigatorio('titulo',     $dados['titulo'],     'Título')
      ->minimo('titulo',          $dados['titulo'],     3, 'Título')
      ->obrigatorio('bolsa',      $dados['bolsa'],      'Bolsa')
      ->numeroPositivo('bolsa',   $dados['bolsa'],      'Bolsa')
      ->obrigatorio('requisitos', $dados['requisitos'], 'Requisitos')
      ->obrigatorio('descricao',  $dados['descricao'],  'Descrição');

    if (!$v->valido()) {
        $mensagem = $v->getMensagem();
    } else {
        $service = new VagaService();
        $ok      = $service->criar([
            'titulo'     => $dados['titulo'],
            'descricao'  => $dados['descricao'],
            'requisitos' => $dados['requisitos'],
            'bolsa'      => (float) $dados['bolsa'],
            'ativa'      => true,
            'empresa_id' => $empresaId
        ]);

        if (!$ok) {
            $mensagem = 'Serviço indisponível ou erro ao criar vaga.';
        } else {
            $sucesso  = true;
            $mensagem = 'Vaga criada com sucesso!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Vaga</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><h1>Nova Vaga</h1></header>
<div class="container">
    <div class="principal">

        <?php if ($mensagem): ?>
            <p class="<?= $sucesso ? 'msg-sucesso' : 'msg-erro' ?>"><?= $mensagem ?></p>
        <?php endif; ?>

        <?php if (!$sucesso): ?>
        <form method="POST" action="criar-vaga.php">
            <label for="titulo">Título da Vaga</label><br>
            <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($dados['titulo']) ?>" required><br><br>

            <label for="bolsa">Bolsa (R$)</label><br>
            <input type="number" id="bolsa" name="bolsa" step="0.01" min="0"
                   value="<?= htmlspecialchars($dados['bolsa']) ?>" required><br><br>

            <label for="requisitos">Requisitos</label><br>
            <input type="text" id="requisitos" name="requisitos"
                   value="<?= htmlspecialchars($dados['requisitos']) ?>" required><br><br>

            <label for="descricao">Descrição</label><br>
            <textarea id="descricao" name="descricao" rows="6"><?= htmlspecialchars($dados['descricao']) ?></textarea><br><br>

            <button type="submit" class="btn">Salvar Vaga</button>
            <a href="minhas-vagas.php" class="btn">Cancelar</a>
        </form>
        <?php else: ?>
            <a href="minhas-vagas.php" class="btn">Ver Minhas Vagas</a>
        <?php endif; ?>

    </div>
</div>
</body>
</html>
