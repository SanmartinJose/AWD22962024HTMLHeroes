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

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo "<div class='text-center'><H1>El carrito está vacío.</H1></div>";
            echo "<div class='d-flex justify-content-center'>";
            echo "<img  src='../img/carrito.png' alt='Carrito vacío' class='img-fluid' >";
            echo "</div>";
            
            echo "<div class='d-flex justify-content-center mb-3'>";
            echo "<a href='catalog.php' class='btn btn-primary btn-sm'>Volver al catálogo</a>";
            echo "</div>";
            
        } else {
            echo "<h2 class='text-center'>Carrito de Compras</h2>";
            echo "<form method='POST' action='cart.php' id='cartForm'>";
            echo "<table class='table table-bordered table-striped table-sm mx-auto' style='max-width: 800px;'>";
            echo "<thead class='thead-dark'>
                    <tr>
                        <th>Nombre del Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>";

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
                    echo "<td>\$$price</td>";
                    echo "<td><input type='number' name='quantities[$productId]' value='$quantity' min='0' onchange='updateCart()' class='form-control form-control-sm' style='width: 80px;'></td>";
                    echo "<td>\$$subtotal</td>";
                    echo "<td><button type='submit' name='remove' value='$productId' class='btn btn-danger btn-sm'>Eliminar</button></td>";
                    echo "</tr>";
                    
                    $total += $subtotal;
                } else {
                    // Si el producto no se encuentra, eliminarlo del carrito
                    unset($_SESSION['cart'][$productId]);
                }
            }
            
            echo "<tr><td colspan='3' class='text-right'><strong>Total</strong></td><td>\$$total</td><td></td></tr>";
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "<div class='d-flex justify-content-center mb-3'>";
            echo "<a href='catalog.php' class='btn btn-secondary btn-sm'>Volver al catálogo</a>";
            echo "<a href='checkout.php' class='btn btn-primary btn-sm'>Proceder al pago</a>";
            echo "</div>";
        }
        ?>
    </div>

    <script>
    function updateCart() {
        document.getElementById('cartForm').submit();
    }
    </script>
</body>
</html>
