<?php
$token = "EAAYj09m3msMBO4DLzAWZCG6Lt2CBvanc4IrxIoTjonulQ3XLa8QVBnSMz7RxeJqyfgbz6UToukwVUjX7xAKtEQTNaZB7uqtZAKsIkr9NFsz7jynYoMTJlq2PJjF12tgd41hw7ZCsDRJSIcfIY6uG8DmNyJYwK0Ea6JHUBJvYuZC4mkvYNucFLqBOgRnXX2DdIK4rtBKeUsGXDXeut1qtY8AfsDdoZD";
$phone = "593996459938";
$url = "https://graph.facebook.com/v21.0/530788673453884/messages";

// Datos del cliente
$nombre_cliente = "Juan Pérez";
$total_compra = 150.75;

// Crear el mensaje en formato JSON
$message = json_encode([
    "messaging_product" => "whatsapp",
    "to" => $phone,
    "type" => "template",
    "template" => [
        "name" => "purchase_notification",
        "language" => [ "code" => "en_US" ],
        "components" => [
            [
                "type" => "body",
                "parameters" => [
                    [
                        "type" => "text",
                        "text" => $nombre_cliente
                    ],
                    [
                        "type" => "text",
                        "text" => "$" . number_format($total_compra, 2)
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

echo $response;

$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

echo $status_code;

curl_close($curl);
?>
