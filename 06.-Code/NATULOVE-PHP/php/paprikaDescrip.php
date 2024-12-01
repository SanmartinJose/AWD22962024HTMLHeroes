
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
    <!-- Contenido Principal -->
    <main class="main-content">
        <?php
        $mainImage = "../imagenes/paprika5.jpg";
        $thumbnails = [
            ["src" => "../imagenes/paprika5.jpg", "alt" => "miniature 1"],
            ["src" => "../imagenes/paprika.png", "alt" => "miniature 2"],
            ["src" => "../imagenes/paprika3.jpeg", "alt" => "miniature 3"],
            ["src" => "../imagenes/paprika2.jpg", "alt" => "miniature 4"],
            ["src" => "../imagenes/paprika4.jpg", "alt" => "miniature 5"]
        ];
        $price = "$2.50";
        $rating = "4.2 ★★★★★";
        $stock = 15;
        $location = "Sangolqui";
        $comments = [
            ["user" => "User1", "comment" => "Un producto util"],
            ["user" => "User2", "comment" => "Lo compraria de nuevo"]
        ];
        ?>

        <div class="productContainer">
            <!-- Galería de imágenes -->
            <div class="productGallery">
                <img src="<?php echo $mainImage; ?>" alt="paprika" class="mainImage">
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
                <h1>Paprika - Para mejorar tus comidas</h1>
                <p class="price"><?php echo $price; ?></p>
                <p class="rating"><?php echo $rating; ?></p>
                <p class="description">   
                Nuestra paprika natural es una especia vibrante y llena de sabor, ideal 
                para dar un toque único a tus platillos. Con su sabor suave y ligeramente 
                ahumado, es perfecta para realzar carnes, verduras, sopas y ensaladas. 
                Además de su delicioso sabor, la paprika es rica en antioxidantes, 
                vitaminas A y E, y ofrece beneficios para la salud, como la mejora de 
                la circulación sanguínea y la protección celular. Sin conservantes ni 
                aditivos, esta paprika es 100% natural, una opción perfecta para quienes 
                buscan un toque saludable y sabroso en su cocina.
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
<?php include 'footer.php'; ?>

</body>
</html>
