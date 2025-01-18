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
            <div class="card">
                <img src="<?= json_decode($product['images'])[0] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $product['name'] ?></h5>
                    <p class="card-text"><?= $product['description'] ?></p>
                    <p><strong>Precio:</strong> $<?= number_format($product['price'], 2) ?></p>
                    <p><strong>Cantidad Disponible:</strong> <?= $product['quantity'] ?></p>
                    <p><strong>Peso:</strong> <?= $product['weight'] ?></p>
                    <p><strong>Reservable:</strong> <?= $product['reservable'] ?></p>
                    <a href="add_to_cart.php?id=<?= $product['id'] ?>" class="btn btn-primary">Agregar a Carrito</a>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                Producto no encontrado.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
