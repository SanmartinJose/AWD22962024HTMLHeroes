<?php
if (isset($_POST)) {
    // Obtener los datos del formulario
    $idp = $_POST['idp']; 
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $estado = $_POST['estado'];

    // Incluir el archivo de conexión
    require("crud.php");

    try {
        if (!empty($idp)) {
            // Actualizar cliente existente
            $query = $pdo->prepare("UPDATE clientes SET NOMBRE_CLIENTE = :nombre, CEDULA = :cedula, TELEFONO = :telefono, EMAIL = :email, DIRECCION = :direccion, ESTADO = :estado WHERE ID_CLIENTE = :id");
            $query->bindParam(":id", $idp);
        } else {
            // Insertar nuevo cliente
            $query = $pdo->prepare("INSERT INTO clientes (NOMBRE_CLIENTE, CEDULA, TELEFONO, EMAIL, DIRECCION, ESTADO) VALUES (:nombre, :cedula, :telefono, :email, :direccion, :estado)");
        }

        // Asociar parámetros con sus valores
        $query->bindParam(":nombre", $nombre);
        $query->bindParam(":cedula", $cedula);
        $query->bindParam(":telefono", $telefono);
        $query->bindParam(":email", $email);
        $query->bindParam(":direccion", $direccion);
        $query->bindParam(":estado", $estado);
       

        if ($query->execute()) {
            echo "Cliente registrado o actualizado correctamente.<br>";

            if (empty($idp)) {
                // Obtener el ID del nuevo cliente insertado
                $id_cliente = $pdo->lastInsertId();
                echo "Nuevo cliente insertado con ID: $id_cliente<br>";
            } else {
                echo "Cliente existente actualizado.<br>";
            }
        } else {
            $errorInfo = $query->errorInfo();
            echo "Error: No se pudo realizar la operación en la base de datos. Detalles: " . $errorInfo[2] . "<br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage() . "<br>";  // Mostrar el mensaje de error específico
    }
}
?>













