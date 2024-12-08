<?php
include 'db_connection.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitización de entrada
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $gender = $_POST['gender'] ?? '';
    $birth_date = $_POST['birth_date'] ?? '';
    $address = trim($_POST['address']);
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $terms = isset($_POST['terms']);

    // Validaciones
    validateInput($first_name, $last_name, $email, $gender, $birth_date, $address, $password, $confirm_password, $terms, $errors);

    // Insertar en base de datos si no hay errores
    if (empty($errors)) {
        $connection = getDatabaseConnection();
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $connection->prepare("INSERT INTO users (first_name, last_name, email, gender, birth_date, address, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, 'customer')");
        $stmt->bind_param("sssssss", $first_name, $last_name, $email, $gender, $birth_date, $address, $hashed_password);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors['database'] = "Error en la base de datos: " . $stmt->error;
        }

        $stmt->close();
        $connection->close();
    }
}

function validateInput($first_name, $last_name, $email, $gender, $birth_date, $address, $password, $confirm_password, $terms, &$errors) {
    if (!preg_match("/^[a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/", $first_name)) {
        $errors['first_name'] = "Solo se permiten caracteres alfabéticos y espacios.";
    }

    if (!preg_match("/^[a-zA-ZÑñáéíóúÁÉÍÓÚ ]+$/", $last_name)) {
        $errors['last_name'] = "Solo se permiten caracteres alfabéticos y espacios.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Formato de correo electrónico no válido.";
    }

    if (!in_array($gender, ['Masculino', 'Femenino'])) {
        $errors['gender'] = "Seleccione un género válido.";
    }

    if (empty($birth_date)) {
        $errors['birth_date'] = "Seleccione una fecha de nacimiento válida.";
    } else {
        $birth_date_obj = new DateTime($birth_date);
        $today = new DateTime();
        $age = $today->diff($birth_date_obj)->y;
        if ($age < 18) {
            $errors['birth_date'] = "Debe ser mayor de 18 años.";
        }
    }

    if (!preg_match("/^[a-zA-Z0-9ÑñáéíóúÁÉÍÓÚ ,.]+$/", $address)) {
        $errors['address'] = "Solo se permiten caracteres alfanuméricos, espacios y puntuación.";
    }

    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$.!%*?&])[A-Za-z\d@$.!%*?&]{8,}$/", $password)) {
        $errors['password'] = "La contraseña debe tener al menos 8 caracteres, incluyendo un número y un carácter especial.";
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Las contraseñas no coinciden.";
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
    <script>
        function showSuccessMessage() {
            alert('¡Registro exitoso!');
        }
    </script>
</head>
<body>
<?php include 'Navbar.php'; ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Registro de Usuario</h1>
    <?php if ($success): ?>
        <script>
            showSuccessMessage();
        </script>
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
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>">
            <div class="text-danger"><?= $errors['email'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label class="form-label">Género</label>
            <div>
                <input type="radio" id="male" name="gender" value="Masculino" <?= isset($gender) && $gender === 'Masculino' ? 'checked' : '' ?>>
                <label for="male">Masculino</label>
                <input type="radio" id="female" name="gender" value="Femenino" <?= isset($gender) && $gender === 'Femenino' ? 'checked' : '' ?>>
                <label for="female">Femenino</label>
            </div>
            <div class="text-danger"><?= $errors['gender'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?= htmlspecialchars($birth_date ?? '') ?>">
            <div class="text-danger"><?= $errors['birth_date'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <textarea class="form-control" id="address" name="address"><?= htmlspecialchars($address ?? '') ?></textarea>
            <div class="text-danger"><?= $errors['address'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
            <div class="text-danger"><?= $errors['password'] ?? '' ?></div>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            <div class="text-danger"><?= $errors['confirm_password'] ?? '' ?></div>
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
