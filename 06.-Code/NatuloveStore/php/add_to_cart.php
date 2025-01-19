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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto Agregado</title>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        // Mostrar la alerta animada
        Swal.fire({
            icon: 'success',
            title: 'Producto agregado correctamente',
            showConfirmButton: false, // No muestra el botón
            timer: 1000 // Alerta desaparece después de 1 segundos
        }).then(() => {
            // Redirigir de inmediato usando location.replace()
            setTimeout(function() {
                window.location.replace('catalog.php');
            }, 1000); // Redirige después de 1 segundos (cuando la alerta desaparezca)
        });
    </script>
</body>
</html>





