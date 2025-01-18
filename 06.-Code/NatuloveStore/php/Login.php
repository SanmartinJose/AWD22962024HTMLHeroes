<?php
require 'db_connection.php';

function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getDatabaseConnection();

    $usernameOrEmail = validateInput($_POST['username_or_email']);
    $password = validateInput($_POST['password']);

    $errors = [];

    if (empty($usernameOrEmail) || empty($password)) {
        $errors[] = "Por favor, complete todos los campos.";
    } else {
        $stmt = $conn->prepare("SELECT id, username, email, password, role FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param('ss', $usernameOrEmail, $usernameOrEmail);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $email, $hashedPassword, $role);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                // Redirigir según el rol
                if ($role === 'customer') {
                    header("Location: ../index.php");
                } else {
                    header("Location: indexAdmin.php");
                }
                exit;
            } else {
                $errors[] = "Usuario o contraseña incorrectos. Revise las credenciales.";
            }
        } else {
            $errors[] = "Usuario o contraseña incorrectos. Revise las credenciales.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'Navbar.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Iniciar Sesión</h2>
        <form method="POST" class="p-4 border rounded">
            <?php
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
            ?>
            <div class="mb-3">
                <label for="username_or_email" class="form-label">Nombre de Usuario o Correo Electrónico:</label>
                <input type="text" id="username_or_email" name="username_or_email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="togglePasswordVisibility('password')">Mostrar</button>
            </div>

            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </div>

            <div class="text-center">
                <a href="Register.php" class="btn btn-link">¿No tienes cuenta? Regístrate</a>
                <a href="passwordRecover.php" class="btn btn-link">¿Olvidaste tu contraseña?</a>
            </div>
        </form>
    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === 'password' ? 'text' : 'password';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php include 'Footer.php'; ?>
</body>
</html>
