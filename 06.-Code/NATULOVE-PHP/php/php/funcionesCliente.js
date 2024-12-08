
function ListarProductos(busqueda = "") {
    fetch("listarC.php", {
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

document.getElementById('frm').addEventListener("submit", function(event) {
    event.preventDefault();  
    fetch("registrarC.php", {
        method: "POST",
        body: new FormData(document.getElementById('frm'))
    })
    .then(response => response.text())
    .then(response => {
        if (response.trim() === "ok") {
            Swal.fire({
                icon: 'success',
                title: "Producto registrado con éxito!",
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: "Producto registrado con éxito!",
                showConfirmButton: false,
                
            });
        }
        document.getElementById('frm').reset();  
        ListarProductos(); 
		ListarInventario();
        resetButton(); 
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: "success",
            title: "Producto registrado con éxito!",
           
        });
    });
});



function Eliminar(id, estadoActual) {
    // Determinar el nuevo estado
    const nuevoEstado = estadoActual === 'activo' ? 'inactivo' : 'activo';

    // Enviar la solicitud al servidor
    fetch('eliminarC.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id, estado: nuevoEstado })
    })
    .then(response => response.text())
    .then(response => {
        if (response === 'ok') {
            Swal.fire({
                icon: 'success',
                title: 'Estado cambiado con éxito',
                showConfirmButton: false,
                timer: 1500
            });
            location.reload(); // Recargar la página para ver el cambio
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Error',
                text: 'No se pudo cambiar el estado.'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'success',
            title: 'Error',
            text: 'Ocurrió un error durante la solicitud.'
        });
    });
}


function Editar(id) {
    fetch("editarC.php", {
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
            document.getElementById('idp').value = response.ID_CLIENTE || '';
            document.getElementById('nombre').value = response.NOMBRE_CLIENTE || '';
            document.getElementById('cedula').value = response.CEDULA || '';
            document.getElementById('telefono').value = response.TELEFONO || '';
            document.getElementById('email').value = response.EMAIL || '';
            document.getElementById('direccion').value = response.DIRECCION || '';

            // Selecciona el estado adecuado
            document.getElementById('estado').value = response.ESTADO || 'activo';

            document.getElementById('registrar').value = 'Actualizar';
        } else {
            alert("Error: No se encontraron los datos del cliente.");
        }
    })
    .catch(error => {
        console.error('Error al editar el cliente:', error);
        alert("Hubo un problema al cargar los datos del cliente. Por favor, intenta nuevamente.");
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
    fetch("listarC.php", {
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



function verificarCedulaUnica() {
    const cedulaInput = document.getElementById('cedula');
    const cedulaError = document.getElementById('cedulaError');
    const cedula = cedulaInput.value;

    // Solo continuar si la cédula tiene 10 dígitos
    if (cedula.length !== 10) {
        cedulaError.textContent = 'La cédula debe tener 10 dígitos.';
        return;
    }

    // Enviar la cédula al servidor para verificar si ya existe
    fetch("verificarCedula.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            cedula: cedula
        })
    })
    .then(response => response.text())
    .then(response => {
        if (response.trim() === "existe") {
            cedulaError.textContent = 'Esta cédula ya está registrada.';
            cedulaInput.setCustomValidity("Cédula duplicada"); // Bloquea el envío del formulario
        } else if (response.trim() === "no_existe") {
            cedulaError.textContent = ''; // Limpiar el mensaje de error si no existe
            cedulaInput.setCustomValidity(""); // Permite el envío del formulario
        } else {
            cedulaError.textContent = 'Error en la verificación de la cédula.';
        }
    })
    .catch(error => {
        console.error('Error al verificar la cédula:', error);
        cedulaError.textContent = 'Error al verificar la cédula.';
    });
}





function validarNombre() {
    const nombreInput = document.getElementById('nombre');
    const nombreError = document.getElementById('nombreError');
    
    // Expresión regular para permitir solo letras (mayúsculas y minúsculas) y espacios
    const regex = /^[a-zA-Z\s]*$/;

    if (!regex.test(nombreInput.value)) {
        nombreError.textContent = 'Por favor, ingrese solo letras.';
        nombreInput.value = nombreInput.value.replace(/[^a-zA-Z\s]/g, ''); // Remueve caracteres no permitidos
    } else {
        nombreError.textContent = ''; // Limpia el mensaje de error si la entrada es válida
    }
}
function validarCedula() {
    const cedulaInput = document.getElementById('cedula');
    const cedulaError = document.getElementById('cedulaError');
    let cedula = cedulaInput.value;

    // Remover cualquier carácter que no sea un número
    cedula = cedula.replace(/[^0-9]/g, '');
    cedulaInput.value = cedula;

    // Verifica que la cédula tenga exactamente 10 dígitos
    if (cedula.length !== 10) {
        cedulaError.textContent = 'La cédula debe tener 10 dígitos.';
        return false;
    }

    // Extraer el código de provincia (los dos primeros dígitos)
    const provincia = parseInt(cedula.substring(0, 2), 10);

    // Verifica que el código de provincia esté en el rango válido
    if (provincia < 1 || provincia > 24) {
        cedulaError.textContent = 'El código de provincia es inválido.';
        return false;
    }

    // Obtener el dígito verificador (el último dígito)
    const digitoVerificador = parseInt(cedula.charAt(9), 10);
    let suma = 0;

    // Aplicar el algoritmo de validación
    for (let i = 0; i < 9; i++) {
        let num = parseInt(cedula.charAt(i), 10);
        if (i % 2 === 0) {
            num *= 2;
            if (num > 9) num -= 9;
        }
        suma += num;
    }

    const residuo = suma % 10;
    const resultado = residuo === 0 ? 0 : 10 - residuo;

    // Verifica que el resultado coincida con el dígito verificador
    if (resultado !== digitoVerificador) {
        cedulaError.textContent = 'Cédula inválida.';
        return false;
    }

    // Si todo está correcto, limpiar el mensaje de error
    cedulaError.textContent = '';
    return true;
}

function validarTelefono() {
    const telefonoInput = document.getElementById('telefono');
    const telefonoError = document.getElementById('telefonoError');
    let telefono = telefonoInput.value;

    // Remover cualquier carácter que no sea un número
    telefono = telefono.replace(/[^0-9]/g, '');
    telefonoInput.value = telefono;

    // Verificar la longitud del número de teléfono
    if (telefono.length !== 10) {
        telefonoError.textContent = 'El teléfono debe tener exactamente 10 dígitos.';
    } else {
        telefonoError.textContent = ''; // Limpiar el mensaje de error si la longitud es correcta
    }
}

function validarEmail() {
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('emailError');
    const email = emailInput.value;

    // Expresión regular para validar que solo se permiten letras, números, un @ y al menos un punto.
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!regex.test(email)) {
        emailError.textContent = 'El correo solo puede contener letras, números, @ y un punto.';
    } else {
        emailError.textContent = ''; // Limpia el mensaje de error si el correo es válido
    }
}


function validarDireccion() {
    const direccionInput = document.getElementById('direccion');
    const direccionError = document.getElementById('direccionError');
    let direccion = direccionInput.value;

    // Remover cualquier carácter que no sea letra, número o espacio
    direccion = direccion.replace(/[^a-zA-Z0-9\s]/g, '');
    direccionInput.value = direccion;

    // Verificar si la dirección contiene caracteres inválidos
    if (/[^a-zA-Z0-9\s]/.test(direccion)) {
        direccionError.textContent = 'La dirección solo puede contener letras y números.';
    } else {
        direccionError.textContent = ''; // Limpiar el mensaje de error si la entrada es válida
    }
}



































