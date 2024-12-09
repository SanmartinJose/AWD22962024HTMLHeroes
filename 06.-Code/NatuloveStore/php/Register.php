<?php
include 'db_connection.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitización de entrada
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $cedula = trim($_POST['cedula']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $passwordLogin = $_POST['passwordLogin'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $terms = isset($_POST['terms']);

    // Validaciones
    validateInput($first_name, $last_name, $cedula, $email, $username, $passwordLogin, $confirm_password, $phone, $address, $terms, $errors);

    // Insertar en base de datos si no hay errores
    if (empty($errors)) {
        $connection = getDatabaseConnection();
        $hashed_password = password_hash($passwordLogin, PASSWORD_BCRYPT);
        $creation_date = date('Y-m-d H:i:s');
        $status = 'activo';

        $stmt = $connection->prepare("INSERT INTO `users` ( `first_name`, `last_name`, `cedula`, `email`, `username`, `passwordLogin`, `phone`, `adress`, `creation_date`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssssssss', $first_name, $last_name, $cedula, $email, $username, $hashed_password, $phone, $address, $creation_date, $status);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors['database'] = "Error en la base de datos: " . $stmt->error;
        }

        $stmt->close();
        $connection->close();
    }
}

function validateInput($first_name, $last_name, $cedula, $email, $username, $passwordLogin, $confirm_password, $phone, $address, $terms, &$errors) {
    // Validaciones específicas
    if (!preg_match("/^[a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/", $first_name)) {
        $errors['first_name'] = "Solo se permiten caracteres alfabéticos y espacios.";
    }

    if (!preg_match("/^[a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/", $last_name)) {
        $errors['last_name'] = "Solo se permiten caracteres alfabéticos y espacios.";
    }

    if (!preg_match("/^[0-9]+$/", $cedula)) {
        $errors['cedula'] = "Solo se permiten números.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Formato de correo electrónico no válido.";
    }

    if (empty($username)) {
        $errors['username'] = "El nombre de usuario es obligatorio.";
    }

    if (!preg_match("/^(?=.*[0-9])(?=.*[.@#&_!-])(?=.*[a-zA-Z]).{8,}$/", $passwordLogin)) {
        $errors['passwordLogin'] = "La contraseña debe tener al menos 8 caracteres, incluir un número y un carácter especial (. @ # & _).";
    }

    if ($passwordLogin !== $confirm_password) {
        $errors['confirm_password'] = "Las contraseñas no coinciden.";
    }

    if (!preg_match("/^[0-9]+$/", $phone)) {
        $errors['phone'] = "Solo se permiten números.";
    }

    if (!preg_match("/^[a-zA-Z0-9ÑñáéíóúÁÉÍÓÚ ,.]+$/", $address)) {
        $errors['address'] = "Solo se permiten caracteres alfanuméricos, espacios y puntuación.";
    }

    if (!$terms) {
        $errors['terms'] = "Debe aceptar los términos y condiciones.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'Navbar.php'; ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Registro de Usuario</h1>
    <?php if ($success): ?>
        <div class="alert alert-success text-center">¡Registro exitoso!</div>
    <?php endif; ?>
    <form method="POST" action="">
        <!-- Campos del formulario -->
        <div class="mb-3">
            <label for="first_name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($first_name ?? '') ?>">
            <div class="text-danger"><?= $errors['first_name'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($last_name ?? '') ?>">
            <div class="text-danger"><?= $errors['last_name'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" class="form-control" id="cedula" name="cedula" value="<?= htmlspecialchars($cedula ?? '') ?>">
            <div class="text-danger"><?= $errors['cedula'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>">
            <div class="text-danger"><?= $errors['email'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($username ?? '') ?>">
            <div class="text-danger"><?= $errors['username'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label for="passwordLogin" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="passwordLogin" name="passwordLogin">
            <div class="text-danger"><?= $errors['passwordLogin'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            <div class="text-danger"><?= $errors['confirm_password'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($phone ?? '') ?>">
            <div class="text-danger"><?= $errors['phone'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <textarea class="form-control" id="address" name="address"><?= htmlspecialchars($address ?? '') ?></textarea>
            <div class="text-danger"><?= $errors['address'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms" name="terms">
                <label class="form-check-label" for="terms">Acepto los <a href="#" target="_blank">términos y condiciones</a>.</label>
            </div>
            <div class="text-danger"><?= $errors['terms'] ?? '' ?></div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Registrar</button>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
