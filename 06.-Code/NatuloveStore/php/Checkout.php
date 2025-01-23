<?php
session_start();
require 'db_connection.php'; 
$conn = getDatabaseConnection();


if (!isset($_SESSION['user_id'])) {
    echo "Debe iniciar sesión para proceder con la compra.";
    exit;
}


$clientId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "El carrito está vacío.";
        exit;
    }


    $result = mysqli_query($conn, "SELECT MAX(id_avoice) AS max_id FROM Avoices");
    $row = mysqli_fetch_assoc($result);
    $lastId = $row['max_id'];
    $newAvoiceId = $lastId ? sprintf("P%04d", substr($lastId, 1) + 1) : "P0001";

    $result = mysqli_query($conn, "SELECT MAX(id_sale) AS max_id FROM Details_Sales");
    $row = mysqli_fetch_assoc($result);
    $lastSaleId = $row['max_id'];
    $newSaleId = $lastSaleId ? sprintf("P%04d", substr($lastSaleId, 1) + 1) : "P0001";


    $issueDate = date('Y-m-d');


    $totalAmount = 0;


    $details = [];
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $productId = mysqli_real_escape_string($conn, $productId);
        $quantity = (int)$quantity;


        $result = mysqli_query($conn, "SELECT price FROM Products WHERE id = '$productId'");
        $product = mysqli_fetch_assoc($result);
        $unitPrice = $product['price'];
        $subtotal = $unitPrice * $quantity;

        $totalAmount += $subtotal;


        $details[] = [
            'id_sale' => $newSaleId,
            'id_product' => $productId,
            'id_avoice' => $newAvoiceId,
            'amount' => $quantity,
            'unit_price' => $unitPrice,
            'subtotal' => $subtotal,
        ];
    }


    $query = "INSERT INTO Avoices (id_avoice, id_client, id_sale, issue_date, total_amount, payment_status) 
              VALUES ('$newAvoiceId', '$clientId', '$newSaleId', '$issueDate', '$totalAmount', 'Pendiente')";
    if (!mysqli_query($conn, $query)) {
        die("Error al insertar en Avoices: " . mysqli_error($conn));
    }


    foreach ($details as $detail) {
        $query = "INSERT INTO Details_Sales (id_sale, id_product, id_avoice, amount, unit_price, subtotal) 
                  VALUES ('{$detail['id_sale']}', '{$detail['id_product']}', '{$detail['id_avoice']}', '{$detail['amount']}', '{$detail['unit_price']}', '{$detail['subtotal']}')";
        if (!mysqli_query($conn, $query)) {
            die("Error al insertar en Details_Sales: " . mysqli_error($conn));
        }
    }


    unset($_SESSION['cart']);


    header("Location: confirmation.php?invoice=$newAvoiceId");
    exit;
}
?>
