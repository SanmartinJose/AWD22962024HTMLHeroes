<?php
// Ver los comentarios
include('db_connection.php');

// Establecer conexión a la base de datos
$conn = getDatabaseConnection();  // Aquí se establece la conexión con la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportar Tablas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php include 'adminNavbar.php'; ?>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Exportar Información</h2>
        <table class="table table-striped table-bordered text-center">
            <thead class="table-success">
                <tr>
                    <th>Sección</th>
                    <th>Exportar a PDF</th>
                    <th>Exportar a Excel</th>
                    <th>Exportar a JSON</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                   <tr>
                    <td>Usuarios</td>
                    <td><button id="downloadUsersBtn" type="submit" name="format" value="pdf" class="btn btn-danger">.pdf</td>
                    <td><button id="downloadUsersExcelBtn" type="submit" name="format" value="excel" class="btn btn-success">excel</td>
                    <td><button id="downloadUsersJsonBtn" type="submit" name="format" value="excel" class="btn btn-info">.json</td></tr>
                <tr>
                    <td>Ventas</td>
                    <td><button id="downloadAvoicesBtn" type="submit" name="format" value="pdf" class="btn btn-danger">.pdf</td>
                    <td><button id="downloadDetailsSalesExcelBtn" type="submit" name="format" value="excel" class="btn btn-success">excel</td>
                    <td><button id="downloadDetailsSalesJsonBtn" type="submit" name="format" value="excel" class="btn btn-info">.json</td>
                    
                </tr>
                <tr>
                    <td>Facturas</td>
                    <td><button id="downloadDetailsSalesBtn" type="submit" name="format" value="pdf" class="btn btn-danger">.pdf</td>
                    <td><button id="downloadAvoicesExcelBtn" type="submit" name="format" value="excel" class="btn btn-success">excel</td>
                    <td><button id="downloadAvoicesJsonBtn" type="submit" name="format" value="excel" class="btn btn-info">.json</td></tr>
                <tr>
                    <td>Comentarios</td>
                    <td>  <button id="downloadBtn" type="submit" name="format" value="pdf" class="btn btn-danger">.pdf</button></td>
                    <td><button id="downloadComentaryExcelBtn" type="submit" name="format" value="excel" class="btn btn-success">excel</td>
                    <td><button id="downloadComentaryJsonBtn" type="submit" name="format" value="excel" class="btn btn-info">.json</td></tr>
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
    document.getElementById('downloadProductsJsonBtn').addEventListener('click', function () {
        let products = [];

        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM Products";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "products.push({";
                echo "'id': '{$row['id']}',";
                echo "'name': '{$row['name']}',";
                echo "'description': '{$row['description']}',";
                echo "'category': '{$row['category']}',";
                echo "'inventory': '{$row['inventory']}',";
                echo "'weight': '{$row['weight']}',";
                echo "'weight_unit': '{$row['weight_unit']}',";
                echo "'price': '{$row['price']}',";
                echo "'reservable': '{$row['reservable']}',";
                echo "'status': '{$row['status']}'";
                echo "});";
            }
        }
        $conn->close();
        ?>

        let jsonData = JSON.stringify(products, null, 2);
        let blob = new Blob([jsonData], { type: 'application/json' });

        let link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'productos.json';
        link.click();
    });
</script>
<script>
    document.getElementById('downloadUsersJsonBtn').addEventListener('click', function () {
        let users = [];

        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "users.push({";
                echo "'id': '{$row['id']}',";
                echo "'first_name': '{$row['first_name']}',";
                echo "'last_name': '{$row['last_name']}',";
                echo "'email': '{$row['email']}',";
                echo "'birth_date': '{$row['birth_date']}',";
                echo "'role': '{$row['role']}'";
                echo "});";
            }
        }
        $conn->close();
        ?>

        let jsonData = JSON.stringify(users, null, 2);
        let blob = new Blob([jsonData], { type: 'application/json' });

        let link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'usuarios.json';
        link.click();
    });
</script>

   <script>
    document.getElementById('downloadDetailsSalesJsonBtn').addEventListener('click', function () {
        let details = [];

        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM Details_Sales";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "details.push({";
                echo "'id_sale': '{$row['id_sale']}',";
                echo "'id_product': '{$row['id_product']}',";
                echo "'subtotal': '{$row['subtotal']}'";
                echo "});";
            }
        }
        $conn->close();
        ?>

        let jsonData = JSON.stringify(details, null, 2);
        let blob = new Blob([jsonData], { type: 'application/json' });

        let link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'detalles_venta.json';
        link.click();
    });
</script>

    <script>
    document.getElementById('downloadComentaryJsonBtn').addEventListener('click', function () {
        let comments = [];

        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM comentary";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "comments.push({";
                echo "'product_id': '{$row['product_id']}',";
                echo "'rating': '{$row['rating']}',";
                echo "'comment': '{$row['comment']}',";
                echo "'created_at': '{$row['created_at']}'";
                echo "});";
            }
        }
        $conn->close();
        ?>

        let jsonData = JSON.stringify(comments, null, 2);
        let blob = new Blob([jsonData], { type: 'application/json' });

        let link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'comentarios.json';
        link.click();
    });
