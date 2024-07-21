<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$project_id = $_GET['id'];

$sql = "SELECT Projects.id, Projects.name, Projects.description, Projects.created_at, Users.username,
        (SELECT SUM(TIMESTAMPDIFF(SECOND, start_time, end_time)) / 3600 FROM TimeEntries WHERE project_id = Projects.id) as hours_spent
        FROM Projects
        JOIN Users ON Projects.ownerId = Users.id
        WHERE Projects.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$stmt->bind_result($id, $name, $description, $created_at, $username, $hours_spent);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Detalhes do Projeto</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <div class="container project-details">
        <h2>Detalhes do Projeto</h2>
        <p><strong>ID:</strong> <?php echo $id; ?></p>
        <p><strong>Nome:</strong> <?php echo $name; ?></p>
        <p><strong>Descrição:</strong> <?php echo $description; ?></p>
        <p><strong>Criado por:</strong> <?php echo $username; ?></p>
        <p><strong>Data de Criação:</strong> <?php echo $created_at; ?></p>
        <p><strong>Horas Trabalhadas:</strong> <?php echo number_format($hours_spent, 2); ?></p>
        <button onclick="window.location.href='menu.php'">Voltar ao Menu</button>
        <button onclick="window.location.href='add_project.php'">Cadastrar Novo Projeto</button>
        <button onclick="window.location.href='select_project.php'">Selecionar Projetos</button>
    </div>
</body>

</html>