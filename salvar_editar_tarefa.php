<?php
$host = 'localhost';
$dbname = 'controle_tarefas';
$username = 'root';
$password = 'admin123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tarefa_id = $_POST['tarefa_id'];
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $categoria_id = $_POST['categoria_id'];
        $responsavel_id = $_POST['responsavel_id'];

        if (empty($titulo) || empty($descricao) || empty($categoria_id) || empty($responsavel_id)) {
            echo "Erro: Todos os campos devem ser preenchidos.";
            exit;
        }

        try {
            $sql = "UPDATE tarefas SET titulo = :titulo, descricao = :descricao, categoria_id = :categoria_id, responsavel_id = :responsavel_id WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $tarefa_id);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':categoria_id', $categoria_id);
            $stmt->bindParam(':responsavel_id', $responsavel_id);
            $stmt->execute();

            echo "Tarefa '{$titulo}' atualizada com sucesso!";
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}