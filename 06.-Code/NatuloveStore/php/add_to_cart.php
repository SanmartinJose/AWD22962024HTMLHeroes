<?php
session_start();

// Asegúrate de que haya un producto a agregar
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Si no hay carrito, lo inicializamos
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Si el producto ya está en el carrito, aumentamos la cantidad
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        // De lo contrario, añadimos el producto al carrito con cantidad 1
        $_SESSION['cart'][$productId] = 1;
    }

    echo "Producto agregado al carrito. <a href='catalog.php'>Volver al catálogo</a>";
} else {
    echo "No se ha seleccionado ningún producto.";
}
?>