</script>

   <script>
    document.getElementById('downloadAvoicesJsonBtn').addEventListener('click', function () {
        let avoices = [];

        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM Avoices";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "avoices.push({";
                echo "'id_avoice': '{$row['id_avoice']}',";
                echo "'id_client': '{$row['id_client']}',";
                echo "'total_amount': '{$row['total_amount']}',";
                echo "'payment_status': '{$row['payment_status']}'";
                echo "});";
            }
        }
        $conn->close();
        ?>

        let jsonData = JSON.stringify(avoices, null, 2);
        let blob = new Blob([jsonData], { type: 'application/json' });

        let link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'avoices.json';
        link.click();
    });
</script>

  <script>
    document.getElementById('downloadUsersExcelBtn').addEventListener('click', function () {
        let users = [];

        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "users.push(['ID', 'Nombre', 'Apellido', 'Correo', 'Fecha de nacimiento', 'Rol']);";
            while($row = $result->fetch_assoc()) {
                echo "users.push([ '{$row['id']}', '{$row['first_name']} {$row['last_name']}', '{$row['email']}', '{$row['birth_date']}', '{$row['role']}']);";
            }
        }
        $conn->close();
        ?>

        var ws = XLSX.utils.aoa_to_sheet(users);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Usuarios");

        XLSX.writeFile(wb, "usuarios.xlsx");
    });
</script>

    <script>
    document.getElementById('downloadProductsExcelBtn').addEventListener('click', function () {
        let products = [];

        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM Products";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "products.push(['ID', 'Nombre', 'Descripción', 'Categoría', 'Inventario', 'Peso', 'Unidad de Peso', 'Precio', 'Reservable', 'Estado']);";
            while($row = $result->fetch_assoc()) {
                echo "products.push([ '{$row['id']}', '{$row['name']}', '{$row['description']}', '{$row['category']}', '{$row['inventory']}', '{$row['weight']}', '{$row['weight_unit']}', '{$row['price']}', '{$row['reservable']}', '{$row['status']}']);";
            }
        }
        $conn->close();
        ?>

        var ws = XLSX.utils.aoa_to_sheet(products);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Productos");

        XLSX.writeFile(wb, "productos.xlsx");
    });
</script>

    <script>
    document.getElementById('downloadDetailsSalesExcelBtn').addEventListener('click', function () {
        let details = [];

        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM Details_Sales";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "details.push(['ID Venta', 'ID Producto', 'Subtotal']);";
            while($row = $result->fetch_assoc()) {
                echo "details.push([ '{$row['id_sale']}', '{$row['id_product']}', '{$row['subtotal']}']);";
            }
        }
        $conn->close();
        ?>

        var ws = XLSX.utils.aoa_to_sheet(details);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Detalles de Venta");

        XLSX.writeFile(wb, "detalles_venta.xlsx");
    });
</script>

   <script>
    document.getElementById('downloadComentaryExcelBtn').addEventListener('click', function () {
        let comments = [];

        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM comentary";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "comments.push(['Producto ID', 'Calificación', 'Comentario', 'Fecha']);";
            while($row = $result->fetch_assoc()) {
                echo "comments.push([ '{$row['product_id']}', '{$row['rating']}', '{$row['comment']}', '{$row['created_at']}']);";
            }
        }
        $conn->close();
        ?>

        var ws = XLSX.utils.aoa_to_sheet(comments);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Comentarios");

        XLSX.writeFile(wb, "comentarios.xlsx");
    });
</script>
 <script>
    document.getElementById('downloadUsersBtn').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.setFontSize(18);
        doc.text("Usuarios", 20, 20);

        let yPosition = 30;

        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "doc.setFontSize(12);";
                echo "doc.text('Usuario: {$row['first_name']} {$row['last_name']}', 20, yPosition);";
                echo "doc.text('Correo: {$row['email']}', 20, yPosition + 10);";
                echo "doc.text('Fecha de nacimiento: {$row['birth_date']}', 20, yPosition + 20);";
                echo "yPosition += 40;";
            }
        }
        $conn->close();
        ?>

        doc.save("usuarios.pdf");
    });
</script>

<script>
    document.getElementById('downloadProductsBtn').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.setFontSize(18);
        doc.text("Productos", 20, 20);

        let yPosition = 30;

        // Aquí se realiza la llamada PHP para obtener los datos de la base de datos.
        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM Products";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "doc.setFontSize(12);";
                echo "doc.text('ID Producto: {$row['id']}', 20, yPosition);";
                echo "doc.text('Nombre: {$row['name']}', 20, yPosition + 10);";
                echo "doc.text('Descripción: {$row['description']}', 20, yPosition + 20);";
                echo "doc.text('Categoría: {$row['category']}', 20, yPosition + 30);";
                echo "doc.text('Inventario: {$row['inventory']}', 20, yPosition + 40);";
                echo "doc.text('Peso: {$row['weight']} {$row['weight_unit']}', 20, yPosition + 50);";
                echo "doc.text('Precio: {$row['price']}', 20, yPosition + 60);";
                echo "doc.text('Reservable: {$row['reservable']}', 20, yPosition + 70);";
                echo "doc.text('Estado: {$row['status']}', 20, yPosition + 80);";
                echo "yPosition += 90;";  // Ajustar el espaciado entre productos
            }
        }
        $conn->close();
        ?>

        doc.save("productos.pdf");
    });
