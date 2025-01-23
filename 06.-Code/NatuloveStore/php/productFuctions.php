<?php


require 'db_connection.php';

// Obtener todos los productos
function getAllProducts() {
    global $conn;
    $sql = "SELECT * FROM Products";
    $result = $conn->query($sql);
    return $result;
}

// Obtener un producto por ID
function getProductById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Products WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Insertar un nuevo producto
function insertProduct($name, $description, $category, $inventory, $weight, $weight_unit, $price, $reservable, $images, $status) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO Products (name, description, category, inventory, weight, weight_unit, price, reservable, images, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssiisssss', $name, $description, $category, $inventory, $weight, $weight_unit, $price, $reservable, $images, $status);
    return $stmt->execute();
}

// Actualizar un producto
function updateProduct($id, $name, $description, $category, $inventory, $weight, $weight_unit, $price, $reservable, $images, $status) {
    global $conn;
    $stmt = $conn->prepare("UPDATE Products SET name = ?, description = ?, category = ?, inventory = ?, weight = ?, weight_unit = ?, price = ?, reservable = ?, images = ?, status = ? WHERE id = ?");
    $stmt->bind_param('sssiisssssi', $name, $description, $category, $inventory, $weight, $weight_unit, $price, $reservable, $images, $status, $id);
    return $stmt->execute();
}

// Eliminar un producto
function deleteProduct($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM Products WHERE id = ?");
    $stmt->bind_param('i', $id);
    return $stmt->execute();
}

// Buscar productos por nombre
function searchProducts($searchTerm) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Products WHERE name LIKE ?");
    $searchTerm = "%$searchTerm%";
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    return $stmt->get_result();
}
?>
