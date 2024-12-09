<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descripción del Producto - Almendras</title>
    <link rel="stylesheet" href=".././css/ProductDescription.css">
</head>
<body>
<?php include 'Navbar.php'; ?>
<?php include './php/crud.php'; ?>

<main class="main-content">
    <?php
    
    $product_id = $_GET['id'] ?? 2;
    $query = "SELECT * FROM productos WHERE id_producto = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $price = $product['precio_unitario'];
        $stock = $product['stock'];
        $description = $product['descripcion'];
        $title = $product['nombre_producto'];
    } else {
        die("Producto no encontrado.");
    }
    ?>

    <div class="productContainer">

    <div class="productGallery">
    <img src=".././imagenes/almonds.jpg" alt="eternalFlower" class="mainImage">
    </div>

        <div class="productDetails">
            <h1><?php echo $title; ?></h1>
            <p class="price"><?php echo $price . '$'; ?></p>
            <p class="description"><?php echo $description; ?></p>
            <div class="availability">
                <p>Disponibles: <span class="status"><?php echo $stock; ?> stock</span></p>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
</body>
</html>