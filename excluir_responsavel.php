<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Responsável</title>
</head>
<body>
    <h1>Excluir Responsável</h1>
    <form action="salvar_excluir_responsavel.php" method="POST">
        <label for="responsavel_id">Selecione o Responsável:</label>
        <select id="responsavel_id" name="responsavel_id" required>
            <?php
            $host = 'localhost';
            $dbname = 'controle_tarefas';
            $username = 'root';
            $password = 'admin123';

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este responsável?');">Excluir</button>
    </form>
</body>
</html>