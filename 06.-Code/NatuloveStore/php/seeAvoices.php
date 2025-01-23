<?php
// Ver las ventas de los últimos 5 días
include('db_connection.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas de los Últimos 5 Días</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-light">
<?php include 'adminNavbar.php'; ?>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h2>Ventas de los Últimos 5 Días</h2>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6 offset-md-3">
                        <div class="d-flex justify-content-between align-items-center">
                        <div id="totalSales" class="total-sales">    
                        <h4>Total de Ventas de los Últimos 5 Días: 
                                <?php 
                                    // Realizamos la consulta para calcular el total de ventas de los últimos 5 días
                                    $conn = getDatabaseConnection();
                                    $sql = "SELECT SUM(total_amount) AS total_sales FROM Avoices WHERE issue_date >= CURDATE() - INTERVAL 5 DAY";
                                    $result = $conn->query($sql);
                                    $totalSales = 0;
                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $totalSales = $row['total_sales'];
                                    }
                                    $conn->close();
                                    echo '$' . number_format($totalSales, 2);
                                ?>
                            </h4>
                            </div>
                             <!-- Gráfico -->
        <div id="chartContainer" style="width: 50%; height: 180px;">
            <canvas id="salesChart"></canvas>
        </div>
                        </div>
                    </div>
                </div>

                <!-- Gráfico de ventas por día -->
               



















                <script>
                    <?php
                    // Consulta para obtener las ventas de los últimos 5 días
                    $conn = getDatabaseConnection();
                    $sql = "SELECT DATE(issue_date) AS sale_date, SUM(total_amount) AS daily_sales FROM Avoices WHERE issue_date >= CURDATE() - INTERVAL 5 DAY GROUP BY sale_date ORDER BY sale_date";
                    $result = $conn->query($sql);

                    // Arreglos para las fechas y los totales de ventas
                    $dates = [];
                    $sales = [];

                    while ($row = $result->fetch_assoc()) {
                        $dates[] = $row['sale_date'];
                        $sales[] = $row['daily_sales'];
                    }

                    // Convertir las fechas y ventas a formato JavaScript
                    echo "var salesData = " . json_encode($sales) . ";";
                    echo "var labels = " . json_encode($dates) . ";";
                    $conn->close();
                    ?>

                    // Crear el gráfico
                    var ctx = document.getElementById('salesChart').getContext('2d');
                    var salesChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Ventas de los Últimos 5 Días',
                                data: salesData,
                                backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#FFB833'],
                                borderColor: '#fff',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': $' + tooltipItem.raw.toFixed(2);
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
    <div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h2>Ventas de los Últimos 5 Días</h2>
        </div>
        <div class="card-body">
            <!-- Aquí va tu contenido y gráfico -->
            
            <div class="table-responsive text-center mt-4">
                <table id="avoicesTable" class="table table-striped table-bordered table-hover mx-auto" style="width: 100%;">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Factura</th>
                            <th>ID Cliente</th>
                            <th>ID Venta</th>
                            <th>Fecha de Emisión</th>
                            <th>Total</th>
                            <th>Estado de Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Consulta para obtener todas las facturas
                        $conn = getDatabaseConnection();
                        $sql = "SELECT * FROM Avoices";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['id_avoice']}</td>
                                        <td>{$row['id_client']}</td>
                                        <td>{$row['id_sale']}</td>
                                        <td>{$row['issue_date']}</td>
                                        <td>\${$row['total_amount']}</td>
                                        <td>{$row['payment_status']}</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No hay facturas registradas.</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#avoicesTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es_es.json"
                }
            });
        });
    </script>
    <script src="../js/validation.js"></script>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</html> 



