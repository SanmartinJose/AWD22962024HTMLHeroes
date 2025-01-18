<?php 
require_once 'Navbar.php'; 
require 'db_connection.php'; // Incluir la conexión a la base de datos

// Obtener productos desde la base de datos
function getProducts($conn) {
    $sql = "SELECT * FROM Products";
    $result = $conn->query($sql);
    $products = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    return $products;
}

$products = getProducts(getDatabaseConnection());
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NatuLove Products</title>

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/Catalog.css">
  <link rel="stylesheet" href="../../NATULOVE-PHP/css/Footer.css">
</head>
<body>

  <div class="container my-5">
    <center> <h1 class="display-4 mb-3 text-danger">NatuLove Productos con Amor</h1></center>   
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php
        // Generar los productos desde la base de datos
        foreach ($products as $product) {
          // Decodificar las imágenes JSON
          $productImages = json_decode($product['images'], true);
          $productImage = $productImages[0];  // Suponiendo que el primer elemento es la imagen principal
          echo '
          <div class="col">
            <div class="card h-100">
              <img src="'.$productImage.'" class="card-img-top" alt="'.$product["name"].'" height="200px">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">'.$product["name"].'</h5>
                <p class="card-text">$'.number_format($product["price"], 2).'</p>
                <div class="mt-auto d-flex justify-content-around">
                  <button class="btn btn-danger">Agregar al Carrito</button>
                  <a href="product_detail.php?id='.$product["id"].'" class="btn btn-info">Mas Info</a>
                </div>
              </div>
            </div>
          </div>
          ';
        }
      ?>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <?php include 'Footer.php'; ?>
</body>
</html>
