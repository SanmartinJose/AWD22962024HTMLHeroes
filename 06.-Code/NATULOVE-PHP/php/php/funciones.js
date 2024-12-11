
document.getElementById('frm').addEventListener("submit", function(event) {
    event.preventDefault();

    // Crear un objeto FormData desde el formulario
    const formData = new FormData(document.getElementById('frm'));

    // Realizar la solicitud con fetch
    fetch("registrar.php", {
        method: "POST",
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Error en la respuesta del servidor");
        }
        return response.text(); // Procesar respuesta como texto
    })
    .then(response => {
        console.log(response); // Útil para depurar
        if (response.trim() === "ok") {
            Swal.fire({
                icon: 'success',
                title: "Producto registrado con éxito!",
                showConfirmButton: false,
                timer: 2000
            });
            document.getElementById('frm').reset(); // Limpiar formulario
        } else {
            Swal.fire({
                icon: 'error',
                title: "Error al registrar el producto!",
                text: response,
                showConfirmButton: true
            });
        }

        ListarProductos(); // Actualizar lista de productos
        ListarInventario(); // Actualizar inventario
        resetButton(); // Resetear botón
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: "Ocurrió un error inesperado",
            text: "Por favor intenta nuevamente.",
            showConfirmButton: true
        });
    });
});


function ListarProductos(busqueda = "") {
    fetch("listar.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            busqueda: busqueda
        })
    })
    .then(response => response.text())
    .then(response => {
        document.getElementById('datos_productos').innerHTML = response;
    })
    .catch(error => {
        console.error('Error al listar productos:', error);
    });
}



