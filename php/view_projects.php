<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT Projects.id, Projects.name, Users.username, Projects.created_at,
        (SELECT SUM(TIMESTAMPDIFF(SECOND, start_time, end_time)) / 3600 FROM TimeEntries WHERE project_id = Projects.id) as hours_spent
        FROM Projects
        JOIN Users ON Projects.ownerId = Users.id";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Visualizar Projetos</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <div class="container project-list">
        <h2>Visualizar Projetos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Criado por</th>
                    <th>Data de Criação</th>
                    <th>Horas Trabalhadas</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td><?php echo number_format($row['hours_spent'], 2); ?></td>
                    <td><a href="project_details.php?id=<?php echo $row['id']; ?>">Ver Detalhes</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button onclick="window.location.href='menu.php'">Voltar ao Menu</button>
    </div>
</body>

</html>