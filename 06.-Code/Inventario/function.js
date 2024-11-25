document.getElementById("frm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita el envío del formulario si hay errores

    const nombre = document.getElementById("nombre").value.trim();
    const descripcion = document.getElementById("descripcion").value.trim();
    const precioUnitario = document.getElementById("precio_unitario").value.trim();
    const stock = document.getElementById("stock").value.trim();
    const tipoImpuesto = document.getElementById("tipo_impuesto").value;
    const valorImpuesto = document.getElementById("valor_impuesto").value.trim();

    // Validación de Nombre del Producto
    if (!/^[a-zA-ZÑñ\s]+$/.test(nombre)) {
        alert("El nombre del producto solo puede contener letras y espacios.");
        return;
    }

    // Validación de Descripción
    if (descripcion === "") {
        alert("La descripción no puede estar vacía.");
        return;
    }

    // Validación de Precio Unitario
    if (!/^\d+(\.\d{1,2})?$/.test(precioUnitario) || parseFloat(precioUnitario) <= 0) {
        alert("El precio unitario debe ser un número positivo con hasta 2 decimales.");
        return;
    }

    // Validación de Stock
    if (!/^\d+$/.test(stock) || parseInt(stock) <= 0) {
        alert("El stock debe ser un número entero positivo.");
        return;
    }

    // Validación de Tipo de Impuesto y Valor del IVA/RISE
    if ((tipoImpuesto === "iva" || tipoImpuesto === "ice") && (valorImpuesto === "" || isNaN(valorImpuesto) || parseFloat(valorImpuesto) <= 0)) {
        alert("Por favor, ingrese un valor válido para el impuesto.");
        return;
    }

    // Si todas las validaciones son correctas
    alert("Formulario enviado correctamente.");
    this.submit(); // Envía el formulario
});
