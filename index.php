<?php
session_start();

// Inicializa o array de tarefas na sessão, se ainda não estiver inicializado
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Função para adicionar uma tarefa à sessão
function addTask($task) {
    $_SESSION['tasks'][] = trim($task);
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    addTask($_POST['task']);
    header('Location: index.php'); // Redireciona para evitar reenvio do formulário
    exit();
}

$tasks = $_SESSION['tasks'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
</head>
<body>
    <h1>Lista de Tarefas</h1>
    
    <form action="index.php" method="POST">
        <input type="text" name="task" placeholder="Digite uma nova tarefa" required>
        <button type="submit">Adicionar</button>
    </form>
    
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li><?php echo htmlspecialchars($task); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>