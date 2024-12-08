<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "crud.php";

try {
    // Prepara la consulta SQL para obtener todos los registros de la tabla inventario, ordenados por ID_INVENTARIO de manera descendente
    $consulta = $pdo->prepare("SELECT * FROM inventario ORDER BY ID_INVENTARIO DESC");
    $consulta->execute();
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultado as $data) {
        echo "<tr>
                <td>".$data['ID_INVENTARIO']."</td>
                <td>".$data['ID_USUARIO']."</td>
                <td>".$data['FECHA']."</td>
                <td>".$data['ID_PRODUCTO']."</td>
              </tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>





