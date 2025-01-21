<?php
require 'db_connection.php';

/**
 * Escapa y limpia los datos de entrada.
 */
function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

/**
 * Sube una imagen a Imgur y devuelve la URL de la imagen.
 */
function uploadToImgur($filePath) {
    $clientId = '9b044eb5337e95c'; // Reemplaza con tu Client ID de Imgur

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.imgur.com/3/upload",
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Client-ID $clientId"
        ],
        CURLOPT_POSTFIELDS => [
            'image' => base64_encode(file_get_contents($filePath)),
        ],
    ]);

    $response = curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);

    if ($error) {
        throw new Exception("Error en la subida a Imgur: $error");
    }

    $responseData = json_decode($response, true);
    if (isset($responseData['success']) && $responseData['success']) {
        return $responseData['data']['link'];
    } else {
        throw new Exception("Error en la respuesta de Imgur: " . $responseData['data']['error']);
    }
}

/**
 * Procesa y guarda el producto en la base de datos.
 */
function saveProduct($conn, $data) {
    $stmt = $conn->prepare("
    INSERT INTO Products (id, name, description, category, inventory, weight, weight_unit, price, reservable, images, status) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

// Revisa el número de parámetros y asegúrate de que todos coincidan
$stmt->bind_param(
    'sssssdssiss', // Ajustamos el tipo de parámetro
    $data['id'],
    $data['name'],
    $data['description'],
    $data['category'],
    $data['inventory'],
    $data['weight'],
    $data['weight_unit'],
    $data['price'],
    $data['reservable'],
    $data['images'],  // Esto es una cadena JSON, no un array
    $data['status']
);


    if (!$stmt->execute()) {
        throw new Exception("Error al guardar el producto: " . $stmt->error);
    }

    $stmt->close();
}

/**
 * Procesa la solicitud de formulario.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn = getDatabaseConnection();

        // Validación y sanitización de entradas
        $productName = validateInput($_POST['product_name']);
        $productDescription = validateInput($_POST['product_description']);
        $productCategory = validateInput($_POST['product_category']);
        $productInventory = (int)validateInput($_POST['product_inventory']);
        $productWeight = ($_POST['weight_unit'] === 'unidad') ? 0 : (float)validateInput($_POST['product_weight']);
        $weightUnit = validateInput($_POST['weight_unit']);
        $productPrice = (float)validateInput($_POST['product_price']);
        $reservable = isset($_POST['reservable']) ? 1 : 0; // Booleano
        $productStatus = validateInput($_POST['product_status']);

        // Validaciones de negocio
        if (strlen($productName) < 3 || strlen($productName) > 400) {
            throw new Exception("El nombre del producto debe tener entre 3 y 400 caracteres.");
        }
        if (strlen($productDescription) > 500) {
            throw new Exception("La descripción no puede superar los 500 caracteres.");
        }
        if (!in_array($productCategory, ['Dulce', 'Planta Medicinal', 'Frutos Secos', 'Detalles', 'Chocolate', 'Combos'])) {
            throw new Exception("Categoría no válida.");
        }
        if ($productInventory < 0) {
            throw new Exception("La cantidad en inventario debe ser mayor o igual a 0.");
        }
        if (!in_array($weightUnit, ['gr', 'lb', 'kilo', 'unidad'])) {
            throw new Exception("Unidad no válida.");
        }
        if ($weightUnit !== 'unidad' && $productWeight <= 0) {
            throw new Exception("El peso debe ser mayor a 0 si no es 'unidad'.");
        }
        if ($productPrice <= 0) {
            throw new Exception("El precio debe ser mayor a 0.");
        }
        if (!in_array($productStatus, ['Activo', 'Inactivo'])) {
            throw new Exception("Estado no válido.");
        }

        // Subida de imágenes a Imgur
        $images = [];
        if (isset($_FILES['product_images']) && !empty($_FILES['product_images']['name'][0])) {
            foreach ($_FILES['product_images']['tmp_name'] as $tmp_name) {
                $images[] = uploadToImgur($tmp_name);
            }
        }

        // Preparar datos del producto
        $productData = [
            'id' => 'NL' . str_pad((string)rand(1, 9999), 4, '0', STR_PAD_LEFT),
            'name' => $productName,
            'description' => $productDescription,
            'category' => $productCategory,
            'inventory' => $productInventory,
            'weight' => $productWeight,
            'weight_unit' => $weightUnit,
            'price' => $productPrice,
            'reservable' => $reservable,
            'images' => json_encode($images),
            'status' => $productStatus
        ];

        // Guardar en la base de datos
        saveProduct($conn, $productData);

        echo "<div class='alert alert-success'>Producto agregado exitosamente.</div>";
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    } finally {
        if (isset($conn)) {
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'adminNavbar.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Agregar Producto</h2>
        <form method="POST" enctype="multipart/form-data" class="p-4 border rounded">
            <div class="mb-3">
                <label for="product_name" class="form-label">Nombre del Producto:</label>
                <textarea id="product_name" name="product_name" class="form-control" required minlength="3" maxlength="400"></textarea>
            </div>
            <div class="mb-3">
                <label for="product_description" class="form-label">Descripción:</label>
                <textarea id="product_description" name="product_description" class="form-control" maxlength="500" required></textarea>
            </div>
            <div class="mb-3">
                <label for="product_category" class="form-label">Categoría:</label>
                <select id="product_category" name="product_category" class="form-control" required>
                    <option value="Dulce">Dulce</option>
                    <option value="Planta Medicinal">Planta Medicinal</option>
                    <option value="Frutos Secos">Frutos Secos</option>
                    <option value="Detalles">Detalles</option>
                    <option value="Chocolate">Chocolate</option>
                    <option value="Combos">Combos</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="product_inventory" class="form-label">Cantidad en Inventario:</label>
                <input type="number" id="product_inventory" name="product_inventory" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label for="product_weight" class="form-label">Peso:</label>
                <div class="input-group">
                    <input type="number" id="product_weight" name="product_weight" class="form-control" step="0.01" min="0" required>
                    <select id="weight_unit" name="weight_unit" class="form-control" required onchange="toggleWeightInput(this.value)">
                        <option value="gr">gr</option>
                        <option value="lb">lb</option>
                        <option value="kilo">kilo</option>
                        <option value="unidad">unidad</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="product_price" class="form-label">Precio:</label>
                <input type="number" id="product_price" name="product_price" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="reservable" class="form-label">¿Reservable?</label>
                <input type="checkbox" id="reservable" name="reservable" value="1">
            </div>
            <div class="mb-3">
                <label for="product_images" class="form-label">Imágenes:</label>
                <input type="file" id="product_images" name="product_images[]" class="form-control" accept="image/*" multiple>
            </div>
            <div class="mb-3">
                <label for="product_status" class="form-label">Estado:</label>
                <select id="product_status" name="product_status" class="form-control" required>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
    <script>
        function toggleWeightInput(value) {
            const weightInput = document.getElementById('product_weight');
            weightInput.disabled = value === 'unidad';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php include 'Footer.php'; ?>
</body>
</html>
