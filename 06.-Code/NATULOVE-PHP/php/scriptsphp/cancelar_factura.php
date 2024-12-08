<?php
include_once 'config.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idFactura = $_POST['id_factura'];

    // Verificar que el ID de factura esté presente y válido
    if ($idFactura) {
        // Actualizar el estado de la factura a "Cancelada"
        $sql = "UPDATE facturas SET ESTADO_PAGO = 'Cancelada' WHERE ID_FACTURA = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $idFactura);

        if ($stmt->execute()) {
            echo "Factura cancelada exitosamente.";
        } else {
            echo "Error al cancelar la factura: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "ID de factura no válido.";
    }
} else {
    echo "Solicitud no válida.";
}

$conn->close();
?>
