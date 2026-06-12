<?php

$candidatos = [
    [
        "nome" => "João Silva",
        "curso" => "Sistemas para Internet"
    ],
    [
        "nome" => "Maria Souza",
        "curso" => "Análise e Desenvolvimento de Sistemas"
    ],
    [
        "nome" => "Carlos Oliveira",
        "curso" => "Sistemas para Internet"
    ]
];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Candidatos</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h1>Candidatos da Vaga</h1>
</header>

<div class="container">

    <?php foreach ($candidatos as $candidato): ?>

        <div class="card-vaga">

            <h2><?= $candidato['nome']; ?></h2>

            <p>
                Curso: <?= $candidato['curso']; ?>
            </p>

        </div>

    <?php endforeach; ?>

</div>

</body>
</html>