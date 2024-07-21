<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$project_id = $_POST['project_id'] ?? null;
$user_id = $_SESSION['user_id'];

if ($project_id) {
    // Entrar no projeto
    $sql = "INSERT INTO TimeEntries (project_id, user_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $project_id, $user_id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['current_project_id'] = $project_id;
    header("Location: select_project.php");
    exit();
} elseif (isset($_POST['exit'])) {
    // Sair do projeto
    $current_project_id = $_SESSION['current_project_id'];
    $sql = "UPDATE TimeEntries SET end_time = NOW() WHERE project_id = ? AND user_id = ? AND end_time IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $current_project_id, $user_id);
    $stmt->execute();
    $stmt->close();

    unset($_SESSION['current_project_id']);
    header("Location: select_project.php");
    exit();
}

// Obter a lista de projetos
$sql = "SELECT id, name, description FROM Projects";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Selecionar Projeto</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <div class="container project-select">
        <h2>Selecionar Projeto</h2>
        <form method="post" action="select_project.php">
            <select name="project_id" required>
                <option value="">Selecione um Projeto</option>
                <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Entrar no Projeto</button>
        </form>

        <?php if (isset($_SESSION['current_project_id'])): ?>
        <form method="post" action="select_project.php">
            <button name="exit" type="submit">Sair do Projeto</button>
        </form>
        <?php endif; ?>

        <button onclick="window.location.href='menu.php'">Voltar ao Menu</button>
    </div>
</body>

</html>