<?php
require "crud.php";

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

$query = $pdo->prepare("SELECT * FROM clientes WHERE ID_CLIENTE = :id");
$query->bindParam(':id', $id);
$query->execute();

$cliente = $query->fetch(PDO::FETCH_ASSOC);

if ($cliente) {
    echo json_encode($cliente);
} else {
    echo json_encode(null);
}
?>