<?php
include 'db_connection.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $passwordLogin = trim($_POST['passwordLogin']);

    if (empty($username) || empty($passwordLogin)) {
        $errors['login'] = "El usuario y la contraseña son obligatorios.";
    } else {
        $connection = getDatabaseConnection();
        $stmt = $connection->prepare("SELECT passwordLogin FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($passwordLogin, $user['passwordLogin'])) {
                // Redirigir al index si la autenticación es exitosa
                header("Location: ../php/indexAdmin.php");
                exit;
            } else {
                $errors['login'] = "Usuario o contraseña incorrectos.";
            }
        } else {
            $errors['login'] = "Usuario o contraseña incorrectos.";
        }

        $stmt->close();
        $connection->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/loginForm.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/login.js" defer></script>
</head>
<body>
<div class="container-form d-flex justify-content-center align-items-center vh-100">
    <form method="POST" id="loginForm" class="form-control bg-white border border-danger shadow p-4 rounded position-relative">
        <!-- Flecha de regreso -->
        <a href="../index.php" class="btn btn-outline-danger position-absolute" style="top: 10px; left: 10px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5a.5.5 0 0 1 .5.5z"/>
            </svg>
        </a>

        <div class="container-fluid text-center">
            <img class="mb-4" src="../img/logo.png" alt="Logo" width="90" height="90">
        </div>
        <h1 class="h3 mb-3 fw-bold text-danger text-center">Inicio de sesión</h1>
        
        <?php if (!empty($errors['login'])): ?>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" width="30" height="30">
                    <use xlink:href="#exclamation-triangle-fill"></use>
                </svg>
                <div><?= htmlspecialchars($errors['login']) ?></div>
            </div>
        <?php endif; ?>

        <div class="form-floating mb-3">
            <input type="text" class="form-control border-danger" id="username" name="username" placeholder="Usuario" required>
            <label for="username">Usuario</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control border-danger" id="passwordLogin" name="passwordLogin" placeholder="Contraseña" required>
            <label for="passwordLogin">Contraseña</label>
        </div>

        <button class="btn btn-danger w-100 py-2" type="submit">Iniciar sesión</button>
        <p class="mt-5 mb-3 text-body-secondary text-center">© 2024</p>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/login.js"></script>
</body>
</html>
