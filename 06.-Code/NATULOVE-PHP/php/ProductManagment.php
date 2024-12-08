<?php
// Database connection
$host = 'localhost';
$db = 'natulove';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio_unitario = $_POST['precio_unitario'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];
    $estado = $_POST['estado'];
    $tipo_impuesto = $_POST['tipo_impuesto'];
    $valor_impuesto = $_POST['valor_impuesto'];

    // Handle image upload
    $imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imageDir = 'uploads/';
        if (!is_dir($imageDir)) {
            mkdir($imageDir, 0777, true);
        }

        $imagePath = $imageDir . basename($_FILES['imagen']['name']);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagePath)) {
            $imagen = $imagePath;
        }
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio_unitario, stock, categoria, estado, tipo_impuesto, valor_impuesto, imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdisdsss", $nombre, $descripcion, $precio_unitario, $stock, $categoria, $estado, $tipo_impuesto, $valor_impuesto, $imagen);

    if ($stmt->execute()) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5 p-4 bg-white shadow rounded">
    <h1 class="text-center mb-4">Register Product</h1>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <div class="row gy-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Product Name:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
                <label for="descripcion" class="form-label mt-3">Description:</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
                <label for="precio_unitario" class="form-label mt-3">Unit Price:</label>
                <input type="number" step="0.01" name="precio_unitario" id="precio_unitario" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="stock" class="form-label">Stock:</label>
                <input type="number" name="stock" id="stock" class="form-control" required>
                <label for="categoria" class="form-label mt-3">Category:</label>
                <input type="text" name="categoria" id="categoria" class="form-control" required>
                <label for="estado" class="form-label mt-3">Status:</label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="activo">Active</option>
                    <option value="inactivo">Inactive</option>
                </select>
            </div>
        </div>
        <div class="row gy-3">
            <div class="col-md-6">
                <label for="tipo_impuesto" class="form-label">Tax Type:</label>
                <select name="tipo_impuesto" id="tipo_impuesto" class="form-select" required>
                    <option value="sinImpuesto">No Tax</option>
                    <option value="iva">IVA</option>
                    <option value="ice">ICE</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="valor_impuesto" class="form-label">Tax Value:</label>
                <input type="number" step="0.01" name="valor_impuesto" id="valor_impuesto" class="form-control">
            </div>
        </div>
        <div class="row gy-3">
            <div class="col-md-6">
                <label for="imagen" class="form-label">Product Image:</label>
                <input type="file" name="imagen" id="imagen" class="form-control">
            </div>
        </div>
        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary btn-lg">Add Product</button>
        </div>
    </form>
</div>
</body>
</html>
