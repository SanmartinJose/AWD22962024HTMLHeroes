<?php
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getDatabaseConnection();

    // Recibir y validar datos del formulario
    $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $productName = isset($_POST['product_name']) ? $conn->real_escape_string($_POST['product_name']) : '';
    $productDescription = isset($_POST['product_description']) ? $conn->real_escape_string($_POST['product_description']) : '';
    $productPrice = isset($_POST['product_price']) ? floatval($_POST['product_price']) : 0.0;
    $productInventory = isset($_POST['product_inventory']) ? intval($_POST['product_inventory']) : 0;

    // Manejo de la imagen
    $imagePath = null;
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $imageName = basename($_FILES['product_image']['name']);
        $imagePath = $uploadDir . uniqid() . '_' . $imageName;

        if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $imagePath)) {
            die("Error al cargar la imagen.");
        }
    }

    // Preparar y ejecutar consulta
    $sql = "UPDATE Products SET name = ?, description = ?, price = ?, inventory = ?";
    if ($imagePath) {
        $sql .= ", images = JSON_ARRAY(?)";
    }
    $sql .= " WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($imagePath) {
        $stmt->bind_param("ssdiss", $productName, $productDescription, $productPrice, $productInventory, $imagePath, $productId);
    } else {
        $stmt->bind_param("ssdis", $productName, $productDescription, $productPrice, $productInventory, $productId);
    }

    if ($stmt->execute()) {
        header("Location: editProducts.php?success=1");
    } else {
        echo "Error al actualizar el producto: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método no permitido.";
}
?>
