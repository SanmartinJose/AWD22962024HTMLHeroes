<?php
// seeUsers.php
include('db_connection.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>

<body class="bg-light">
<?php include 'adminNavbar.php'; ?>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h2>Listado de Clientes</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    <table id="usersTable" class="table table-bordered table-hover mx-auto">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Correo Electrónico</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Fecha de Creación</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conn = getDatabaseConnection();
                            $sql = "SELECT * FROM users";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['first_name']}</td>
                                            <td>{$row['last_name']}</td>
                                            <td>{$row['birth_date']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['username']}</td>
                                            <td>{$row['role']}</td>
                                            <td>{$row['created_at']}</td>
                                           
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9' class='text-center'>No hay usuarios registrados.</td></tr>";
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
            $('#usersTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es_es.json"
                }
            });
        });
    </script>
    <script src="../js/validation.js"></script>
</body>
</html>
