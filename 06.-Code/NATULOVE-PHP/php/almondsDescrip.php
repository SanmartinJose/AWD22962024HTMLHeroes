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
<?php include 'Navbar.php'; ?>


    <main class="main-content">
        <?php
        $mainImage = "../imagenes/almonds.png";
        $thumbnails = [
            ["src" => "../imagenes/almonds.png", "alt" => "miniature 1"],
            ["src" => "../imagenes/almonds2.jpg", "alt" => "miniature 2"],
            ["src" => "../imagenes/almonds3.png", "alt" => "miniature 3"],
            ["src" => "../imagenes/almonds4.jpg", "alt" => "miniature 4"],
            ["src" => "../imagenes/almonds5.jpg", "alt" => "miniature 5"]
        ];
        $price = "$4.99";
        $rating = "4.5 ★★★★";
        $stock = 30;
        $location = "Sangolqui";
        $comments = [
            ["user" => "User1", "comment" => "¡Un buen producto!"],
            ["user" => "User2", "comment" => "Estaban ricas pero no tanto"]
        ];
        ?>

        <div class="productContainer">

            <div class="productGallery">
                <img src="<?php echo $mainImage; ?>" alt="Almendras" class="mainImage">
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
                <h1>Almendras - Alimento nutritivo</h1>
                <p class="price"><?php echo $price; ?></p>
                <p class="rating"><?php echo $rating; ?></p>
                <p class="description">
                Nuestras almendras naturales son un snack saludable y lleno de energía, 
                ideales para quienes buscan una opción nutritiva y deliciosa. Ricas en 
                grasas saludables, proteínas, fibra y antioxidantes, son perfectas para 
                apoyar una dieta balanceada. Además, las almendras son conocidas por sus 
                beneficios para la salud del corazón y el control de los niveles de azúcar 
                en sangre. Sin aditivos ni conservantes, se presentan en su forma más pura 
                para que disfrutes de todo su sabor y propiedades. Son ideales para agregar 
                a batidos, ensaladas, yogur o simplemente disfrutar como un tentempié saludable.
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
