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

    // Eliminar producto
    $(document).on('click', '.deleteBtn', function() {
        var productId = $(this).data('id');
        if (confirm('¿Estás seguro de eliminar este producto?')) {
            $.ajax({
                url: 'deleteProduct.php',
                type: 'POST',
                data: { id: productId },
                success: function(response) {
                    if (response == 'success') {
                        alert('Producto eliminado con éxito.');
                        location.reload();
                    } else {
                        alert('Error al eliminar el producto.');
                    }
                }
            });
        }
    });

    // Buscar producto
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#inventoryTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
