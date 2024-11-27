<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de Tarefas</title>
</head>
<body>
    <h1>Cadastro de Tarefas</h1>
    <form action="salvar_tarefa.php" method="POST">
        <label for="titulo">Título da Tarefa:<br></label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="descricao"><br><br>Descrição:<br></label>
        <textarea id="descricao" name="descricao"></textarea>

        <label for="categoria_id"><br><br>Categoria:</label>
        <select id="categoria_id" name="categoria_id" required>
            <?php
            $host = 'localhost';
            $dbname = 'controle_tarefas';
            $username = 'root';
            $password = 'admin123';

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM categorias";
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            ?>
        </select>

        <label for="responsavel_id"><br><br>Responsável:</label>
        <select id="responsavel_id" name="responsavel_id" required>
            <?php
            try {
                $sql = "SELECT * FROM responsaveis";
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            ?>
        </select>
        <br><br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>