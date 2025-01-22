<?php
require 'db_connection.php';
require 'config.php'; // Configuración de Google Client

function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Iniciar la sesión solo si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Manejo del inicio de sesión tradicional
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getDatabaseConnection();

    $usernameOrEmail = validateInput($_POST['username_or_email']);
    $password = validateInput($_POST['password']);

    $errors = [];

    if (empty($usernameOrEmail) || empty($password)) {
        $errors[] = "Por favor, complete todos los campos.";
    } else {
        // Verificar si el correo o nombre de usuario existe en la base de datos
        $stmt = $conn->prepare("SELECT id, username, email, password, role FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param('ss', $usernameOrEmail, $usernameOrEmail);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $email, $hashedPassword, $role);
            $stmt->fetch();

            // Verificar si la contraseña coincide
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                // Redirigir al cliente o administrador
                if ($role === 'customer') {
                    header("Location: ./index.php");
                    exit;
                } else {
                    header("Location: indexAdmin.php");
                    exit;
                }
            } else {
                $errors[] = "Usuario o contraseña incorrectos. Revise las credenciales.";
            }
        } else {
            $errors[] = "Usuario o correo no registrado.";
        }

        $stmt->close();
    }

    $conn->close();
}

// Manejo del inicio de sesión con Google
$login_button = '';
$username = ''; // Variable para almacenar el nombre de usuario
$password = ''; // Variable para almacenar la contraseña (esto será solo una predefinición)

if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if (!isset($token['error'])) {
        // Establecer el token de acceso
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];

        // Obtener la información del usuario desde Google
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();

        // Si la información de correo electrónico está disponible
        if (!empty($data['email'])) {
            // Guardar el correo en la sesión
            $_SESSION['user_email_address'] = $data['email'];

            // Validar si el correo está registrado en la base de datos
            $email = validateInput($data['email']);
            $username = validateInput($data['name']); // El nombre proviene de Google

            $conn = getDatabaseConnection();
            $stmt = $conn->prepare("SELECT id, username, email, password, role FROM users WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // El correo está registrado, obtenemos los datos
                $stmt->bind_result($id, $username, $email, $hashedPassword, $role);
                $stmt->fetch();

                // Asignamos los valores a las variables para autocompletar el formulario
                $password = ''; // No mostramos la contraseña, solo la completamos para el formulario

                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                // Redirigir dependiendo del rol
                if ($role === 'customer') {
                    header("Location: catalog.php");
                    exit;
                } else {
                    header("Location: catalog.php");
                    exit;
                }

            } else {
                // Si el correo no está registrado, insertamos los datos en la base de datos
                $firstName = 'Usuario Correo'; // Default, ya que Google no proporciona el primer nombre
                $lastName = 'DUsuario Correo'; // Default, ya que Google no proporciona el apellido
                $birthDate = '1990-01-01'; // Default, puedes asignar el valor si lo tienes en otro campo
                $password = ''; // No se requiere contraseña si se logea con Google
                $role = 'customer'; // Definir el rol como 'customer'

                // Insertamos los datos en la base de datos
                $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, birth_date, email, username, password, role, created_at) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
                $stmt->bind_param('sssssss', $firstName, $lastName, $birthDate, $email, $username, $password, $role);
                if ($stmt->execute()) {
                    // Luego de insertar el usuario, lo redirigimos según el rol
                    $_SESSION['user_email_address'] = $email;
                    $_SESSION['username'] = $username;

                    // Asignamos el ID del usuario y el rol
                    $_SESSION['user_id'] = $conn->insert_id; // ID generado automáticamente
                    $_SESSION['role'] = $role;

                    // Redirigir según el rol
                    if ($role === 'customer') {
                        header("Location: ./index.php");
                        exit;
                    } else {
                        header("Location: indexAdmin.php");
                        exit;
                    }
                } else {
                    $_SESSION['error_message'] = "Hubo un problema al registrar tu cuenta.";
                    header("Location: Register.php"); // Redirigir a la página de registro
                    exit;
                }

                $stmt->close();
                $conn->close();
            }
        }
    }
}

// Mostrar el botón de inicio de sesión con Google si no hay un token de acceso
if (!isset($_SESSION['access_token'])) {
    $login_button = '<a href="' . $google_client->createAuthUrl() . '" class="btn btn-danger">Iniciar sesión con Google</a>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
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
                <input type="text" id="username_or_email" name="username_or_email" class="form-control" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required>
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
                <?= $login_button ?>
            </div>

            <div class="text-center mt-3">
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
</body
