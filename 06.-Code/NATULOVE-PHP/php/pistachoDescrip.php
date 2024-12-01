<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descripción del Producto - Flor Eterna</title>
    <link rel="stylesheet" href="../../NATULOVE-PHP/css/ProductDescription.css">
    <link rel="stylesheet" href="../../NATULOVE-PHP/css/Footer.css">
</head>
<body>
    <!-- Contenido Principal -->
    <main class="main-content">
        <?php
        $mainImage = "../imagenes/granola2.jpg";
        $thumbnails = [
            ["src" => "../imagenes/granola2.jpg", "alt" => "miniature 1"],
            ["src" => "../imagenes/pistacho.png", "alt" => "miniature 2"],
            ["src" => "../imagenes/pistacho2.jpg", "alt" => "miniature 3"],
            ["src" => "../imagenes/pistacho3.jpg", "alt" => "miniature 4"],
            ["src" => "../imagenes/pistacho4.jpg", "alt" => "miniature 5"]
        ];
        $price = "$5.50";
        $rating = "4.7 ★★★★★";
        $stock = 12;
        $location = "Sangolqui";
        $comments = [
            ["user" => "User1", "comment" => "¡Este es un producto es my bueno!"],
            ["user" => "User2", "comment" => "Compre 2 son tan ricos"]
        ];
        ?>

        <div class="productContainer">
            <!-- Galería de imágenes -->
            <div class="productGallery">
                <img src="<?php echo $mainImage; ?>" alt="Pistacho" class="mainImage">
                <div class="thumbnailGallery">
                    <?php foreach ($thumbnails as $thumbnail): ?>
                        <img 
                            src="<?php echo $thumbnail['src']; ?>" 
                            alt="<?php echo $thumbnail['alt']; ?>" 
                            class="thumbnail"
                            onclick="document.querySelector('.mainImage').src = '<?php echo $thumbnail['src']; ?>';"
                        >
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Detalles del producto -->
            <div class="productDetails">
                <h1>Pistachos - Alimento sano</h1>
                <p class="price"><?php echo $price; ?></p>
                <p class="rating"><?php echo $rating; ?></p>
                <p class="description">
                Nuestros pistachos naturales son una opción deliciosa y nutritiva, ricos en grasas 
                saludables, proteínas y fibra. Este fruto seco, cuidadosamente seleccionado y sin 
                aditivos ni conservantes, es perfecto para quienes buscan un snack energético y lleno 
                de beneficios para la salud. Los pistachos son una excelente fuente de antioxidantes 
                y nutrientes esenciales, ayudando a mejorar la salud del corazón y la función cerebral.
                 Además, su sabor suave y ligeramente tostado los convierte en una excelente opción 
                 para acompañar ensaladas, yogur o disfrutar directamente del paquete. Sin lugar a 
                 dudas, una elección natural y deliciosa para mantenerte energizado a lo largo del día.
                </p>
                <div class="availability">
                    <p>Disponibles: <span class="status"><?php echo $stock; ?> stock</span></p>
                </div>
                <div class="deliveryOptions">
                    <p>Entregar a <strong><?php echo $location; ?></strong></p>
                    <p>Lugar permitido para la entrga...</p>
                </div>
                <button class="addToCart">Agregar al Carrito</button>
            </div>

            <!-- Sección de comentarios -->
            <section class="commentsSection">
                <h3>Reseñas de Clientes</h3>
                <div class="comments">
                    <?php foreach ($comments as $comment): ?>
                        <p><strong><?php echo $comment['user']; ?>:</strong> <?php echo $comment['comment']; ?></p>
                    <?php endforeach; ?>
                </div>
                <textarea placeholder="Agrega tu comentario aquí..."></textarea>
                <button class="addComment">Agregar Comentario</button>
            </section>
        </div>
    </main>

<!-- Incluir el Footer -->
<?php include 'footer.php'; ?>

</body>
</html>
