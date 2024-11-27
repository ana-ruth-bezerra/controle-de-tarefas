<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar Categoria</title>
</head>
<body>
    <h1>Editar Categoria</h1>

    <?php
    $host = 'localhost';
    $dbname = 'controle_tarefas';
    $username = 'root';
    $password = 'admin123';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $categoria_id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['categoria_id']) ? $_POST['categoria_id'] : null);

        if ($categoria_id) {
            $sql = "SELECT * FROM categorias WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $categoria_id);
            $stmt->execute();
            $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($categoria) {

                echo "<form action='salvar_editar_categoria.php' method='POST'>";
                echo "<input type='hidden' name='categoria_id' value='{$categoria['id']}'>";

                echo "<label for='nome'>Nome da Categoria: </label><br>";
                echo "<input type='text' id='nome' name='nome' value='{$categoria['nome']}' required><br>";
                
                echo "<br><button type='submit'>Salvar Alterações</button>";
                echo "</form>";
            } else {
                echo "Erro: Categoria não encontrada.";
            }
        } else {
            echo "<form action='editar_categoria.php' method='POST'>";
            echo "<label for='categoria_id'>Selecione a Categoria: </label>";
            echo "<select id='categoria_id' name='categoria_id' required>";
            
            $sql = "SELECT * FROM categorias";
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