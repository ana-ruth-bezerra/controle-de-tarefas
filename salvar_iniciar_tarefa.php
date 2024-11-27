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

        $sql = "SELECT * FROM tarefas WHERE id = :id AND status != 'iniciada' AND status != 'pausada'";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $tarefa_id);
        $stmt->execute();
        $tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tarefa) {
            $sql = "UPDATE tarefas SET status = 'iniciada', inicio = NOW() WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $tarefa_id);
            $stmt->execute();

            echo "Tarefa '{$tarefa['titulo']}' iniciada com sucesso!";
        } else {
            echo "Erro: Tarefa já está iniciada ou pausada e não pode ser iniciada novamente.";
        }
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
