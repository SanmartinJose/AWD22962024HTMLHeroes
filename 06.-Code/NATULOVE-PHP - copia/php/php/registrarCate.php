<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Incluir el archivo de conexión
    require("crud.php");

    // Obtener los datos del formulario
    $id_cate = $_POST['id_cate'] ?? ''; 
    $nombre_cate = $_POST['nombre_cate'] ?? '';
    $descripcion_cate = $_POST['descripcion_cate'] ?? '';

    try {
        if (!empty($id_cate)) {
            // Actualizar categoría existente
            $query = $pdo->prepare("UPDATE crear_categoria SET nombre_categoria = :nombre_cate, descripcion = :descripcion_cate WHERE id_categoria = :id_cate");
            $query->bindParam(":id_cate", $id_cate);
        } else {
            // Insertar nueva categoría
            $query = $pdo->prepare("INSERT INTO crear_categoria (nombre_categoria, descripcion) VALUES (:nombre_cate, :descripcion_cate)");
        }

        // Asociar parámetros con sus valores
        $query->bindParam(":nombre_cate", $nombre_cate);
        $query->bindParam(":descripcion_cate", $descripcion_cate);

        if ($query->execute()) {
            echo "ok";  // Respuesta esperada en caso de éxito
        } else {
            $errorInfo = $query->errorInfo();
            echo "Error en la operación: " . $errorInfo[2];  // Mostrar detalles del error
        }
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();  // Mostrar el mensaje de error específico
    } catch (Exception $e) {
        echo "Error general: " . $e->getMessage();  // Manejar cualquier otro tipo de error
    }
}
?>

