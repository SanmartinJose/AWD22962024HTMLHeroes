<?php
include_once './includes/header.php';
include_once '../scriptsphp/config.php'; // Conexión a la base de datos

$seccion_actual = 'reportes'; 
$accesos_usuario = explode(',', $_SESSION['accesos_usuario']);
if (!in_array($seccion_actual, $accesos_usuario)) {
    header('Location: ./indexAdmin.php');
}

// Consulta para obtener todas las facturas
$sql = "SELECT * FROM facturas";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="./css/style.css">

<div class="container">
    <h1>Facturas</h1>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID Factura</th>
                <th>ID Cliente</th>
                <th>Número de Factura</th>
                <th>Fecha de Emisión</th>
                <th>Monto Total</th>
                <th>Estado de Pago</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr class="<?php echo $row['ESTADO_PAGO'] == 'Cancelada' ? 'table-secondary' : ''; ?>">
                        <td><?php echo htmlspecialchars($row['ID_FACTURA']); ?></td>
                        <td><?php echo htmlspecialchars($row['ID_CLIENTE']); ?></td>
                        <td><?php echo htmlspecialchars($row['NUMERO_FACTURA']); ?></td>
                        <td><?php echo htmlspecialchars($row['FECHA_EMISION']); ?></td>
                        <td><?php echo htmlspecialchars($row['MONTO_TOTAL']); ?></td>
                        <td><?php echo htmlspecialchars($row['ESTADO_PAGO']); ?></td>
                        <td>
                            <!-- Botón para ver la factura -->
                            <a href="mostrar_facturas.php?id=<?php echo $row['ID_FACTURA']; ?>" class="btn btn-info btn-sm">Ver</a>
                            
                            <!-- Botón para cancelar la factura, deshabilitado si ya está cancelada -->
                            <?php if ($row['ESTADO_PAGO'] != 'Cancelada'): ?>
                                <button class="btn btn-danger btn-sm cancelar-factura" data-id="<?php echo $row['ID_FACTURA']; ?>">Cancelar</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No se encontraron facturas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include_once './includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Cancelar factura
    $('.cancelar-factura').on('click', function() {
        var idFactura = $(this).data('id');
        if (confirm('¿Estás seguro de que quieres cancelar esta factura?')) {
            $.ajax({
                url: '../scriptsphp/cancelar_factura.php',
                method: 'POST',
                data: { id_factura: idFactura },
                success: function(response) {
                    alert(response);
                    location.reload(); // Recargar la página para reflejar los cambios
                },
                error: function(xhr, status, error) {
                    console.error('Error al cancelar la factura:', error);
                }
            });
        }
    });
});
</script>
