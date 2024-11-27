<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar Responsável</title>
</head>
<body>
    <h1>Editar Responsável</h1>

    <?php
    $host = 'localhost';
    $dbname = 'controle_tarefas';
    $username = 'root';
    $password = 'admin123';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $responsavel_id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['responsavel_id']) ? $_POST['responsavel_id'] : null);

        if ($responsavel_id) {
            $sql = "SELECT * FROM responsaveis WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $responsavel_id);
            $stmt->execute();
            $responsavel = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($responsavel) {

                echo "<form action='salvar_editar_responsavel.php' method='POST'>";
                echo "<input type='hidden' name='responsavel_id' value='{$responsavel['id']}'>";

                echo "<label for='nome'>Nome: </label><br>";
                echo "<input type='text' id='nome' name='nome' value='{$responsavel['nome']}' required><br>";

                echo "<br><label for='email'>Email: </label><br>";
                echo "<input type='email' id='email' name='email' value='{$responsavel['email']}' required><br>";
                
                echo "<br><button type='submit'>Salvar Alterações</button>";
                echo "</form>";
            } else {
                echo "Erro: Responsável não encontrado.";
            }
        } else {
            echo "<form action='editar_responsavel.php' method='POST'>";
            echo "<label for='responsavel_id'>Selecione o Responsável: </label>";
            echo "<select id='responsavel_id' name='responsavel_id' required>";
            
            $sql = "SELECT * FROM responsaveis";
            $stmt = $pdo->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id']}'>{$row['nome']}</option>";
            }
            echo "</select><br><br>";

            echo "<button type='submit'>Carregar</button>";
            echo "</form>";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?>
</body>
</html>