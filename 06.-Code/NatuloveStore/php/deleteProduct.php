<?php
include('db_connection.php');

if (isset($_POST['id'])) {
    $productId = $_POST['id'];
    $conn = getDatabaseConnection();

    // Preparar la consulta para eliminar el producto
    $stmt = $conn->prepare("DELETE FROM Products WHERE id = ?");
    
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Usa "s" para parámetros de tipo cadena
    $stmt->bind_param("s", $productId);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'error: No ID provided';
}


?>
