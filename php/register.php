<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error_message = "As senhas não coincidem.";
    } else {
        // Verificar se o usuário já existe
        $sql = "SELECT id FROM Users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error_message = "Nome de usuário já cadastrado.";
        } else {
            // Inserir novo usuário
            $sql = "INSERT INTO Users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $success_message = "Cadastro realizado com sucesso.";
                header("Location: login.php?success_message=" . urlencode($success_message));
                exit();
            } else {
                $error_message = "Erro ao cadastrar usuário.";
            }
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <div class="container">
        <h2>Cadastrar Usuário</h2>
        <?php if (isset($error_message)): ?>
        <p><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="post" action="register.php">
            <input type="text" name="username" placeholder="Nome de Usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
            <input type="password" name="confirm_password" placeholder="Confirme a Senha" required>
            <button type="submit">Cadastrar</button>
            <button type="button" onclick="window.location.href='login.php'">Voltar ao Login</button>
        </form>
    </div>
</body>

</html>