<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5" style="text-align:center">Lista de Tarefas<br></h1>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Responsável</th>
                    <th>Status</th>
                    <th>Início</th>
                    <th>Pausa</th>
                    <th>Retomada</th>
                    <th>Fim</th>
                    <th>Duração</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $host = 'localhost';
                $dbname = 'controle_tarefas';
                $username = 'root';
                $password = 'admin123';

                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $sql = "SELECT t.id, t.titulo, t.descricao, c.nome AS categoria, r.nome AS responsavel, r.email, 
                                   t.status, t.inicio, t.pausa, t.fim, t.retomada,
                                   IFNULL(TIMESTAMPDIFF(SECOND, t.inicio, t.fim), 0) + t.tempo_total_pausado AS duracao_total
                            FROM tarefas t
                            JOIN categorias c ON t.categoria_id = c.id
                            JOIN responsaveis r ON t.responsavel_id = r.id";
                    $stmt = $pdo->query($sql);                   

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $duracao_total = $row['duracao_total'];
                        $horas = floor($duracao_total / 3600);
                        $minutos = floor(($duracao_total % 3600) / 60);
                        $segundos = $duracao_total % 60;

                        $retomada = ($row['retomada'] === null) ? 'N/A' : $row['retomada'];

                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['titulo']}</td>
                                <td>{$row['descricao']}</td>
                                <td>{$row['categoria']}</td>
                                <td>{$row['responsavel']} ({$row['email']})</td>
                                <td>{$row['status']}</td>
                                <td>{$row['inicio']}</td>
                                <td>{$row['pausa']}</td>
                                <td>{$retomada}</td>
                                <td>{$row['fim']}</td>
                                <td>{$horas}h {$minutos}m {$segundos}s</td>
                                <td>
                                    <a href='editar_tarefa.php?id={$row['id']}'>Editar</a>
                                    <a href='excluir_tarefa.php?id={$row['id']}'>Excluir</a>
                                </td>      
                              </tr>";
                    }
                } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
