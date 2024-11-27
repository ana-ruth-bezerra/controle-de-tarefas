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
        $nome = $_POST['nome'];

        $sql = "UPDATE categorias SET nome = :nome WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $categoria_id);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();

        echo "Categoria atualizada com sucesso!";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>