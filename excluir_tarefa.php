<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Excluir Tarefa</title>
</head>
<body>
    <h1>Excluir Tarefa</h1>

    <?php
    $host = 'localhost';
    $dbname = 'controle_tarefas';
    $username = 'root';
    $password = 'admin123';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $tarefa_id = isset($_POST['tarefa_id']) ? $_POST['tarefa_id'] : (isset($_GET['id']) ? $_GET['id'] : null);

        if ($tarefa_id) {
            $sql = "SELECT * FROM tarefas WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $tarefa_id);
            $stmt->execute();
            $tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($tarefa) {
                echo "<form action='salvar_excluir_tarefa.php' method='POST'>";
                echo "<input type='hidden' name='tarefa_id' value='{$tarefa['id']}'>";
                echo "<p>Você tem certeza que deseja excluir a tarefa '{$tarefa['titulo']}'?</p>";
                echo "<button type='submit'>Excluir</button>";
                echo "</form>";
            } else {
                echo "Erro: Tarefa não encontrada.";
            }
        } else {
            echo "<form action='excluir_tarefa.php' method='POST'>";
            echo "<label for='tarefa_id'>Selecione a Tarefa:</label>";
            echo "<select id='tarefa_id' name='tarefa_id' required>";
            
            $sql = "SELECT * FROM tarefas";
            $stmt = $pdo->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id']}'>{$row['titulo']}</option>";
            }
            echo "</select><br><br>";

            echo "<button type='submit'>Carregar Tarefa</button>";
            echo "</form>";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?>
</body>
</html>