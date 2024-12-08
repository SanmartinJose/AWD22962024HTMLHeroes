<?php
// Incluir el archivo de conexión
require("crud.php");

try {
    // Preparar la consulta para seleccionar todos los clientes
    $query = $pdo->prepare("SELECT id_categoria, id_usuario, fecha,nombre_categoria, descripcion FROM crear_categoria");
    $query->execute();

    // Verificar si se encontraron resultados
    if ($query->rowCount() > 0) {
        echo "<table class='table table-bordered'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Id usuario</th>";
        echo "<th>Fecha</th>";
        echo "<th>Nombre Categoria</th>";
        echo "<th>Descripcion</th>";
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
            echo "<td>" . htmlspecialchars($row['id_categoria']) . "</td>";
            echo "<td>" . htmlspecialchars($row['id_usuario']) . "</td>";
            echo "<td>" . htmlspecialchars($row['fecha,']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nombre_categoria']) . "</td>";
            echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
           
            echo "<td>";
            echo "<button type='button' class='btn btn-success' onclick='EditarCate(" . $row['id_categoria'] . ")'>Editar</button> ";
            
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