<?php
$host = 'localhost';
$dbname = 'controle_tarefas';
$username = 'root';
$password = 'admin123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];

        $sql = "INSERT INTO categorias (nome) VALUES (:nome)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();

        echo "Categoria '$nome' cadastrada com sucesso!";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
