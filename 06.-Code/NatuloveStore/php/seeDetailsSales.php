<?php
// Ver detalles de las ventas
include('db_connection.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de las Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-light">
<?php include 'adminNavbar.php'; ?>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h2>Detalles de las Ventas</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center mt-4">
                    <table id="detailsSalesTable" class="table table-striped table-bordered table-hover mx-auto" style="width: 100%;">
                        <thead class="table-success">
                            <tr>
                                <th>ID Venta</th>
                                <th>ID Producto</th>
                                <th>ID Factura</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Consulta para obtener los detalles de ventas
                            $conn = getDatabaseConnection();
                            $sql = "SELECT * FROM Details_Sales";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['id_sale']}</td>
                                            <td>{$row['id_product']}</td>
                                            <td>{$row['id_avoice']}</td>
                                            <td>{$row['amount']}</td>
                                            <td>\${$row['unit_price']}</td>
                                            <td>\${$row['subtotal']}</td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No hay detalles de ventas registradas.</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluyendo las librerías necesarias para DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializar DataTables en la tabla
            $('#detailsSalesTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es_es.json"
                },
                "order": []  // Esto evita que la tabla tenga un orden predeterminado al cargar
            });
        });
    </script>

    <script src="../js/validation.js"></script>
</body>
</html>
