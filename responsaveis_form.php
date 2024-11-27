<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de Responsáveis</title>
</head>
<body>
    <h1>Cadastro de Responsáveis</h1>
    <form action="salvar_responsavel.php" method="POST">
        <label for="nome">Nome do Responsável:</label><br>
        <input type="text" id="nome" name="nome" required>
        <label for="email"><br><br>E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>