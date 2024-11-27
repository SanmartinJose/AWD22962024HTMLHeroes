import React, { useState } from 'react';

const AddProduct = () => {
  // Estado para almacenar los valores del formulario
  const [nombre, setNombre] = useState('');
  const [descripcion, setDescripcion] = useState('');
  const [precioUnitario, setPrecioUnitario] = useState('');
  const [stock, setStock] = useState('');
  const [tipoImpuesto, setTipoImpuesto] = useState('');
  const [valorImpuesto, setValorImpuesto] = useState('');

  // Estado para almacenar mensajes de validación
  const [error, setError] = useState('');

  // Función para manejar el envío del formulario
  const handleSubmit = (event) => {
    event.preventDefault();

    // Validación de Nombre del Producto
    if (!/^[a-zA-ZÑñ\s]+$/.test(nombre)) {
      setError("El nombre del producto solo puede contener letras y espacios.");
      return;
    }

    // Validación de Descripción
    if (descripcion === "") {
      setError("La descripción no puede estar vacía.");
      return;
    }

    // Validación de Precio Unitario
    if (!/^\d+(\.\d{1,2})?$/.test(precioUnitario) || parseFloat(precioUnitario) <= 0) {
      setError("El precio unitario debe ser un número positivo con hasta 2 decimales.");
      return;
    }

    // Validación de Stock
    if (!/^\d+$/.test(stock) || parseInt(stock) <= 0) {
      setError("El stock debe ser un número entero positivo.");
      return;
    }

    // Validación de Tipo de Impuesto y Valor del IVA/RISE
    if ((tipoImpuesto === "iva" || tipoImpuesto === "ice") && (valorImpuesto === "" || isNaN(valorImpuesto) || parseFloat(valorImpuesto) <= 0)) {
      setError("Por favor, ingrese un valor válido para el impuesto.");
      return;
    }

    // Si todas las validaciones son correctas
    setError(''); // Limpiar cualquier mensaje de error
    alert("Formulario enviado correctamente.");
    // Aquí puedes manejar el envío real de los datos al backend o hacer cualquier otra acción
  };

  return (
    <div className="container my-5 p-4 bg-white shadow rounded">
      <h1 className="text-center mb-4">Registro de Producto</h1>
      <form onSubmit={handleSubmit}>
        <div className="row gy-3">
          {/* Primera columna */}
          <div className="col-md-3">
            <label htmlFor="nombre" className="form-label">Nombre del Producto:</label>
            <input
              type="text"
              name="nombre"
              id="nombre"
              className="form-control"
              value={nombre}
              onChange={(e) => setNombre(e.target.value)}
              required
            />
            <label htmlFor="descripcion" className="form-label mt-3">Descripción:</label>
            <textarea
              className="form-control"
              rows="1"
              id="descripcion"
              name="descripcion"
              value={descripcion}
              onChange={(e) => setDescripcion(e.target.value)}
              required
            ></textarea>
            <label htmlFor="precio_unitario" className="form-label mt-3">Precio Unitario:</label>
            <input
              type="text"
              name="precio_unitario"
              id="precio_unitario"
              className="form-control"
              value={precioUnitario}
              onChange={(e) => setPrecioUnitario(e.target.value)}
              required
            />
          </div>
          {/* Segunda columna */}
          <div className="col-md-4">
            <label htmlFor="categoria" className="form-label">Categoría del Producto:</label>
            <select
              className="form-select"
              id="categoria"
              name="categoria"
              required
            >
              <option disabled selected>Seleccione una categoría</option>
              <option value="cuidaoP">Cuidado de la piel</option>
            </select>
            <label htmlFor="stock" className="form-label mt-3">Stock:</label>
            <input
              type="text"
              name="stock"
              id="stock"
              className="form-control"
              value={stock}
              onChange={(e) => setStock(e.target.value)}
              required
            />
            <label htmlFor="estado" className="form-label mt-3">Estado:</label>
            <select
              className="form-select"
              id="estado"
              name="estado"
              required
            >
              <option disabled selected>Seleccione un estado</option>
              <option value="activo">Activo</option>
            </select>
          </div>
          {/* Tercera columna */}
          <div className="col-md-5">
            <label htmlFor="tipo_impuesto" className="form-label">Tipo de Impuesto:</label>
            <select
              className="form-select"
              id="tipo_impuesto"
              name="tipo_impuesto"
              value={tipoImpuesto}
              onChange={(e) => setTipoImpuesto(e.target.value)}
              required
            >
              <option value="" disabled selected>Seleccione un tipo de impuesto</option>
              <option value="sinImpuesto">Sin Impuesto</option>
              <option value="iva">IVA</option>
              <option value="ice">ICE</option>
            </select>
            <label htmlFor="valor_impuesto" className="form-label mt-3">Valor del IVA/RISE:</label>
            <input
              type="text"
              name="valor_impuesto"
              id="valor_impuesto"
              className="form-control"
              value={valorImpuesto}
              onChange={(e) => setValorImpuesto(e.target.value)}
            />
            <div className="d-grid mt-4">
              <button type="submit" className="btn btn-primary btn-lg">Enviar Datos</button>
            </div>
          </div>
        </div>
      </form>

      {/* Mensajes de Error */}
      {error && <div className="alert alert-danger mt-4">{error}</div>}
    </div>
  );
};

export default AddProduct;