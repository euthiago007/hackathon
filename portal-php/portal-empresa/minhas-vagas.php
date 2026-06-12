<?php

$vagas = [
    [
        "id" => 1,
        "titulo" => "Desenvolvedor PHP",
        "cidade" => "Umuarama"
    ],
    [
        "id" => 2,
        "titulo" => "Suporte Técnico",
        "cidade" => "Maringá"
    ]
];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Minhas Vagas</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h1>Minhas Vagas</h1>
</header>

<div class="container">

    <?php foreach ($vagas as $vaga): ?>

        <div class="card-vaga">

            <h2><?= $vaga['titulo']; ?></h2>

            <p>
                Cidade: <?= $vaga['cidade']; ?>
            </p>

            <a href="editar-vaga.php" class="btn">
                Editar
            </a>

            <a href="candidatos.php" class="btn">
                Candidatos
            </a>

        </div>

    <?php endforeach; ?>

    <a href="dashboard.php" class="btn">
        Voltar ao Painel
    </a>

</div>

</body>
</html>