<?php
// Ver los comentarios
include('db_connection.php');

// Establecer conexión a la base de datos
$conn = getDatabaseConnection();  // Aquí se establece la conexión con la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-light">
<?php include 'adminNavbar.php'; ?>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h2>Comentarios de los Productos</h2>
            </div>
            <div class="card-body">
                <!-- Tabla de comentarios -->
                <div class="table-responsive text-center mt-4">
                   <div class="card-body">
                        <form method="get" action="export.php">
                           
                        </form>
                        <!-- Tabla de comentarios -->
                        <div class="table-responsive text-center mt-4">
                            <table id="commentsTable" class="table table-striped table-bordered table-hover mx-auto" style="width: 100%;">
                                <thead class="table-success">
                                    <tr>
                                        <th>ID Comentario</th>
                                        <th>ID Producto</th>
                                        <th>ID Usuario</th>
                                        <th>Calificación</th>
                                        <th>Comentario</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Consulta para obtener todos los comentarios
                                    $conn = getDatabaseConnection();
                                    $sql = "SELECT * FROM comentary";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['id']}</td>
                                                    <td>{$row['product_id']}</td>
                                                    <td>{$row['user_id']}</td>
                                                    <td>{$row['rating']}</td>
                                                    <td>{$row['comment']}</td>
                                                    <td>{$row['created_at']}</td>
                                                    <td>
                                                        <button class='btn btn-danger deleteBtn' data-id='{$row['id']}'>Eliminar</button>
                                                    </td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center'>No hay comentarios registrados.</td></tr>";
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
        $('#commentsTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es_es.json"
            },
            "order": []  // Esto evita que la tabla tenga un orden predeterminado al cargar
        });

        // Eliminar comentario
        $(document).on('click', '.deleteBtn', function() {
            var commentId = $(this).data('id');
            if (confirm('¿Estás seguro de eliminar este comentario?')) {
                $.ajax({
                    url: 'deleteCommentary.php',  // Archivo PHP para eliminar comentario
                    type: 'POST',
                    data: { id: commentId },
                    success: function(response) {
                        if (response.trim() === 'success') {
                            alert('Comentario eliminado con éxito.');
                            location.reload();  // Recargar la página después de eliminar el comentario
                        } else {
                            alert('Error al eliminar el comentario.');
                        }
                    }
                });
            }
        });
    });
</script>

<script src="../js/validation.js"></script>
</body>
</html>