</script>
<script>
    document.getElementById('downloadExcelBtn').addEventListener('click', function () {
        // Crear un array con los datos de los productos
        let products = [];

        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM Products";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Preparamos los encabezados del archivo Excel
            echo "products.push(['ID', 'Nombre', 'Descripción', 'Categoría', 'Inventario', 'Peso', 'Unidad de Peso', 'Precio', 'Reservable', 'Estado']);";

            while($row = $result->fetch_assoc()) {
                // Agregar los datos de cada producto al array
                echo "products.push([ '{$row['id']}', '{$row['name']}', '{$row['description']}', '{$row['category']}', '{$row['inventory']}', '{$row['weight']}', '{$row['weight_unit']}', '{$row['price']}', '{$row['reservable']}', '{$row['status']}']);";
            }
        }
        $conn->close();
        ?>

        // Crear una hoja de trabajo (sheet) y un libro de trabajo (workbook)
        var ws = XLSX.utils.aoa_to_sheet(products);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Productos");

        // Exportar a archivo Excel
        XLSX.writeFile(wb, "productos.xlsx");
    });
</script>
<script>
    document.getElementById('downloadAvoicesExcelBtn').addEventListener('click', function () {
        let avoices = [];

        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM Avoices";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "avoices.push(['ID Avoice', 'Cliente ID', 'Monto Total', 'Estado de Pago']);";
            while($row = $result->fetch_assoc()) {
                echo "avoices.push([ '{$row['id_avoice']}', '{$row['id_client']}', '{$row['total_amount']}', '{$row['payment_status']}']);";
            }
        }
        $conn->close();
        ?>

        var ws = XLSX.utils.aoa_to_sheet(avoices);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Avoices");

        XLSX.writeFile(wb, "avoices.xlsx");
    });
</script>



    <script>
    document.getElementById('downloadDetailsSalesBtn').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.setFontSize(18);
        doc.text("Detalles de Venta", 20, 20);

        let yPosition = 30;

        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM Details_Sales";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "doc.setFontSize(12);";
                echo "doc.text('Venta ID: {$row['id_sale']}', 20, yPosition);";
                echo "doc.text('Producto ID: {$row['id_product']}', 20, yPosition + 10);";
                echo "doc.text('Subtotal: {$row['subtotal']}', 20, yPosition + 20);";
                echo "yPosition += 40;";
            }
        }
        $conn->close();
        ?>

        doc.save("detalles_venta.pdf");
    });
</script>

<script>
    document.getElementById('downloadBtn').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Título del documento
        doc.setFontSize(18);
        doc.text("Comentarios de los Productos", 20, 20);

        // Definir el inicio de la posición en el eje Y para los comentarios
        let yPosition = 30;

        // Contenido generado dinámicamente en PHP
        <?php
        // Conectar a la base de datos y obtener los comentarios
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM comentary";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Imprimir cada comentario en formato deseado
                echo "doc.setFontSize(12);"; // Ajustar el tamaño de la fuente para el contenido
                echo "doc.text('Comentario del producto {$row['product_id']}', 20, yPosition);";
                echo "doc.text('Calificación: {$row['rating']} estrellas', 20, yPosition + 10);";
                echo "doc.text('Descripción: {$row['comment']}', 20, yPosition + 20);";
                echo "doc.setLineWidth(0.5);"; // Definir el grosor de la línea
                echo "doc.line(20, yPosition + 30, 190, yPosition + 30);"; // Línea separadora
                echo "yPosition += 40;"; // Aumentar la posición Y para el siguiente comentario
                
            }
        }
        $conn->close();
        ?>

        // Descargar el PDF generado
        doc.save("comentarios.pdf");
    });
</script>


<script>
    document.getElementById('downloadAvoicesBtn').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Título del documento
        doc.setFontSize(18);
        doc.text("Avoices", 20, 20);

        // Definir el inicio de la posición en el eje Y
        let yPosition = 30;

        // Contenido generado dinámicamente en PHP
        <?php
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM Avoices";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "doc.setFontSize(12);";
                echo "doc.text('ID Avoice: {$row['id_avoice']}', 20, yPosition);";
                echo "doc.text('Cliente ID: {$row['id_client']}', 20, yPosition + 10);";
                echo "doc.text('Monto Total: {$row['total_amount']}', 20, yPosition + 20);";
                echo "doc.text('Estado de pago: {$row['payment_status']}', 20, yPosition + 30);";
                echo "yPosition += 40;";
                echo "doc.line(20, yPosition + 30, 190, yPosition + 30);"; // Línea separadora
               
            }
        }
        $conn->close();
        ?>

        // Descargar el PDF generado
        doc.save("avoices.pdf");
    });
</script>


<!-- Incluyendo las librerías necesarias para DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
</body>
</html>







