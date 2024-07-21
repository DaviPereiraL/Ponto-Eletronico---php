<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Menu Principal</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <div class="container menu">
        <h2>Menu Principal</h2>
        <button onclick="window.location.href='add_project.php'">Cadastrar Projeto</button>
        <button onclick="window.location.href='view_projects.php'">Visualizar Projetos</button>
        <button onclick="window.location.href='select_project.php'">Selecionar Projeto</button>
        <button onclick="window.location.href='delete_project.php'">Excluir Projeto</button>
        <button onclick="window.location.href='logout.php'">Sair</button>
    </div>
</body>

</html>