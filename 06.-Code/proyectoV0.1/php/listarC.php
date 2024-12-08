<?php
// Incluir el archivo de conexión
require("crud.php");

try {
    // Preparar la consulta para seleccionar todos los clientes
    $query = $pdo->prepare("SELECT ID_CLIENTE, NOMBRE_CLIENTE, CEDULA, TELEFONO, EMAIL, DIRECCION, ESTADO, FECHA_REGISTRO FROM clientes");
    $query->execute();

    // Verificar si se encontraron resultados
    if ($query->rowCount() > 0) {
        echo "<table class='table table-bordered'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nombre</th>";
        echo "<th>Cédula</th>";
        echo "<th>Teléfono</th>";
        echo "<th>Email</th>";
        echo "<th>Dirección</th>";
        echo "<th>Estado</th>";
        echo "<th>Fecha de Registro</th>";
        echo "<th>Acciones</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Recorrer los resultados y mostrarlos en la tabla
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            // Determinar el texto y la clase del botón basados en el estado actual
            $buttonText = $row['ESTADO'] === 'activo' ? 'Desactivar' : 'Activar';
            $buttonClass = $row['ESTADO'] === 'activo' ? 'btn-danger' : 'btn-success';

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['ID_CLIENTE']) . "</td>";
            echo "<td>" . htmlspecialchars($row['NOMBRE_CLIENTE']) . "</td>";
            echo "<td>" . htmlspecialchars($row['CEDULA']) . "</td>";
            echo "<td>" . htmlspecialchars($row['TELEFONO']) . "</td>";
            echo "<td>" . htmlspecialchars($row['EMAIL']) . "</td>";
            echo "<td>" . htmlspecialchars($row['DIRECCION']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ESTADO']) . "</td>";
            echo "<td>" . htmlspecialchars($row['FECHA_REGISTRO']) . "</td>";
            echo "<td>";
            echo "<button type='button' class='btn btn-success' onclick='Editar(" . $row['ID_CLIENTE'] . ")'>Editar</button> ";
            
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No se encontraron clientes registrados.</p>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

