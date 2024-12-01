<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descripción del Producto - Flor Eterna</title>
    <link rel="stylesheet" href="css/ProductDescription.css">
    <link rel="stylesheet" href="../NATULOVE/css/Footer.css">
</head>
<body>
    <!-- Contenido Principal -->
    <main class="main-content">
        <?php
        $mainImage = "imagenes/flower1.jpeg";
        $thumbnails = [
            ["src" => "imagenes/flower1.jpeg", "alt" => "miniature 1"],
            ["src" => "imagenes/flower2.jpeg", "alt" => "miniature 2"],
            ["src" => "imagenes/flower4.jpeg", "alt" => "miniature 3"],
            ["src" => "imagenes/flower5.jpeg", "alt" => "miniature 4"],
            ["src" => "imagenes/flower6.jpg", "alt" => "miniature 5"]
        ];
        $price = "$9.99";
        $rating = "4.8 ★★★★★";
        $stock = 15;
        $location = "Conocoto";
        $comments = [
            ["user" => "User1", "comment" => "¡Este es un producto increíble!"],
            ["user" => "User2", "comment" => "Lo recomiendo altamente."]
        ];
        ?>

        <div class="productContainer">
            <!-- Galería de imágenes -->
            <div class="productGallery">
                <img src="<?php echo $mainImage; ?>" alt="Eternal flower gift" class="mainImage">
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
                <h1>Regalo natural flor eterna - Amor eterno</h1>
                <p class="price"><?php echo $price; ?></p>
                <p class="rating"><?php echo $rating; ?></p>
                <p class="description">
                    La flor eterna es una pieza única y encantadora que captura la belleza natural 
                    de las flores en su forma más duradera. Con un proceso especial de preservación, 
                    esta flor mantiene su frescura y color durante años, sin necesidad de agua ni 
                    cuidados especiales. Ideal para decorar tu hogar o regalar a alguien especial, 
                    la flor eterna simboliza la belleza perdurable y la eternidad de los momentos 
                    más preciados. Perfecta para quienes buscan un toque natural y elegante que 
                    perdure en el tiempo.
                </p>
                <div class="availability">
                    <p>Disponibles: <span class="status"><?php echo $stock; ?> stock</span></p>
                </div>
                <div class="deliveryOptions">
                    <p>Entregar a <strong><?php echo $location; ?></strong></p>
                    <p>No se puede entregar a la ubicación seleccionada...</p>
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
<?php include 'php/footer.php'; ?>

</body>
</html>
