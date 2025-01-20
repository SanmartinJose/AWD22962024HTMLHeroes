<?php 
require_once 'Navbar.php'; 
require 'db_connection.php'; // Incluir la conexión a la base de datos

// Función para obtener productos desde la base de datos con filtrado por nombre o categoría
function getProducts($conn, $category = null, $search = null, $page = 1, $limit = 6) {
    $offset = ($page - 1) * $limit;
    $sql = "SELECT * FROM Products WHERE 1";

    if ($category) {
        $sql .= " AND category = '" . $conn->real_escape_string($category) . "'";
    }

    if ($search) {
        $sql .= " AND name LIKE '%" . $conn->real_escape_string($search) . "%'";
    }

    $sql .= " LIMIT $limit OFFSET $offset"; // Paginación

    $result = $conn->query($sql);
    $products = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    return $products;
}

// Función para obtener el total de productos para paginación
function getTotalProducts($conn, $category = null, $search = null) {
    $sql = "SELECT COUNT(*) as total FROM Products WHERE 1";
    if ($category) {
        $sql .= " AND category = '" . $conn->real_escape_string($category) . "'";
    }
    if ($search) {
        $sql .= " AND name LIKE '%" . $conn->real_escape_string($search) . "%'";
    }

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Obtener parámetros de búsqueda y filtrado
$category = isset($_GET['category']) ? $_GET['category'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Obtener productos
$products = getProducts(getDatabaseConnection(), $category, $search, $page);

// Obtener el total de productos para paginación
$totalProducts = getTotalProducts(getDatabaseConnection(), $category, $search);
$totalPages = ceil($totalProducts / 6); // Calcular el número de páginas

?>

<!DOCTYPE html>
<html lang="es">
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

    <div class="row">
      <!-- Menú de filtros en el lado izquierdo -->
      <div class="col-md-3">
        <div class="list-group">
          <h5>Categorías</h5>
          <a href="?category=Frutos" class="list-group-item list-group-item-action">Frutos</a>
          <a href="?category=Chocolates" class="list-group-item list-group-item-action">Chocolates</a>
          <a href="?category=Dulce" class="list-group-item list-group-item-action">Dulce</a>
          <a href="?category=Flores" class="list-group-item list-group-item-action">Flores</a>
        </div>
        <form method="get" class="mt-3">
          <input type="text" name="search" class="form-control" placeholder="Buscar producto..." value="<?php echo $search; ?>">
          <button type="submit" class="btn btn-primary mt-2">Buscar</button>
        </form>
      </div>

      <!-- Productos -->
      <div class="col-md-9">
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
                       <a href="add_to_cart.php?id='.$product['id'].'" class="btn btn-success">Agregar a Carrito</a>
                    </div>
                    <!-- Botón de Más Información -->
                    <a href="product_detail.php?id='.$product["id"].'" class="btn btn-primary mt-2">Más Info</a> <!-- Botón de más info -->
                  </div>
                </div>
              </div>
              ';
            }
          ?>
        </div>

        <!-- Paginación -->
        <nav>
          <ul class="pagination justify-content-center">
            <li class="page-item <?php if($page == 1) echo 'disabled'; ?>">
              <a class="page-link" href="?page=<?php echo max(1, $page - 1); ?>&category=<?php echo $category; ?>&search=<?php echo $search; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
              <li class="page-item <?php if($i == $page) echo 'active'; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>&category=<?php echo $category; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a>
              </li>
            <?php } ?>
            <li class="page-item <?php if($page == $totalPages) echo 'disabled'; ?>">
              <a class="page-link" href="?page=<?php echo min($totalPages, $page + 1); ?>&category=<?php echo $category; ?>&search=<?php echo $search; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <?php include 'Footer.php'; ?>
 

</body>
</html>
