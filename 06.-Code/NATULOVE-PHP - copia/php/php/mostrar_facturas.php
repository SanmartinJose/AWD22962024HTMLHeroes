<?php
include_once './includes/header.php';
include_once '../scriptsphp/config.php'; // Conexión a la base de datos

$seccion_actual = 'reportes'; 
$accesos_usuario = explode(',', $_SESSION['accesos_usuario']);
if (!in_array($seccion_actual, $accesos_usuario)) {
    header('Location: ./indexAdmin.php');
}

$idFactura = $_GET['id'];

// Consulta para obtener los detalles de la factura
$sql = "SELECT * FROM facturas WHERE ID_FACTURA = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $idFactura);
$stmt->execute();
$resultFactura = $stmt->get_result()->fetch_assoc();

// Consulta para obtener los detalles de venta
$sqlDetalles = "SELECT * FROM detalles_venta WHERE ID_FACTURA = ?";
$stmtDetalles = $conn->prepare($sqlDetalles);
$stmtDetalles->bind_param('i', $idFactura);
$stmtDetalles->execute();
$resultDetalles = $stmtDetalles->get_result();
?>

<div class="container">
    <h1>Detalles de la Factura</h1>
    <h2>Factura #<?php echo htmlspecialchars($resultFactura['NUMERO_FACTURA']); ?></h2>
    <p><strong>ID Cliente:</strong> <?php echo htmlspecialchars($resultFactura['ID_CLIENTE']); ?></p>
    <p><strong>Fecha de Emisión:</strong> <?php echo htmlspecialchars($resultFactura['FECHA_EMISION']); ?></p>
    <p><strong>Monto Total:</strong> <?php echo htmlspecialchars($resultFactura['MONTO_TOTAL']); ?></p>
    <p><strong>Estado de Pago:</strong> <?php echo htmlspecialchars($resultFactura['ESTADO_PAGO']); ?></p>

    <h3>Detalles de Venta</h3>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Código Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultDetalles->num_rows > 0): ?>
                <?php while($row = $resultDetalles->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['ID_PRODUCTO']); ?></td>
                        <td><?php echo htmlspecialchars($row['CODIGO_PRODUCTO']); ?></td>
                        <td><?php echo htmlspecialchars($row['CANTIDAD']); ?></td>
                        <td><?php echo htmlspecialchars($row['PRECIO_UNITARIO']); ?></td>
                        <td><?php echo htmlspecialchars($row['subtotal']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No se encontraron detalles de venta.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include_once './includes/footer.php'; ?>
