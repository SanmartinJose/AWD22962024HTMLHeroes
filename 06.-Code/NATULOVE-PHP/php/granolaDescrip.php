<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descripción del Producto - Flor Eterna</title>
    <link rel="stylesheet" href="../../NATULOVE-PHP/css/ProductDescription.css">
</head>
<body>
<?php include 'Navbar.php'; ?>

    <main class="main-content">
        <?php
        $mainImage = "../imagenes/granola1.jpg";
        $thumbnails = [
            ["src" => "../imagenes/granola1.jpg", "alt" => "miniature 1"],
            ["src" => "../imagenes/granola2.jpg", "alt" => "miniature 2"],
            ["src" => "../imagenes/granola3.jpg", "alt" => "miniature 3"],
            ["src" => "../imagenes/granola4.jpg", "alt" => "miniature 4"],
            ["src" => "../imagenes/granola5.webp", "alt" => "miniature 5"]
        ];
        $price = "$5.99";
        $rating = "4.6 ★★★★";
        $stock = 20;
        $location = "Sangolqui";
        $comments = [
            ["user" => "User1", "comment" => "¡Este es un producto increíble!"],
            ["user" => "User2", "comment" => "Lo recomiendo altamente."]
        ];
        ?>

        <div class="productContainer">

            <div class="productGallery">
                <img src="<?php echo $mainImage; ?>" alt="Granola" class="mainImage">
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


            <div class="productDetails">
                <h1>Granola organica - Alimento sano</h1>
                <p class="price"><?php echo $price; ?></p>
                <p class="rating"><?php echo $rating; ?></p>
                <p class="description">
                Nuestra granola natural es una mezcla deliciosa y saludable de avena integral, nueces, 
        semillas y un toque de miel, todo cuidadosamente horneado para resaltar su sabor y mantener 
        sus beneficios nutricionales. Sin azúcares añadidos ni conservantes, es la opción perfecta 
        para quienes buscan un snack energético o una adición saludable a sus desayunos. Rica en fibra, 
        proteínas y antioxidantes, nuestra granola te brinda la energía que necesitas para empezar el día 
        de forma natural y deliciosa. Ideal para combinar con yogur, frutas frescas o disfrutarla 
        directamente del paquete.
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


<?php include 'footer.php'; ?>

</body>
</html>
