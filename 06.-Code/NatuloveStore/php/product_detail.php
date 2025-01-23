<?php
require 'db_connection.php';
require_once 'Navbar.php'; 

// Obtener el ID del producto desde la URL
$productId = isset($_GET['id']) ? $_GET['id'] : null;

if ($productId) {
    // Función para obtener el producto desde la base de datos
    function getProductDetails($connection, $productId) {
        $sql = "SELECT * FROM Products WHERE id = ?";
        $stmt =  $connection->prepare($sql);
        $stmt->bind_param("s", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Función para guardar el comentario y la puntuación
    function saveCommentary($connection, $productId, $userId, $rating, $comment) {
        $sql = "INSERT INTO comentary (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)";
        $stmt =  $connection->prepare($sql);
        $stmt->bind_param("siis", $productId, $userId, $rating, $comment);
        $stmt->execute();
    }

    // Función para obtener los comentarios ordenados por puntuación
    function getComments($connection, $productId) {
        $sql = "SELECT * FROM comentary WHERE product_id = ? ORDER BY rating DESC";
        $stmt =  $connection->prepare($sql);
        $stmt->bind_param("s", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Función para obtener el promedio de las puntuaciones
    function getAverageRating($connection, $productId) {
        $sql = "SELECT AVG(rating) AS avg_rating FROM comentary WHERE product_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return round($row['avg_rating'], 1); // Redondeamos a un decimal
    }

    // Verificar si se envió un comentario
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rating'])) {
        // Validar datos del formulario
        $rating = (int)$_POST['rating'];
        $comment = $_POST['comment'];
        $userId = 1; // Aquí debes usar el ID del usuario actual (1 es solo un ejemplo)

        if ($rating >= 1 && $rating <= 5) {
            saveCommentary(getDatabaseConnection(), $productId, $userId, $rating, $comment);
            echo "<div class='alert alert-success'>Comentario y puntuación guardados con éxito.</div>";
        } else {
            echo "<div class='alert alert-danger'>La puntuación debe estar entre 1 y 5.</div>";
        }
    }

    // Obtener producto y comentarios
    $product = getProductDetails(getDatabaseConnection(), $productId);
    $comments = getComments(getDatabaseConnection(), $productId);
    $avgRating = getAverageRating(getDatabaseConnection(), $productId);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if ($product): ?>
            <div class="row">
                <!-- Imagen del producto -->
                <div class="col-md-6">
                    <center>   
                        <img 
                            src="<?= json_decode($product['images'])[0] ?>" 
                            class="img-fluid rounded" 
                            alt="<?= $product['name'] ?>" 
                            width="300" 
                        > 
                    </center> 
                </div>
                <!-- Información del producto -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"><?= $product['name'] ?></h3>
                            <p class="card-text"><?= $product['description'] ?></p>
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item"><strong>Precio:</strong> $<?= number_format($product['price'], 2) ?></li>
                                <li class="list-group-item"><strong>Cantidad Disponible:</strong> <?= $product['inventory'] ?></li>
                                <li class="list-group-item"><strong>Peso:</strong> <?= $product['weight'] ?> <?= $product['weight_unit'] ?></li>
                                <li class="list-group-item"><strong>Reservable:</strong> <?= $product['reservable'] ? 'Sí' : 'No' ?></li>
                            </ul>
                            <a href="add_to_cart.php?id=<?= $product['id'] ?>" class="btn btn-success w-100">Agregar a Carrito</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Formulario de comentarios y calificación -->
            <div class="mt-4">
                <h4>Deja tu comentario</h4>
                <form method="POST">
                    <div class="mb-3">
                        <label for="rating" class="form-label">Puntuación (1-5 estrellas):</label>
                        <div class="stars">
                            <input type="radio" name="rating" id="star5" value="5"><label for="star5" class="fa fa-star"></label>
                            <input type="radio" name="rating" id="star4" value="4"><label for="star4" class="fa fa-star"></label>
                            <input type="radio" name="rating" id="star3" value="3"><label for="star3" class="fa fa-star"></label>
                            <input type="radio" name="rating" id="star2" value="2"><label for="star2" class="fa fa-star"></label>
                            <input type="radio" name="rating" id="star1" value="1"><label for="star1" class="fa fa-star"></label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comentario:</label>
                        <textarea id="comment" name="comment" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Comentario</button>
                </form>
            </div>

            <!-- Mostrar comentarios y puntuaciones -->
            <div class="mt-5">
                <h4>Comentarios</h4>
                <div>
                    <p><strong>Promedio de Puntuación:</strong> <?= $avgRating ?> <i class="fa fa-star" style="color: #ffbf00;"></i></p>
                    <div>
                        <?php foreach ($comments as $comment): ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><strong>Puntuación:</strong> <?= $comment['rating'] ?> <i class="fa fa-star" style="color: #ffbf00;"></i></p>
                                    <p><strong>Comentario:</strong> <?= $comment['comment'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="alert alert-danger text-center" role="alert">
                Producto no encontrado.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php include 'Footer.php'; ?>
</body>
</html>

<style>
    .stars input[type="radio"] {
        display: none;
    }

    .stars label {
        font-size: 2rem;
        color: #ccc;
        cursor: pointer;
    }

    .stars input[type="radio"]:checked ~ label {
        color: #ffbf00;
    }

    .stars input[type="radio"]:checked ~ label ~ label {
        color: #ffbf00;
    }

    .stars input[type="radio"]:not(:checked) ~ label:hover {
        color: #ffbf00;
    }
</style>

