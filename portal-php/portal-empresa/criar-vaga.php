<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Vaga</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h1>Nova Vaga</h1>
</header>

<div class="container">

    <div class="principal">

        <form>

            <label for="titulo">Título da Vaga</label>
            <br>
            <input type="text" id="titulo" name="titulo">

            <br><br>

            <label for="cidade">Cidade</label>
            <br>
            <input type="text" id="cidade" name="cidade">

            <br><br>

            <label for="descricao">Descrição</label>
            <br>
            <textarea id="descricao" name="descricao" rows="6"></textarea>

            <br><br>

            <button type="submit" class="btn">
                Salvar Vaga
            </button>

            <br><br>

            <a href="dashboard.php" class="btn">
                Cancelar
            </a>

        </form>

    </div>

</div>

</body>
</html>