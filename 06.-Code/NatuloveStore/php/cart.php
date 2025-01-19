<?php
session_start();
require 'db_connection.php'; // Asegúrate de tener una conexión a la base de datos
$conn = getDatabaseConnection();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "El carrito está vacío.";
} else {
    echo "<h2>Carrito de Compras</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Nombre del Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th></tr>";
    
    $total = 0;
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        // Obtener detalles del producto desde la base de datos
        $query = "SELECT name, price FROM Products WHERE id = $productId";
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
            echo "<td>$quantity</td>";
            echo "<td>$subtotal</td>";
            echo "</tr>";
            
            $total += $subtotal;
        } else {
            echo "<tr>";
            echo "<td colspan='4'>Producto no encontrado (ID: $productId)</td>";
            echo "</tr>";
        }
    }
    
    echo "<tr><td colspan='3'>Total</td><td>$total</td></tr>";
    echo "</table>";
    echo "<a href='catalog.php'>Volver al catálogo</a>";
    echo "<a href='checkout.php'>Proceder al pago</a>";
}
?>
