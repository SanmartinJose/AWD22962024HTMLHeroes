
<?php 
require_once 'adminNavbar.php'; 
require 'db_connection.php';

// Obtener productos desde la base de datos
function getProducts($conn, $category = null, $search = null, $page = 1, $limit = 6) {
    $offset = ($page - 1) * $limit;
    $sql = "SELECT * FROM Products WHERE 1";

    if ($category) {
        $sql .= " AND category = '" . $conn->real_escape_string($category) . "'";
    }

    if ($search) {
        $sql .= " AND name LIKE '%" . $conn->real_escape_string($search) . "%'";
    }

    $sql .= " LIMIT $limit OFFSET $offset";

    $result = $conn->query($sql);
    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}

$category = isset($_GET['category']) ? $_GET['category'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$products = getProducts(getDatabaseConnection(), $category, $search, $page);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Productos</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/Catalog.css">
</head>
<body>

<div class="container my-5">
  <center><h1 class="display-4 mb-3 text-danger">Editar Productos</h1></center>

  <div class="row">
    <div class="col-md-3">
      <h5>Categorías</h5>
      <a href="?category=Dulce" class="list-group-item list-group-item-action">Dulce</a>
      <a href="?category=Planta Medicinal" class="list-group-item list-group-item-action">Planta Medicinal</a>
      <a href="?category=Frutos Secos" class="list-group-item list-group-item-action">Frutos Secos</a>
      <a href="?category=Detalles" class="list-group-item list-group-item-action">Detalles</a>
      <a href="?category=Chocolate" class="list-group-item list-group-item-action">Chocolate</a>
      <a href="?category=Combos" class="list-group-item list-group-item-action">Combos</a>

      <form method="get" class="mt-3">
        <input type="text" name="search" class="form-control" placeholder="Buscar producto..." value="<?php echo $search; ?>">
        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
      </form>
    </div>

    <div class="col-md-9">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        foreach ($products as $product) {
          $productImages = json_decode($product['images'], true);
          $productImage = $productImages[0] ?? 'default.jpg';

          // Determinar el mensaje y el estilo según el inventario
          $inventory = $product['inventory'];
          if ($inventory == 0) {
            $stockMessage = '<span class="text-danger">Stock agotado</span>';
          } elseif ($inventory <= 5) {
            $stockMessage = '<span class="text-warning">Stock casi agotado</span>';
          } else {
            $stockMessage = '<span class="text-success">Stock disponible</span>';
          }

          echo '
          <div class="col">
            <div class="card h-100">
              <img src="'.$productImage.'" class="card-img-top" alt="'.$product["name"].'" height="200px">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">'.$product["name"].'</h5>
                <p class="card-text">$'.number_format($product["price"], 2).'</p>
                <p class="card-text">Cantidad Disponible: '.number_format($inventory).'</p>
                <p class="card-text">'.$stockMessage.'</p>
                <button class="btn btn-primary mt-auto" data-toggle="modal" data-target="#editModal'.$product['id'].'">Editar</button>
              </div>
            </div>
          </div>

          <!-- Modal de edición -->
          <div class="modal fade" id="editModal'.$product['id'].'" tabindex="-1" role="dialog" aria-labelledby="editModalLabel'.$product['id'].'" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel'.$product['id'].'">Editar Producto</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="POST" action="./update_product.php" enctype="multipart/form-data">
                  <div class="modal-body">
                    <input type="hidden" name="product_id" value="'.$product['id'].'">
                    <div class="form-group">
                      <label for="product_name_'.$product['id'].'">Nombre:</label>
                      <input type="text" class="form-control" id="product_name_'.$product['id'].'" name="product_name" value="'.$product['name'].'" required>
                    </div>
                    <div class="form-group">
                      <label for="product_description_'.$product['id'].'">Descripción:</label>
                      <textarea class="form-control" id="product_description_'.$product['id'].'" name="product_description" required>'.$product['description'].'</textarea>
                    </div>
                    <div class="form-group">
                      <label for="product_price_'.$product['id'].'">Precio:</label>
                      <input type="number" class="form-control" id="product_price_'.$product['id'].'" name="product_price" value="'.$product['price'].'" required>
                    </div>
                    <div class="form-group">
                      <label for="product_inventory_'.$product['id'].'">Inventario:</label>
                      <input type="number" class="form-control" id="product_inventory_'.$product['id'].'" name="product_inventory" value="'.$inventory.'" required>
                    </div>
                    <div class="form-group">
                      <label for="product_image_'.$product['id'].'">Actualizar Imagen:</label>
                      <input type="file" class="form-control" id="product_image_'.$product['id'].'" name="product_image">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          ';
        }
        ?>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php include 'Footer.php'; ?>
</body>
</html>
=======
<?php
// editProduct.php
include('db_connection.php');

if (isset($_POST['id'])) {
    $productId = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $inventory = $_POST['inventory'];
    $weight = $_POST['weight'];
    $weightUnit = $_POST['weight_unit'];
    $price = $_POST['price'];
    $reservable = $_POST['reservable'];
    $status = $_POST['status'];

    $conn = getDatabaseConnection();

    // Preparar la consulta de actualización
    $stmt = $conn->prepare("UPDATE Products SET name = ?, description = ?, category = ?, inventory = ?, weight = ?, weight_unit = ?, price = ?, reservable = ?, status = ? WHERE id = ?");
    
    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param(
        "sssidsdsss",
        $name,
        $description,
        $category,
        $inventory,
        $weight,
        $weightUnit,
        $price,
        $reservable,
        $status,
        $productId
    );

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'error: No ID provided';
}
?>

