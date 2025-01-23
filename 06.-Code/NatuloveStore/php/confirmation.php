<?php
session_start();
require 'db_connection.php'; // Conexión a la base de datos
$conn = getDatabaseConnection();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['user_id'])) {
    echo "Debe iniciar sesión para ver esta página.";
    exit;
}

// Verificar que se reciba el ID de la factura
if (!isset($_GET['invoice'])) {
    echo "No se proporcionó una factura.";
    exit;
}

$idAvoice = mysqli_real_escape_string($conn, $_GET['invoice']);

// Obtener los detalles de la factura
$queryInvoice = "SELECT Avoices.id_avoice, Avoices.issue_date, Avoices.total_amount, users.username 
                 FROM Avoices 
                 INNER JOIN users ON Avoices.id_client = users.id 
                 WHERE Avoices.id_avoice = '$idAvoice'";
$resultInvoice = mysqli_query($conn, $queryInvoice);
if (!$resultInvoice || mysqli_num_rows($resultInvoice) === 0) {
    echo "Factura no encontrada.";
    exit;
}

$invoiceData = mysqli_fetch_assoc($resultInvoice);
$clientName = $invoiceData['username'];
$totalAmount = $invoiceData['total_amount'];

// Obtener los detalles de los productos vendidos
$queryDetails = "SELECT Products.name AS product_name, Details_Sales.amount 
                 FROM Details_Sales 
                 INNER JOIN Products ON Details_Sales.id_product = Products.id 
                 WHERE Details_Sales.id_avoice = '$idAvoice'";
$resultDetails = mysqli_query($conn, $queryDetails);
if (!$resultDetails || mysqli_num_rows($resultDetails) === 0) {
    echo "No se encontraron detalles para esta factura.";
    exit;
}

// Crear la cadena con los productos vendidos
$productDetails = [];
while ($row = mysqli_fetch_assoc($resultDetails)) {
    $productDetails[] = "{$row['amount']}x {$row['product_name']}";
}
$productDetailsString = implode(", ", $productDetails);

// Enviar mensaje de WhatsApp
$token = "EAAYj09m3msMBO1g8JIDYQ8oyNAEvUrZCCJPZBqLQarBYFjdbyLWOdZAMTyBOVcXL5zoIFcDYCTsIjnCQl9QQABs2yUbG1HKL0oFrYLIJLssIBXOQZCz8EwfhLQwBWgSchnuG1tByIIY2jCeD3Hfk8CyZA4QQyJEknFivqlvmH2xCmi9MpJI9QEOy4De6jzHZAlZC5K6ENtpuFBCN9NXHMuZB6aF6zFEZD";
$phone = "593996459938";
$url = "https://graph.facebook.com/v21.0/530788673453884/messages";

// Crear el mensaje en formato JSON
$message = json_encode([
    "messaging_product" => "whatsapp",
    "to" => $phone,
    "type" => "template",
    "template" => [
        "name" => "purchase_notify",
        "language" => [ "code" => "en_US" ],
        "components" => [
            [
                "type" => "body",
                "parameters" => [
                    [
                        "type" => "text",
                        "text" => $clientName 
                    ],
                    [
                        "type" => "text",
                        "text" => $idAvoice 
                    ],
                    [
                        "type" => "text",
                        "text" => $productDetailsString
                    ],
                    [
                        "type" => "text",
                        "text" => "$" . number_format($totalAmount, 2) 
                    ]
                ]
            ]
        ]
    ]
]);

$header = [
    "Authorization: Bearer " . $token,
    "Content-Type: application/json"
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POSTFIELDS, $message);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

// Mostrar confirmación al usuario
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">¡Compra Exitosa!</h1>
    <p>Gracias por tu compra, <strong><?php echo htmlspecialchars($clientName); ?></strong>.</p>
    <p>Tu factura: <strong><?php echo htmlspecialchars($idAvoice); ?></strong></p>
    <p>Productos comprados: <strong><?php echo htmlspecialchars($productDetailsString); ?></strong></p>
    <p>Total: <strong>$<?php echo number_format($totalAmount, 2); ?></strong></p>

    <a href="catalog.php" class="btn btn-primary">Volver al Inicio</a>
</div>
</body>
</html>
