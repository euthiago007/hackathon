<?php

$vagas = [
    [
        "id" => 1,
        "titulo" => "Desenvolvedor PHP",
        "empresa" => "Tech Solutions",
        "cidade" => "Umuarama"
    ],
    [
        "id" => 2,
        "titulo" => "Suporte Técnico",
        "empresa" => "Info Sistemas",
        "cidade" => "Maringá"
    ]
];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Vagas Disponíveis</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h1>Vagas Disponíveis</h1>
</header>

<div class="container">

    <?php foreach ($vagas as $vaga): ?>

        <div class="card-vaga">

            <h2><?= $vaga['titulo']; ?></h2>

            <p>
                Empresa: <?= $vaga['empresa']; ?>
            </p>

            <p>
                Cidade: <?= $vaga['cidade']; ?>
            </p>

            <a href="descricao.php" class="btn">
                Descrição da vaga
            </a>

        </div>

    <?php endforeach; ?>

</div>

</body>
</html>