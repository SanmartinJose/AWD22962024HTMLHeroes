// validation.js
$(document).ready(function() {
    // Inicializar DataTable
    $('#inventoryTable').DataTable();

    // Editar producto
    $(document).on('click', '.editBtn', function() {
        var productId = $(this).data('id');
        // Aquí puedes agregar el código para mostrar un formulario de edición
        // y cargar los datos del producto seleccionado.
    });


    // Buscar producto
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#inventoryTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});

$(document).ready(function() {
    // Inicializar DataTable
    $('#inventoryTable').DataTable();

    // Alternar estado del producto
    $(document).on('click', '.toggleStatusBtn', function() {
        var productId = $(this).data('id');
        if (confirm('¿Estás seguro de cambiar el estado de este producto?')) {
            $.ajax({
                url: 'php/toggleProductStatus.php',
                type: 'POST',
                data: { id: productId },
                success: function(response) {
                    if (response == 'success') {
                        alert('Estado del producto actualizado con éxito.');
                        location.reload();
                    } else {
                        alert('Error al actualizar el estado del producto.');
                    }
                }
            });
        }
    });
});




$(document).ready(function() {
    $('#inventoryTable').DataTable();

    // Eliminar producto
    $(document).on('click', '.deleteBtn', function() {
        var productId = $(this).data('id');
        if (confirm('¿Estás seguro de eliminar este producto?')) {
            $.ajax({
                url: './deleteProduct.php',  
                type: 'POST',
                data: { id: productId },
                success: function(response) {
                    if (response == 'success') {
                        alert('Producto eliminado con éxito.');
                        location.reload();  // Recargar la página después de eliminar el producto
                    } else {
                        alert('Error al eliminar el producto.');
                    }
                }
            });
        }
    });
});

$(document).on('click', '.editBtn', function () {
    var productId = $(this).data('id');

    // Obtener los datos actuales del producto desde la tabla
    var row = $(this).closest('tr');
    var name = row.find('td:nth-child(2)').text();
    var description = row.find('td:nth-child(3)').text();
    var category = row.find('td:nth-child(4)').text();
    var inventory = row.find('td:nth-child(5)').text();
    var weight = row.find('td:nth-child(6)').text();
    var weightUnit = row.find('td:nth-child(7)').text();
    var price = row.find('td:nth-child(8)').text();
    var reservable = row.find('td:nth-child(9)').text();
    var status = row.find('td:nth-child(10)').text();

    // Llenar los datos en el formulario del modal
    $('#editModal #productId').val(productId);
    $('#editModal #name').val(name);
    $('#editModal #description').val(description);
    $('#editModal #category').val(category);
    $('#editModal #inventory').val(inventory);
    $('#editModal #weight').val(weight);
    $('#editModal #weight_unit').val(weightUnit);
    $('#editModal #price').val(price);
    $('#editModal #reservable').val(reservable);
    $('#editModal #status').val(status);

    // Mostrar el modal
    $('#editModal').modal('show');
});

// Manejar la actualización del producto
$('#saveChanges').click(function () {
    var productData = {
        id: $('#editModal #productId').val(),
        name: $('#editModal #name').val(),
        description: $('#editModal #description').val(),
        category: $('#editModal #category').val(),
        inventory: $('#editModal #inventory').val(),
        weight: $('#editModal #weight').val(),
        weight_unit: $('#editModal #weight_unit').val(),
        price: $('#editModal #price').val(),
        reservable: $('#editModal #reservable').val(),
        status: $('#editModal #status').val()
    };

    // Enviar los datos al servidor
    $.ajax({
        url: './editProdut.php',
        type: 'POST',
        data: productData,
        success: function (response) {
            console.log('Respuesta del servidor:', response);

            if (response.trim() === 'success') {
                alert('Producto actualizado con éxito.');
                location.reload(); // Recargar la página
            } else {
                alert('Error al actualizar el producto: ' + response);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error en AJAX:', error);
        }
    });
});
