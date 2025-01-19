<?php
session_start();
require 'db_connection.php'; // Asegúrate de tener una conexión a la base de datos
$conn = getDatabaseConnection();

// Manejar la actualización de cantidades y eliminación de productos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['quantities'])) {
        foreach ($_POST['quantities'] as $productId => $quantity) {
            $quantity = (int)$quantity;
            if ($quantity == 0) {
                unset($_SESSION['cart'][$productId]);
            } else {
                $_SESSION['cart'][$productId] = $quantity;
            }
        }
    }
    if (isset($_POST['remove'])) {
        $productIdToRemove = $_POST['remove'];
        unset($_SESSION['cart'][$productIdToRemove]);
    }
    header("Location: cart.php");
    exit;
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "El carrito está vacío.";
} else {
    echo "<h2>Carrito de Compras</h2>";
    echo "<form method='POST' action='cart.php' id='cartForm'>";
    echo "<table border='1'>";
    echo "<tr><th>Nombre del Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th>Acciones</th></tr>";
    
    $total = 0;
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        // Escapar el ID del producto para evitar inyecciones SQL
        $productId = mysqli_real_escape_string($conn, $productId);

        // Obtener detalles del producto desde la base de datos
        $query = "SELECT name, price FROM Products WHERE id = '$productId'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            
            $name = $product['name'];
            $price = $product['price'];
            
            // Asegúrate de convertir la cantidad y el precio a números
            $quantity = (int)$quantity;
            $price = (float)$price;
            
            $subtotal = $price * $quantity;
            
            echo "<tr>";
            echo "<td>$name</td>";
            echo "<td>$price</td>";
            echo "<td><input type='number' name='quantities[$productId]' value='$quantity' min='0' onchange='updateCart()'></td>";
            echo "<td>$subtotal</td>";
            echo "<td><button type='submit' name='remove' value='$productId'>Eliminar</button></td>";
            echo "</tr>";
            
            $total += $subtotal;
        } else {
            echo "<tr>";
            echo "<td colspan='5'>Producto no encontrado (ID: $productId)</td>";
            echo "</tr>";
        }
    }
    
    echo "<tr><td colspan='3'>Total</td><td>$total</td><td></td></tr>";
    echo "</table>";
    echo "</form>";
    echo "<a href='catalog.php'>Volver al catálogo</a>";
    echo "<a href='checkout.php'>Proceder al pago</a>";
}
?>

<script>
function updateCart() {
    document.getElementById('cartForm').submit();
}
</script>
