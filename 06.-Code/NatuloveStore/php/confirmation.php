<?php
session_start();
require 'db_connection.php';
$conn = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    echo "Debe iniciar sesión para ver esta página.";
    exit;
}

if (!isset($_GET['invoice'])) {
    echo "No se proporcionó una factura.";
    exit;
}

$user_id = $_SESSION['user_id'];
$idAvoice = mysqli_real_escape_string($conn, $_GET['invoice']);

$queryInvoice = "SELECT Avoices.id_avoice, Avoices.issue_date, Avoices.total_amount, users.username, Avoices.id_client, Avoices.notification_sent 
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

if ($user_id != $invoiceData['id_client']) {
    echo "No tienes permisos para ver esta factura.";
    exit;
}

$queryDetails = "SELECT Products.name AS product_name, Details_Sales.amount 
                    FROM Details_Sales 
                    INNER JOIN Products ON Details_Sales.id_product = Products.id 
                    WHERE Details_Sales.id_avoice = '$idAvoice'";
    $resultDetails = mysqli_query($conn, $queryDetails);
    if (!$resultDetails || mysqli_num_rows($resultDetails) === 0) {
        echo "No se encontraron detalles para esta factura.";
        exit;
    }

    $productDetails = [];
    while ($row = mysqli_fetch_assoc($resultDetails)) {
        $productDetails[] = "{$row['amount']}x {$row['product_name']}";
    }
    $productDetailsString = implode(", ", $productDetails);

if (!$invoiceData['notification_sent']) {

    $token = "EAAYj09m3msMBOyFgKqTnXSscBKSgmoO50jgmZB9vtIq8bPuZAvbdTGFNZAFSVM4P7ZBan9psMbZADbnBD0oSmY01qgILDIqnByp3xSCye8hiyc0JoSZCOCRI17aMx1jhF8PzgxTgBZCwMqNIz5WbGbpmi8ZAFU3aXjKN2M7xYa7oAct1005k0KdN51S9ZBjm7sEKQppP1XmwON0TbYt4ZCaLZAcqByStjYZD";
    $phone = "593996459938";
    $url = "https://graph.facebook.com/v21.0/530788673453884/messages";

    $clientName = str_replace(["\n", "\t", "    "], ' ', $clientName);
    $idAvoice = str_replace(["\n", "\t", "    "], ' ', $idAvoice);
    $productDetailsString = str_replace(["\n", "\t", "    "], ' ', $productDetailsString);

    $message = json_encode([
        "messaging_product" => "whatsapp",
        "to" => $phone,
        "type" => "template",
        "template" => [
            "name" => "purchase_notify",
            "language" => ["code" => "en_US"],
            "components" => [
                [
                    "type" => "body",
                    "parameters" => [
                        ["type" => "text", "text" => $clientName],
                        ["type" => "text", "text" => $idAvoice],
                        ["type" => "text", "text" => $productDetailsString],
                        ["type" => "text", "text" => "$" . number_format($totalAmount, 2)]
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

    if ($status_code == 200) {
        // Actualizar el estado de la notificación en la base de datos
        $queryUpdateNotification = "UPDATE Avoices SET notification_sent = TRUE WHERE id_avoice = '$idAvoice'";
        mysqli_query($conn, $queryUpdateNotification);
    }

}
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
