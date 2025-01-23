<?php
include('db_connection.php');

if (isset($_POST['id'])) {
    $productId = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $inventory = $_POST['inventory'];
    $weight = $_POST['weight'];
    $weightUnit = $_POST['weight_unit'];
    $price = $_POST['price'];
    $reservable = $_POST['reservable'];
    $status = $_POST['status'];

    $conn = getDatabaseConnection();

    // Preparar la consulta de actualización
    $stmt = $conn->prepare("UPDATE Products SET name = ?, description = ?, category = ?, inventory = ?, weight = ?, weight_unit = ?, price = ?, reservable = ?, status = ? WHERE id = ?");
    
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param(
        "sssidsdsss",
        $name,
        $description,
        $category,
        $inventory,
        $weight,
        $weightUnit,
        $price,
        $reservable,
        $status,
        $productId
    );

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
