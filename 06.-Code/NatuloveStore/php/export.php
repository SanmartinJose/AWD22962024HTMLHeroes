<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportar Tablas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Exportar Tablas</h2>
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
                    <td>Productos</td>
                    <td><button class="btn btn-danger" onclick="exportData('Productos', 'pdf')">.pdf</button></td>
                    <td><button class="btn btn-success" onclick="exportData('Productos', 'excel')">.excel</button></td>
                    <td><button class="btn btn-info" onclick="exportData('Productos', 'json')">.json</button></td>
                </tr>
                <tr>
                    <td>Usuarios</td>
                    <td><button class="btn btn-danger" onclick="exportData('Usuarios', 'pdf')">.pdf</button></td>
                    <td><button class="btn btn-success" onclick="exportData('Usuarios', 'excel')">.excel</button></td>
                    <td><button class="btn btn-info" onclick="exportData('Usuarios', 'json')">.json</button></td>
                </tr>
                <tr>
                    <td>Ventas</td>
                    <td><button class="btn btn-danger" onclick="exportData('Ventas', 'pdf')">.pdf</button></td>
                    <td><button class="btn btn-success" onclick="exportData('Ventas', 'excel')">.excel</button></td>
                    <td><button class="btn btn-info" onclick="exportData('Ventas', 'json')">.json</button></td>
                </tr>
                <tr>
                    <td>Facturas</td>
                    <td><button class="btn btn-danger" onclick="exportData('Facturas', 'pdf')">.pdf</button></td>
                    <td><button class="btn btn-success" onclick="exportData('Facturas', 'excel')">.excel</button></td>
                    <td><button class="btn btn-info" onclick="exportData('Facturas', 'json')">.json</button></td>
                </tr>
                <tr>
                    <td>Comentarios</td>
                    <td><button class="btn btn-danger" onclick="exportData('Comentarios', 'pdf')">.pdf</button></td>
                    <td><button class="btn btn-success" onclick="exportData('Comentarios', 'excel')">.excel</button></td>
                    <td><button class="btn btn-info" onclick="exportData('Comentarios', 'json')">.json</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        /**
         * Función para exportar datos en el formato especificado.
         * @param {string} section - El nombre de la sección (Productos, Usuarios, Ventas, etc.).
         * @param {string} format - El formato de exportación (pdf, excel, json).
         */
        function exportData(section, format) {
            // Crear la URL de exportación
            const url = `export.php?section=${section}&format=${format}`;

            // Realizar la solicitud para descargar el archivo
            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error('Error en la descarga');

                    // Obtener el nombre del archivo desde los encabezados
                    const disposition = response.headers.get('Content-Disposition');
                    const filename = disposition ? disposition.split('filename=')[1] : `${section}.${format}`;

                    // Convertir la respuesta a un Blob
                    return response.blob().then(blob => ({ blob, filename }));
                })
                .then(({ blob, filename }) => {
                    // Crear un enlace para descargar el archivo
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = filename;
                    link.click();

                    // Liberar la URL del objeto después de la descarga
                    URL.revokeObjectURL(link.href);
                })
                .catch(error => {
                    console.error('Error al exportar:', error);
                    alert('Hubo un error al intentar exportar los datos.');
                });
        }
    </script>
</body>
</html>







