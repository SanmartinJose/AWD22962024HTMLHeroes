<?php
if (isset($_POST)) {
    // Obtener los datos del formulario
    $idp = $_POST['idp']; 
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio_unitario = $_POST['precio_unitario'];
    $categoria = $_POST['categoria'];
    $stock = $_POST['stock'];
    $estado = $_POST['estado'];
    $tipo_impuesto = $_POST['tipo_impuesto'];
    $valor_impuesto = $_POST['valor_impuesto'];



    require("crud.php");

    try {
        if (!empty($idp)) {
            // Actualizar producto existente
            $query = $pdo->prepare("UPDATE productos SET nombre_producto = :nombre, descripcion = :descripcion, precio_unitario = :precio_unitario, categoria = :categoria, stock = :stock, estado = :estado, producto_iva_rise = :tipo_impuesto, valor_iva_risa = :valor_impuesto WHERE id_producto = :id");
            $query->bindParam(":id", $idp);
        } else {
            // Insertar nuevo producto
            $query = $pdo->prepare("INSERT INTO productos (nombre_producto, descripcion, precio_unitario, categoria, stock, estado, producto_iva_rise, valor_iva_risa) VALUES (:nombre, :descripcion, :precio_unitario, :categoria, :stock, :estado, :tipo_impuesto, :valor_impuesto)");
        }

        // Asociar parámetros con sus valores
        $query->bindParam(":nombre", $nombre);
        $query->bindParam(":descripcion", $descripcion);
        $query->bindParam(":precio_unitario", $precio_unitario);
        $query->bindParam(":categoria", $categoria);
        $query->bindParam(":stock", $stock);
        $query->bindParam(":estado", $estado);
        $query->bindParam(":tipo_impuesto", $tipo_impuesto);
        $query->bindParam(":valor_impuesto", $valor_impuesto);
       
        if ($query->execute()) {
            echo "Producto registrado o actualizado correctamente.<br>";

            if (empty($idp)) {
                // Obtener el ID del nuevo producto insertado
                //$id_producto = $pdo->lastInsertId();
                //echo "Nuevo producto insertado con ID: $id_producto<br>";

                // Insertar en la tabla inventario
                //$query_inventario = $pdo->prepare("INSERT INTO inventario (ID_USUARIO, FECHA, ID_PRODUCTO) VALUES (:id_usuario, NOW(), :id_producto)");
                //$query_inventario->bindParam(":id_usuario", $id_usuario);
                //$query_inventario->bindParam(":id_producto", $id_producto);

                //if ($query_inventario->execute()) {
                    //echo "Registro en inventario agregado correctamente.<br>";
                //} else {
                    //$errorInfo = $query_inventario->errorInfo();
                    //echo "Error: No se pudo registrar en el inventario. Detalles: " . $errorInfo[2] . "<br>";
                //}
            } else {
                echo "Producto existente actualizado.<br>";
            }
        } else {
            $errorInfo = $query->errorInfo();
            echo "Error: No se pudo realizar la operación en la base de datos. Detalles: " . $errorInfo[2] . "<br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage() ;  // Mostrar el mensaje de error específico
    }
}else{
    echo "No se han recibido datos.";
}
?>
