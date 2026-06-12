<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Vaga</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h1>Editar Vaga</h1>
</header>

<div class="container">

    <div class="principal">

        <form>

            <label for="titulo">Título da Vaga</label>
            <br>
            <input
                type="text"
                id="titulo"
                value="Desenvolvedor PHP"
            >

            <br><br>

            <label for="cidade">Cidade</label>
            <br>
            <input
                type="text"
                id="cidade"
                value="Umuarama"
            >

            <br><br>

            <label for="descricao">Descrição</label>
            <br>
            <textarea id="descricao" rows="6">Desenvolvimento de sistemas web.</textarea>

            <br><br>

            <button class="btn">
                Atualizar Vaga
            </button>

            <br><br>

            <a href="minhas-vagas" class="btn">
                Voltar
            </a>

        </form>

    </div>

</div>

</body>
</html>