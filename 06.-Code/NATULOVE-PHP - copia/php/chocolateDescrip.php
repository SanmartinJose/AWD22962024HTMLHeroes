<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descripción del Producto - Flor Eterna</title>
    <link rel="stylesheet" href=".././css/ProductDescription.css">
</head>
<body>
<?php include 'Navbar.php'; ?>

    <main class="main-content">
        <?php
        $mainImage = "../imagenes/chocolateBag.jpg";
        $thumbnails = [
            ["src" => "../imagenes/chocolateBag.jpg", "alt" => "miniature 1"],
            ["src" => "../imagenes/chocolates2.png", "alt" => "miniature 2"],
            ["src" => "../imagenes/chocolates3.jpg", "alt" => "miniature 3"],
            ["src" => "../imagenes/chocolates4.jpg", "alt" => "miniature 4"],
            ["src" => "../imagenes/chocolates5.jpg", "alt" => "miniature 5"]
        ];
        $price = "$6.50";
        $rating = "5.0 ★★★★★";
        $stock = 15;
        $location = "Sangolqui";
        $comments = [
            ["user" => "User1", "comment" => "¡Son tan ricos, me compraria miles!"],
            ["user" => "User2", "comment" => "A mi novia le encantaron."]
        ];
        ?>

        <div class="productContainer">

            <div class="productGallery">
                <img src="<?php echo $mainImage; ?>" alt="Chocolate" class="mainImage">
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
                <h1> Mix Chocolate - Gran sabor</h1>
                <p class="price"><?php echo $price; ?></p>
                <p class="rating"><?php echo $rating; ?></p>
                <p class="description">
                Nuestro chocolate natural es una delicia indulgente y saludable, elaborado con cacao de 
                alta calidad para ofrecer un sabor intenso y sofisticado. Rico en antioxidantes, hierro 
                y magnesio, es una excelente opción para quienes buscan un dulce que también aporte 
                beneficios para la salud, como mejorar el estado de ánimo y la salud cardiovascular. 
                Sin azúcares añadidos ni conservantes, nuestro chocolate preserva la esencia pura del 
                cacao, brindando una experiencia de sabor única y natural. Perfecto para disfrutar solo, 
                en postres o como un toque especial en batidos y recetas de repostería.
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
