import React, { useState } from 'react';
import { Form, Button, Modal } from 'react-bootstrap';

const ClientForm = () => {
  const [formData, setFormData] = useState({
    apellido: '',
    nombre: '',
    cedula: '',
    telefono: '',
    email: '',
  });

  const [showSuccessModal, setShowSuccessModal] = useState(false);

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData({
      ...formData,
      [name]: type === 'checkbox' ? checked : value,
    });
  };

  const validateForm = () => {
    const nombreapellidoRegex = /^[A-Za-zÑñ\s]+$/;
    const telefonoRegex = /^[0-9]{10}$/;
    const cedulaRegex = /^[0-9]{10}$/; // Asume que una cédula válida tiene 10 dígitos
    
    if (!nombreapellidoRegex.test(formData.apellido)) {
        alert('El apellido solo puede contener letras, espacios y la letra Ñ');
        return false;
    }

    if (!nombreapellidoRegex.test(formData.nombre)) {
      alert('El nombre solo puede contener letras, espacios y la letra Ñ');
      return false;
    }
  
    if (!cedulaRegex.test(formData.cedula)) {
      alert('La cédula debe contener exactamente 10 dígitos numéricos');
      return false;
    }
  
    if (!telefonoRegex.test(formData.telefono)) {
      alert('El teléfono debe contener exactamente 10 dígitos');
      return false;
    }
  
    return true;
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (validateForm()) {
      setShowSuccessModal(true);
    }
  };

  return (
    <div className="container mt-5">
      <h2 className="text-center mb-4">Formulario de Registro</h2>
      <Form onSubmit={handleSubmit}>
        
        <Form.Group className="mb-3" controlId="formNombres">
          <Form.Label>Apellido</Form.Label>
          <Form.Control
            type="text"
            name="apellido"
            placeholder="Ingrese sus Apellido"
            value={formData.apellido}
            onChange={handleChange}
            required
          />
        </Form.Group>

        <Form.Group className="mb-3" controlId="formNombres">
          <Form.Label>Nombre</Form.Label>
          <Form.Control
            type="text"
            name="nombre"
            placeholder="Ingrese sus nombres"
            value={formData.nombre}
            onChange={handleChange}
            required
          />
        </Form.Group>

        <Form.Group className="mb-3" controlId="formCedula">
          <Form.Label>Cédula</Form.Label>
          <Form.Control
            type="text"
            name="cedula"
            placeholder="Ingrese su cédula"
            value={formData.cedula}
            onChange={handleChange}
            required
          />
        </Form.Group>

        <Form.Group className="mb-3" controlId="formTelefono">
          <Form.Label>Teléfono</Form.Label>
          <Form.Control
            type="tel"
            name="telefono"
            placeholder="Ingrese su número de teléfono"
            value={formData.telefono}
            onChange={handleChange}
            required
          />
        </Form.Group>

        <Form.Group className="mb-3" controlId="formEmail">
          <Form.Label>Email</Form.Label>
          <Form.Control
            type="email"
            name="email"
            placeholder="Ingrese su email"
            value={formData.email}
            onChange={handleChange}
            required
          />
        </Form.Group>

        <Button variant="primary" type="submit" className="w-100">
          Registrar
        </Button>
      </Form>

      {/* Modal de éxito */}
      <Modal show={showSuccessModal} onHide={() => setShowSuccessModal(false)} centered>
        <Modal.Header closeButton>
          <Modal.Title>Registro Exitoso</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <p>¡Su registro se ha realizado con éxito!</p>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="success" onClick={() => setShowSuccessModal(false)}>
            Aceptar
          </Button>
        </Modal.Footer>
      </Modal>
    </div>
  );
};

export default ClientForm;
