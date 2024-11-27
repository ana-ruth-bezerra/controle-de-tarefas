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

        $sql = "SELECT COUNT(*) FROM tarefas WHERE responsavel_id = :responsavel_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':responsavel_id', $responsavel_id);
        $stmt->execute();
        $contagem = $stmt->fetchColumn();

        if ($contagem > 0) {
            echo "Erro: Não é possível excluir o responsável. Existem tarefas associadas.";
        } else {
            $sql = "DELETE FROM responsaveis WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $responsavel_id);
            $stmt->execute();

            echo "Responsável excluído com sucesso!";
        }
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}