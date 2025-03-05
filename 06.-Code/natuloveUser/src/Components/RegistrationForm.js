import React, { useState } from 'react';
import { Form, Button, Modal } from 'react-bootstrap';

const RegistrationForm = () => {
  const [formData, setFormData] = useState({
    nombres: '',
    cedula: '',
    telefono: '',
    email: '',
    usuario: '',
    contraseña: '',
    repetirContraseña: '',
    aceptaTerminos: false,
  });

  const [errors, setErrors] = useState({});
  const [showSuccessModal, setShowSuccessModal] = useState(false);

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData({
      ...formData,
      [name]: type === 'checkbox' ? checked : value,
    });
  };

  const validateForm = () => {
    const newErrors = {};
    const nombreRegex = /^[A-Za-zÑñ\s]+$/;
    const telefonoRegex = /^[0-9]{10}$/;
    const cedulaRegex = /^[0-9]{10}$/;
    const usuarioRegex = /^[A-Za-z0-9]+$/;
    const contraseñaRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$.!%*?&]).{9,}$/;

    if (!nombreRegex.test(formData.nombres)) {
      newErrors.nombres = 'El nombre solo puede contener letras, espacios y la letra Ñ';
    }

    if (!cedulaRegex.test(formData.cedula)) {
      newErrors.cedula = 'La cédula debe contener exactamente 10 dígitos numéricos';
    }

    if (!telefonoRegex.test(formData.telefono)) {
      newErrors.telefono = 'El teléfono debe contener exactamente 10 dígitos';
    }

    if (!usuarioRegex.test(formData.usuario)) {
      newErrors.usuario = 'El usuario solo puede contener caracteres alfanuméricos';
    }

    if (!contraseñaRegex.test(formData.contraseña)) {
      newErrors.contraseña = 'La contraseña debe tener más de 8 caracteres, incluyendo al menos una letra, un número y un carácter especial';
    }

    if (formData.contraseña !== formData.repetirContraseña) {
      newErrors.repetirContraseña = 'Las contraseñas no coinciden';
    }

    if (!formData.aceptaTerminos) {
      newErrors.aceptaTerminos = 'Debe aceptar los términos y condiciones';
    }

    setErrors(newErrors);

    return Object.keys(newErrors).length === 0; // Si no hay errores, el formulario es válido
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
          <Form.Label>Nombres</Form.Label>
          <Form.Control
            type="text"
            name="nombres"
            placeholder="Ingrese sus nombres"
            value={formData.nombres}
            onChange={handleChange}
            isInvalid={!!errors.nombres}
            required
          />
          {errors.nombres && <div className="text-danger">{errors.nombres}</div>}
        </Form.Group>

        <Form.Group className="mb-3" controlId="formCedula">
          <Form.Label>Cédula</Form.Label>
          <Form.Control
            type="text"
            name="cedula"
            placeholder="Ingrese su cédula"
            value={formData.cedula}
            onChange={handleChange}
            isInvalid={!!errors.cedula}
            required
          />
          {errors.cedula && <div className="text-danger">{errors.cedula}</div>}
        </Form.Group>

        <Form.Group className="mb-3" controlId="formTelefono">
          <Form.Label>Teléfono</Form.Label>
          <Form.Control
            type="tel"
            name="telefono"
            placeholder="Ingrese su número de teléfono"
            value={formData.telefono}
            onChange={handleChange}
            isInvalid={!!errors.telefono}
            required
          />
          {errors.telefono && <div className="text-danger">{errors.telefono}</div>}
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

        <Form.Group className="mb-3" controlId="formUsuario">
          <Form.Label>Usuario</Form.Label>
          <Form.Control
            type="text"
            name="usuario"
            placeholder="Ingrese un nombre de usuario"
            value={formData.usuario}
            onChange={handleChange}
            isInvalid={!!errors.usuario}
            required
          />
          {errors.usuario && <div className="text-danger">{errors.usuario}</div>}
        </Form.Group>

        <Form.Group className="mb-3" controlId="formContraseña">
          <Form.Label>Contraseña</Form.Label>
          <Form.Control
            type="password"
            name="contraseña"
            placeholder="Ingrese una contraseña"
            value={formData.contraseña}
            onChange={handleChange}
            isInvalid={!!errors.contraseña}
            required
          />
          {errors.contraseña && <div className="text-danger">{errors.contraseña}</div>}
        </Form.Group>

        <Form.Group className="mb-3" controlId="formRepetirContraseña">
          <Form.Label>Repetir Contraseña</Form.Label>
          <Form.Control
            type="password"
            name="repetirContraseña"
            placeholder="Repita la contraseña"
            value={formData.repetirContraseña}
            onChange={handleChange}
            isInvalid={!!errors.repetirContraseña}
            required
          />
          {errors.repetirContraseña && <div className="text-danger">{errors.repetirContraseña}</div>}
        </Form.Group>

        <Form.Group className="mb-3" controlId="formTerminos">
          <Form.Check
            type="checkbox"
            name="aceptaTerminos"
            label={
              <>
                Acepto los{' '}
                <a href="/terminos-y-condiciones" target="_blank" rel="noopener noreferrer">
                  Términos y Condiciones
                </a>
              </>
            }
            checked={formData.aceptaTerminos}
            onChange={handleChange}
            isInvalid={!!errors.aceptaTerminos}
            required
          />
          {errors.aceptaTerminos && <div className="text-danger">{errors.aceptaTerminos}</div>}
        </Form.Group>

        <Button variant="primary" type="submit" className="w-100">
          Registrarse
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

export default RegistrationForm;
