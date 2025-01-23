<?php
// seeInventory.php
include('db_connection.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>
<body class="bg-light">
<?php include 'Navbar.php'; ?>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h2>Inventario de Productos</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    <table id="inventoryTable" class="table table-bordered table-hover mx-auto">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Categoría</th>
                                <th>Inventario</th>
                                <th>Peso</th>
                                <th>Unidad</th>
                                <th>Precio</th>
                                <th>Reservable</th>
                               
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conn = getDatabaseConnection();
                            $sql = "SELECT * FROM Products";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['name']}</td>
                                            <td>{$row['description']}</td>
                                            <td>{$row['category']}</td>
                                            <td>{$row['inventory']}</td>
                                            <td>{$row['weight']}</td>
                                            <td>{$row['weight_unit']}</td>
                                            <td>{$row['price']}</td>
                                            <td>{$row['reservable']}</td>
                                            
                                            <td>{$row['status']}</td>
                                            <td>
                                                <button class='btn btn-warning btn-sm editBtn' data-id='{$row['id']}'>Editar</button>
                                                <button class='btn btn-danger btn-sm deleteBtn' data-id='{$row['id']}'>Eliminar</button>
                                            </td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='12' class='text-center'>No hay productos en el inventario.</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- Script for DataTables Initialization -->
    <script>
        $(document).ready(function() {
            $('#inventoryTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es_es.json"
                }
            });
        });
    </script>
</body>
</html>



 
