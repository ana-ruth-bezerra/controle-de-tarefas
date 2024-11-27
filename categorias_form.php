<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de Categorias</title>
</head>
<body>
    <h1>Cadastro de Categorias</h1>
    <form action="salvar_categoria.php" method="POST">
        <label for="nome">Nome da Categoria:<br></label>
        <input type="text" id="nome" name="nome" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>