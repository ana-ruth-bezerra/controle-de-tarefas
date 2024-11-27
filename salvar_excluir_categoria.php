<?php
$host = 'localhost';
$dbname = 'controle_tarefas';
$username = 'root';
$password = 'admin123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $categoria_id = $_POST['categoria_id'];

        $sql = "SELECT COUNT(*) FROM tarefas WHERE categoria_id = :categoria_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':categoria_id', $categoria_id);
        $stmt->execute();
        $contagem = $stmt->fetchColumn();

        if ($contagem > 0) {
            echo "Erro: Não é possível excluir a categoria. Existem tarefas associadas.";
        } else {
            $sql = "DELETE FROM categorias WHERE id = :categoria_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':categoria_id', $categoria_id);
            $stmt->execute();

            echo "Categoria excluída com sucesso!";
        }
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}