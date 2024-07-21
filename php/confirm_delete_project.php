<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'];

    $sql = "DELETE FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);

    if ($stmt->execute()) {
        header("Location: delete_project.php");
        exit();
    } else {
        $error_message = "Erro: " . htmlspecialchars($stmt->error);
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Excluir Projeto</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="project-action">
        <h2>Excluir Projeto</h2>
        <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>
        <button onclick="window.location.href='delete_project.php'">Voltar</button>
    </div>
</body>

</html>