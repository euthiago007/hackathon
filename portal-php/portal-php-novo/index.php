<?php
session_start();
require_once 'model/Aluno.php';
require_once 'model/Empresa.php';

// Polimorfismo em ação: montamos a lista de perfis como Usuario[]
// e chamamos os mesmos métodos — cada objeto responde de forma diferente
$perfis = [
    new Aluno(0, 'Estudante UniALFA', '', '', ''),
    new Empresa(0, 'Empresa Parceira', '', '', '', 'aprovada')
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Estágios UniALFA</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <h1>Portal de Estágios UniALFA</h1>
</header>

<nav>
    <a href="index.php">Início</a>
    <a href="portal-aluno/vagas.php">Vagas</a>
    <a href="portal-aluno/minhas-candidaturas.php">Minhas Candidaturas</a>
    <a href="portal-empresa/login.php">Área da Empresa</a>
</nav>

<div class="container">
    <div class="principal">
        <h2>Conectando talentos às oportunidades</h2>
        <p>Encontre vagas de estágio ou publique oportunidades para estudantes da UniALFA.</p>

        <?php
        // Polimorfismo: o mesmo foreach chama getTipoPerfil(), getAreaAcesso() e getLinkArea()
        // em objetos diferentes — cada um responde com seu próprio comportamento
        foreach ($perfis as $usuario):
        ?>
            <a href="<?= $usuario->getLinkArea() ?>" class="btn">
                <?= $usuario->getAreaAcesso() ?> (<?= $usuario->getTipoPerfil() ?>)
            </a>
        <?php endforeach; ?>
    </div>
</div>

<footer>© 2026 Portal de Estágios UniALFA</footer>

</body>
</html>
