import React, { useState } from 'react';
import { Form, Button } from 'react-bootstrap';

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

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData({
      ...formData,
      [name]: type === 'checkbox' ? checked : value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (formData.contraseña !== formData.repetirContraseña) {
      alert('Las contraseñas no coinciden');
      return;
    }
    if (!formData.aceptaTerminos) {
      alert('Debe aceptar los términos y condiciones');
      return;
    }
    console.log('Datos enviados:', formData);
    alert('Registro exitoso');
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

        <Form.Group className="mb-3" controlId="formUsuario">
          <Form.Label>Usuario</Form.Label>
          <Form.Control
            type="text"
            name="usuario"
            placeholder="Ingrese un nombre de usuario"
            value={formData.usuario}
            onChange={handleChange}
            required
          />
        </Form.Group>

        <Form.Group className="mb-3" controlId="formContraseña">
          <Form.Label>Contraseña</Form.Label>
          <Form.Control
            type="password"
            name="contraseña"
            placeholder="Ingrese una contraseña"
            value={formData.contraseña}
            onChange={handleChange}
            required
          />
        </Form.Group>

        <Form.Group className="mb-3" controlId="formRepetirContraseña">
          <Form.Label>Repetir Contraseña</Form.Label>
          <Form.Control
            type="password"
            name="repetirContraseña"
            placeholder="Repita la contraseña"
            value={formData.repetirContraseña}
            onChange={handleChange}
            required
          />
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
            required
          />
        </Form.Group>

        <Button variant="primary" type="submit" className="w-100">
          Registrarse
        </Button>
      </Form>
    </div>
  );
};

export default RegistrationForm;
