<?php
include 'db.php';
session_start();

$success_message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['project_name']) && isset($_POST['description'])) {
        $project_name = $_POST['project_name'];
        $description = $_POST['description'];
        $ownerId = $_SESSION['user_id'];

        $sql = "INSERT INTO Projects (name, description, ownerId) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $error_message = "Erro na preparação da consulta: " . htmlspecialchars($conn->error);
        } else {
            $stmt->bind_param("ssi", $project_name, $description, $ownerId);

            if ($stmt->execute()) {
                $success_message = "Projeto cadastrado com sucesso.";
            } else {
                $error_message = "Erro: " . htmlspecialchars($stmt->error);
            }

            $stmt->close();
        }
    } else {
        $error_message = "Por favor, preencha todos os campos.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cadastrar Projeto</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <div class="container register">
        <h2>Cadastrar Projeto</h2>
        <?php if ($success_message): ?>
        <p><?php echo $success_message; ?></p>
        <?php elseif ($error_message): ?>
        <p><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="post" action="add_project.php">
            <input type="text" name="project_name" placeholder="Nome do Projeto" required>
            <textarea name="description" placeholder="Descrição do Projeto" required></textarea>
            <button type="submit">Cadastrar</button>
        </form>
        <button onclick="window.location.href='menu.php'">Voltar ao Menu</button>
        <button onclick="window.location.href='view_projects.php'">Visualizar Projetos</button>
    </div>
</body>

</html>