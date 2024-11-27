<?php
$host = 'localhost';
$dbname = 'controle_tarefas';
$username = 'root';
$password = 'admin123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $categoria_id = $_POST['categoria_id'];
        $responsavel_id = $_POST['responsavel_id'];

        $sql = "INSERT INTO tarefas (titulo, descricao, categoria_id, responsavel_id) VALUES (:titulo, :descricao, :categoria_id, :responsavel_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':categoria_id', $categoria_id);
        $stmt->bindParam(':responsavel_id', $responsavel_id);
        $stmt->execute();

        echo "Tarefa '$titulo' cadastrada com sucesso!";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>