<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Categoria</title>
</head>
<body>
    <h1>Excluir Categoria</h1>
    <form action="salvar_excluir_categoria.php" method="POST">
        <label for="categoria_id">Selecione a Categoria:</label>
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
        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir esta categoria?');">Excluir</button>
    </form>
</body>
</html>