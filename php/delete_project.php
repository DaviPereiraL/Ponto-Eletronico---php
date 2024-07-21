<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'];

    // Excluir o projeto
    $sql = "DELETE FROM Projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);

    if ($stmt->execute()) {
        $success_message = "Projeto excluído com sucesso.";
    } else {
        $error_message = "Erro ao excluir projeto.";
    }

    $stmt->close();
}

// Obter a lista de projetos
$sql = "SELECT id, name FROM Projects";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Excluir Projeto</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <div class="container project-action">
        <h2>Excluir Projeto</h2>
        <?php if (isset($success_message)): ?>
        <p><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
        <p><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="post" action="delete_project.php">
            <select name="project_id" required>
                <option value="">Selecione um Projeto</option>
                <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Excluir Projeto</button>
        </form>
        <button onclick="window.location.href='menu.php'">Voltar ao Menu</button>
    </div>
</body>

</html>