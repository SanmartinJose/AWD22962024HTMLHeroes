<?php
session_start();
session_unset(); // Destruye todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirigir al inicio o página deseada sin especificar la dirección completa
header("Location: ../index.php"); // Para redirigir un nivel atrás

exit;
?>

