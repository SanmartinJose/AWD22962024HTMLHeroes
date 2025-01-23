<?php
// seeInventory.php
// seeInventory.php
include('db_connection.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>
<!-- Modal para editar producto -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="productId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Categoría</label>
                        <input type="text" class="form-control" id="category">
                    </div>
                    <div class="mb-3">
                        <label for="inventory" class="form-label">Inventario</label>
                        <input type="number" class="form-control" id="inventory">
                    </div>
                    <div class="mb-3">
                        <label for="weight" class="form-label">Peso</label>
                        <input type="number" step="0.01" class="form-control" id="weight">
                    </div>
                    <div class="mb-3">
                        <label for="weight_unit" class="form-label">Unidad</label>
                        <input type="text" class="form-control" id="weight_unit">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="price">
                    </div>
                    <div class="mb-3">
                        <label for="reservable" class="form-label">Reservable</label>
                        <select class="form-control" id="reservable">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado</label>
                        <select class="form-control" id="status">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveChanges">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<body class="bg-light">
<?php include 'adminNavbar.php'; ?>
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
                                echo "<tr><td colspan='11' class='text-center'>No hay productos en el inventario.</td></tr>";
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
            $('#inventoryTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es_es.json"
                }
            });
        });
    </script>
    <script src="../js/validation.js"></script>
</body>
</html>
