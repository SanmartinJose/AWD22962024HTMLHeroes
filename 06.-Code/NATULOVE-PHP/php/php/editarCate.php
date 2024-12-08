<?php
require "crud.php";

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

$query = $pdo->prepare("SELECT * FROM crear_categoria WHERE ID_CLIENTE = :id");
$query->bindParam(':id', $id);
$query->execute();

$categoria = $query->fetch(PDO::FETCH_ASSOC);

if ($categoria) {
    echo json_encode($categoria);
} else {
    echo json_encode(null);
}
?>