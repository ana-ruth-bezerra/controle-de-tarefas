<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar Tarefa</title>
</head>
<body>
    <h1>Editar Tarefa</h1>

    <?php
    $host = 'localhost';
    $dbname = 'controle_tarefas';
    $username = 'root';
    $password = 'admin123';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $tarefa_id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['tarefa_id']) ? $_POST['tarefa_id'] : null);

        if ($tarefa_id) {

            $sql = "SELECT * FROM tarefas WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $tarefa_id);
            $stmt->execute();
            $tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

            $sqlCategorias = "SELECT * FROM categorias";
            $stmtCategorias = $pdo->query($sqlCategorias);
            $categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);

            $sqlResponsaveis = "SELECT * FROM responsaveis";
            $stmtResponsaveis = $pdo->query($sqlResponsaveis);
            $responsaveis = $stmtResponsaveis->fetchAll(PDO::FETCH_ASSOC);

            if ($tarefa) {
        
                echo "<form action='salvar_editar_tarefa.php' method='POST'>";
                echo "<input type='hidden' name='tarefa_id' value='{$tarefa['id']}'>";

                echo "<label for='titulo'>Título:</label><br>";
                echo "<input type='text' id='titulo' name='titulo' value='{$tarefa['titulo']}' required><br>";

                echo "<br><label for='descricao'>Descrição:</label><br>";
                echo "<textarea id='descricao' name='descricao' required>{$tarefa['descricao']}</textarea><br>";

                echo "<br><label for='categoria_id'>Categoria: </label>";
                echo "<select id='categoria_id' name='categoria_id' required>";
                
                foreach ($categorias as $categoria) {
                    $selected = $tarefa['categoria_id'] == $categoria['id'] ? 'selected' : '';
                    echo "<option value='{$categoria['id']}' $selected>{$categoria['nome']}</option>";
                }
                
                echo "</select><br>";

                echo "<br><label for='responsavel_id'>Responsável: </label>";
                echo "<select id='responsavel_id' name='responsavel_id' required>";
                
                foreach ($responsaveis as $responsavel) {
                    $selected = $tarefa['responsavel_id'] == $responsavel['id'] ? 'selected' : '';
                    echo "<option value='{$responsavel['id']}' $selected>{$responsavel['nome']}</option>";
                }
                echo "</select><br><br>";

                echo "<button type='submit'>Salvar Alterações</button>";
                echo "</form>";
            } else {
                echo "Erro: Tarefa não encontrada.";
            }
        } else {

            echo "<form action='editar_tarefa.php' method='POST'>";
            echo "<label for='tarefa_id'>Selecione a Tarefa: </label>";
            echo "<select id='tarefa_id' name='tarefa_id' required>";
            
            $sql = "SELECT * FROM tarefas";
            $stmt = $pdo->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id']}'>{$row['titulo']}</option>";
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