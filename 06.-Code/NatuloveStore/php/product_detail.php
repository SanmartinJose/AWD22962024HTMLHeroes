<?php
require 'db_connection.php';

// Obtener el ID del producto desde la URL
$productId = isset($_GET['id']) ? $_GET['id'] : null;

if ($productId) {
    // Función para obtener el producto desde la base de datos
    function getProductDetails($conn, $productId) {
        $sql = "SELECT * FROM Products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    $product = getProductDetails(getDatabaseConnection(), $productId);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if ($product): ?>
            <div class="row">
                <!-- Imagen del producto -->
                <div class="col-md-6">
                <center>   <img 
                        src="<?= json_decode($product['images'])[0] ?>" 
                        class="img-fluid rounded" 
                        alt="<?= $product['name'] ?>" 
                        width="300" 
                        > </center> 
                </div>
                <!-- Información del producto -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"><?= $product['name'] ?></h3>
                            <p class="card-text"><?= $product['description'] ?></p>
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item"><strong>Precio:</strong> $<?= number_format($product['price'], 2) ?></li>
                                <li class="list-group-item"><strong>Cantidad Disponible:</strong> <?= $product['quantity'] ?></li>
                                <li class="list-group-item"><strong>Peso:</strong> <?= $product['weight'] ?> kg</li>
                                <li class="list-group-item"><strong>Reservable:</strong> <?= $product['reservable'] ? 'Sí' : 'No' ?></li>
                            </ul>
                            <a href="add_to_cart.php?id=<?= $product['id'] ?>" class="btn btn-success w-100">Agregar a Carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger text-center" role="alert">
                Producto no encontrado.
            </div>
        <?php endif; ?>
    </div>
</body>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
