<?php
$host = 'localhost';
$dbname = 'controle_tarefas';
$username = 'root';
$password = 'admin123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $responsavel_id = $_POST['responsavel_id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $sql = "UPDATE responsaveis SET nome = :nome, email = :email WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $responsavel_id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        echo "Responsável atualizado com sucesso!";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>