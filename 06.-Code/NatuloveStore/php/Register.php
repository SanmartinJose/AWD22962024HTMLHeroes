<?php
require 'db_connection.php';

function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function validateAge($birthDate) {
    $today = new DateTime();
    $dob = new DateTime($birthDate);
    $age = $today->diff($dob)->y;
    return $age >= 18 && $age <= 99;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getDatabaseConnection();

    $firstName = validateInput($_POST['first_name']);
    $lastName = validateInput($_POST['last_name']);
    $birthDate = validateInput($_POST['birth_date']);
    $email = validateInput($_POST['email']);
    $username = validateInput($_POST['username']);
    $password = validateInput($_POST['password']);
    $confirmPassword = validateInput($_POST['confirm_password']);
    $acceptTerms = isset($_POST['accept_terms']);
    $role = 'customer';

    $errors = [];

    // Validations
    if (!preg_match("/^[a-zA-ZñÑ ]+$/", $firstName)) {
        $errors[] = "El nombre solo puede contener caracteres alfabéticos, espacios y la ñ.";
    }

    if (!preg_match("/^[a-zA-ZñÑ ]+$/", $lastName)) {
        $errors[] = "El apellido solo puede contener caracteres alfabéticos, espacios y la ñ.";
    }

    if (!validateAge($birthDate)) {
        $errors[] = "Debes tener entre 18 y 99 años.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El formato del correo electrónico no es válido.";
    } else {
        $emailQuery = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $emailQuery->bind_param('s', $email);
        $emailQuery->execute();
        $emailQuery->store_result();
        if ($emailQuery->num_rows > 0) {
            $errors[] = "El correo electrónico ya está registrado.";
        }
    }

    if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
        $errors[] = "El nombre de usuario solo puede contener caracteres alfanuméricos.";
    } else {
        $usernameQuery = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $usernameQuery->bind_param('s', $username);
        $usernameQuery->execute();
        $usernameQuery->store_result();
        if ($usernameQuery->num_rows > 0) {
            $errors[] = "El nombre de usuario ya está en uso.";
        }
    }

    if (strlen($password) < 8 || !preg_match("/\d/", $password)) {
        $errors[] = "La contraseña debe tener al menos 8 caracteres y contener al menos un número.";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    if (!$acceptTerms) {
        $errors[] = "Debes aceptar los términos y condiciones.";
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, birth_date, email, username, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssss', $firstName, $lastName, $birthDate, $email, $username, $hashedPassword, $role);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Registro exitoso.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al registrar al usuario: " . $conn->error . "</div>";
        }

        $stmt->close();
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'Navbar.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Registro de Usuario</h2>
        <form method="POST" class="p-4 border rounded">
            <div class="mb-3">
                <label for="first_name" class="form-label">Nombre:</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Apellido:</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="birth_date" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" id="birth_date" name="birth_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="togglePasswordVisibility('password')">Mostrar</button>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Repetir Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" id="accept_terms" name="accept_terms" class="form-check-input" required>
                <label for="accept_terms" class="form-check-label">Acepto los términos y condiciones</label>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
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

