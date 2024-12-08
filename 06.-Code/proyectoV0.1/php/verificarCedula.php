<?php
require "crud.php"; // Asegúrate de que este archivo tenga la conexión a la base de datos

if (isset($_POST['cedula'])) {
    $cedula = $_POST['cedula'];

    // Consulta para verificar si la cédula ya existe
    $query = $pdo->prepare("SELECT COUNT(*) FROM clientes WHERE CEDULA = :cedula");
    $query->bindParam(':cedula', $cedula);
    $query->execute();
    $count = $query->fetchColumn();

    if ($count > 0) {
        echo "existe"; // La cédula ya está registrada
    } else {
        echo "no_existe"; // La cédula no está registrada
    }
} else {
    echo "error"; // En caso de que no se reciba la cédula
}
