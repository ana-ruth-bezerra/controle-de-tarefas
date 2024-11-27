<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Reiniciar Tarefa</title>
</head>
<body>
    <h1>Reiniciar Tarefa</h1>
    <form action="salvar_reiniciar_tarefa.php" method="POST">
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

                $sql = "SELECT * FROM tarefas WHERE status != 'finalizada' AND status != 'iniciada'";
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['titulo']}</option>";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            ?>
        </select>
        <button type="submit">Reiniciar</button>
    </form>
</body>
</html>