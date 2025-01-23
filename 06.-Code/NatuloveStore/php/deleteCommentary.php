<?php
// Incluir la conexión a la base de datos
include('db_connection.php');

// Verificar si el ID del comentario fue enviado
if (isset($_POST['id'])) {
    $commentId = $_POST['id'];

    // Conectar a la base de datos
    $conn = getDatabaseConnection();

    // Consulta para eliminar el comentario
    $sql = "DELETE FROM comentary WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Vincular el parámetro
        $stmt->bind_param("i", $commentId);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo 'success';  // Respuesta si la eliminación fue exitosa
        } else {
            echo 'error';  // Respuesta si hubo un error en la eliminación
        }

        // Cerrar la sentencia y la conexión
        $stmt->close();
    } else {
        echo 'error';  // Si no se pudo preparar la consulta
    }

    $conn->close();
} else {
    echo 'error';  // Si no se recibió el ID del comentario
}
?>