document.getElementById('frmC').addEventListener("submit", function(event) {
    event.preventDefault();  // Evitar el envío tradicional del formulario

    // Crear una instancia de FormData con el formulario
    const formData = new FormData(document.getElementById('frmC'));

    // Enviar los datos usando fetch
    fetch("registrarCate.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())  // Obtener la respuesta del servidor como texto
    .then(response => {
        console.log(response);  // Mostrar la respuesta del servidor en la consola

        // Comprobar si la respuesta es "ok"
        if (response.trim().toLowerCase() === "ok") {
            Swal.fire({
                icon: 'success',
                title: "Categoría registrada con éxito!",
                showConfirmButton: false,
                timer: 2000
            });
            document.getElementById('frmC').reset();  // Reiniciar el formulario
        } else {
            Swal.fire({
                icon: 'error',
                title: "Error",
                text: response,  // Mostrar el mensaje de error del servidor
                showConfirmButton: true
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);  // Mostrar el error en la consola
        Swal.fire({
           icon: 'error',
           title: "Error",
           text: "Ocurrió un error durante el proceso.",
           showConfirmButton: true
        });
    });
});





function Eliminar(id, estadoActual) {
    // Determinar la acción basada en el estado actual
    const nuevoEstado = estadoActual === 'activo' ? 'inactivo' : 'activo';

    // Mostrar confirmación al usuario
    Swal.fire({
        title: '¿Estás seguro?',
        text: `¿Deseas ${nuevoEstado === 'activo' ? 'activar' : 'desactivar'} el producto?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cambiar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar la solicitud al servidor
            fetch('eliminar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id, estado: estadoActual })
            })
            .then(response => response.text())
            .then(response => {
                if (response === 'ok') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Error',
                        text: 'Ocurrió un error al cambiar el estado.',
                    });
                   
                    ListarProductos();
                } else {
                    
					Swal.fire({
                        icon: 'success',
                        title: `Producto ${nuevoEstado === 'activo' ? 'desactivado' : 'activado'} con éxito!`,
                        showConfirmButton: false,
                        timer: 2000
                    });
                } ListarProductos();  
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error durante la solicitud.',
                });
            });
        }
    });
}



function Editar(id) {
    fetch("editar.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'  
        },
        body: JSON.stringify({ id: id })  
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(response => {
        console.log(response);  
        if (response) {
		    document.getElementById('idp').value = response.id_producto || '';
            document.getElementById('nombre').value = response.nombre_producto || '';
            document.getElementById('descripcion').value = response.descripcion || '';
            document.getElementById('precio_unitario').value = response.precio_unitario || '';
            document.getElementById('categoria').value = response.categoria || '';
            document.getElementById('stock').value = response.stock || '';
            document.getElementById('estado').value = response.estado || '';
            document.getElementById('tipo_impuesto').value = response.producto_iva_rise || '';
            document.getElementById('valor_impuesto').value = response.valor_iva_risa || '';
			document.getElementById('registrar').value = 'Actualizar';
        } else {
            alert("Error: No se encontraron los datos del producto.");
        }
    })
    .catch(error => {
        console.error('Error al editar el producto:', error);
        alert("Hubo un problema al cargar los datos del producto. Por favor, intenta nuevamente.");
    });
}
function resetButton() {
    document.getElementById('registrar').value = 'Enviar datos';
}
document.addEventListener("DOMContentLoaded", ListarProductos);



document.getElementById("precio_unitario").addEventListener("keypress", function(event) {
    var charCode = event.which ? event.which : event.keyCode;
    var inputValue = this.value;

    // Permitir solo números (0-9), punto (.) y coma (,)
    if ((charCode < 48 || charCode > 57) && charCode !== 46 && charCode !== 44) {
        event.preventDefault();
    }

    // Bloquear más de un punto o coma
    if ((charCode === 46 || charCode === 44) && (inputValue.includes('.') || inputValue.includes(','))) {
        event.preventDefault();
    }
});

document.getElementById("precio_unitario").addEventListener("input", function() {
    var precio = this.value;
    var regexPrecio = /^[0-9]+([.,][0-9]{0,8})?$/;
    var precioError = document.getElementById("precioError");

    if (!regexPrecio.test(precio)) {
        precioError.textContent = "El precio solo puede contener números, y opcionalmente un punto o coma.";
    } else {
        precioError.textContent = "";
    }
});





document.getElementById("stock").addEventListener("keypress", function(event) {
    // Obtener el código de la tecla presionada
    var charCode = event.which ? event.which : event.keyCode;

    // Permitir solo números (0-9)
    if (charCode < 48 || charCode > 57) {
        event.preventDefault();  // Bloquear el carácter si no es un número
    }
});

document.getElementById("stock").addEventListener("input", function() {
    // Validar que el valor no tenga más de 4 dígitos
    var stock = this.value;
    var stockError = document.getElementById("stockError");
    
    if (stock.length > 4) {
        stockError.textContent = "El stock solo puede contener números enteros de hasta 4 dígitos.";
        this.value = stock.slice(0, 4);  // Limitar a 4 dígitos
    } else {
        stockError.textContent = "";
    }
});


document.getElementById("valor_impuesto").addEventListener("keypress", function(event) {
    // Obtener el código de la tecla presionada
    var charCode = event.which ? event.which : event.keyCode;

    // Permitir solo números (0-9)
    if (charCode < 48 || charCode > 57) {
        event.preventDefault();  // Bloquear el carácter si no es un número
    }
});

document.getElementById("valor_impuesto").addEventListener("input", function() {
    // Validar que el valor no tenga más de 2 dígitos
    var valorImpuesto = this.value;
    var precioError = document.getElementById("precioError2");
    
    if (valorImpuesto.length > 2) {
        precioError.textContent = "El impuesto solo puede contener números enteros de hasta 2 dígitos.";
        this.value = valorImpuesto.slice(0, 2);  // Limitar a 2 dígitos
    } else {
        precioError.textContent = "";
    }
});


document.getElementById('tipo_impuesto').addEventListener('change', function() {
    var tipoImpuesto = this.value;
    var valorImpuestoInput = document.getElementById('valor_impuesto');
    
    if (tipoImpuesto === 'sinImpuesto') {
        valorImpuestoInput.value = '0'; // Asigna un valor de '0'
        valorImpuestoInput.setAttribute('readonly', true); // Evita que el usuario edite el campo
    } else {
        valorImpuestoInput.value = ''; // Limpia el campo
        valorImpuestoInput.removeAttribute('readonly'); // Permite editar el campo
        valorImpuestoInput.setAttribute('required', 'required'); // Asegura que el campo sea obligatorio
    }
});

// Función para listar productos
// Función para listar productos, opcionalmente con un término de búsqueda
function ListarProductos(busqueda = "") {
    fetch("listar.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            busqueda: busqueda
        })
    })
    .then(response => response.text())
    .then(response => {
        document.getElementById('datos_productos').innerHTML = response;
    })
    .catch(error => {
        console.error('Error al listar productos:', error);
    });
}

// Carga todos los productos cuando la página se carga
document.addEventListener("DOMContentLoaded", function() {
    ListarProductos(); // Llama a la función sin términos de búsqueda para listar todos los productos
});

// Realiza la búsqueda cuando el usuario escribe en el campo de búsqueda
document.getElementById('buscar').addEventListener("keyup", function() {
    const valor = this.value.trim();
    ListarProductos(valor); // Llama a la función con el valor de búsqueda
});


// Evento para buscar productos cuando se escribe en el input
document.getElementById('buscar').addEventListener("keyup", function() {
    const valor = this.value.trim();
    ListarProductos(valor);
});

document.getElementById('buscar').addEventListener("keyup", function() {
    const valor = this.value.trim();
    ListarProductos(valor); // Llama a la función con el valor de búsqueda
});






// Función para listar inventario, opcionalmente con un término de búsqueda
// Función para listar inventario
function ListarInventario() {
    fetch("reporteInventario.php", {  // Asegúrate de que el nombre del archivo PHP sea listar_inventario.php
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    })
    .then(response => response.text())
    .then(response => {
        // Inserta el resultado HTML en el elemento con el id 'datos_inventario'
        const datosInventario = document.getElementById('datos_inventario');
        if (datosInventario) {
            datosInventario.innerHTML = response;
        } else {
            console.error('Elemento con ID "datos_inventario" no encontrado.');
        }
    })
    .catch(error => {
        console.error('Error al listar inventario:', error);
    });
}

// Carga todo el inventario cuando la página se carga
document.addEventListener("DOMContentLoaded", function() {
    ListarInventario(); // Llama a la función para listar todo el inventario
});











































