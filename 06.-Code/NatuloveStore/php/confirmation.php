<?php
if (isset($_GET['invoice'])) {
    $invoiceId = htmlspecialchars($_GET['invoice']);
    echo "<h1>¡Gracias por tu compra!</h1>";
    echo "<p>Tu número de factura es: <strong>$invoiceId</strong>.</p>";
    echo "<a href='catalog.php' class='btn btn-primary'>Volver al catálogo</a>";
} else {
    echo "<p>Ocurrió un error al procesar tu compra.</p>";
}
?>