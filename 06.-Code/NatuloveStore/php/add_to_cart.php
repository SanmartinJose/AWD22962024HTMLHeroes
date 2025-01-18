<?php
session_start();

// Asegúrate de que haya un producto a agregar
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Si no hay carrito, lo inicializamos
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Agregamos el producto al carrito (por ahora solo guardamos el ID)
    $_SESSION['cart'][] = $productId;

    echo "Producto agregado al carrito. <a href='catalog.php'>Volver al catálogo</a>";
} else {
    echo "No se ha seleccionado ningún producto.";
}
?>
