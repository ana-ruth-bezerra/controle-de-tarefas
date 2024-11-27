<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Finalizar Tarefa</title>
</head>
<body>
    <h1>Finalizar Tarefa</h1>
    <form action="salvar_finalizar_tarefa.php" method="POST">
        <label for="tarefa_id">Selecione a Tarefa:</label>
        <select id="tarefa_id" name="tarefa_id" required>
            <?php
            $host = 'localhost';
            $dbname = 'controle_tarefas';
            $username = 'root';
            $password = 'admin123';

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM tarefas WHERE status != 'finalizada'";
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['titulo']}</option>";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            ?>
        </select>
        <button type="submit">Finalizar</button>
    </form>
</body>
</html>