<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE project_entries SET exit_time = NOW() WHERE project_id = ? AND user_id = ? AND exit_time IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $project_id, $user_id);

    if ($stmt->execute()) {
        header("Location: select_project.php");
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
    <title>Parar Projeto</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="project-action">
        <h2>Parar Projeto</h2>
        <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>
        <button onclick="window.location.href='select_project.php'">Voltar</button>
    </div>
</body>

</html>