import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

const Register = () => {
    const [formData, setFormData] = useState({
        firstName: '',
        lastName: '',
        birthDate: '',
        email: '',
        username: '',
        password: '',
        confirmPassword: '',
        acceptTerms: false,
    });

    const [errors, setErrors] = useState([]);
    const navigate = useNavigate();

    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;
        setFormData({
            ...formData,
            [name]: type === 'checkbox' ? checked : value,
        });
    };

    const validateForm = () => {
        const newErrors = [];

        // Validar nombre y apellido
        if (!/^[a-zA-ZñÑ ]+$/.test(formData.firstName)) {
            newErrors.push('El nombre solo puede contener caracteres alfabéticos, espacios y la ñ.');
        }
        if (!/^[a-zA-ZñÑ ]+$/.test(formData.lastName)) {
            newErrors.push('El apellido solo puede contener caracteres alfabéticos, espacios y la ñ.');
        }

        // Validar edad (entre 18 y 99 años)
        const today = new Date();
        const birthDate = new Date(formData.birthDate);
        const age = today.getFullYear() - birthDate.getFullYear();
        if (age < 18 || age > 99) {
            newErrors.push('Debes tener entre 18 y 99 años.');
        }

        // Validar correo electrónico
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
            newErrors.push('El formato del correo electrónico no es válido.');
        }

        // Validar nombre de usuario
        if (!/^[a-zA-Z0-9]+$/.test(formData.username)) {
            newErrors.push('El nombre de usuario solo puede contener caracteres alfanuméricos.');
        }

        // Validar contraseña
        if (formData.password.length < 8 || !/\d/.test(formData.password)) {
            newErrors.push('La contraseña debe tener al menos 8 caracteres y contener al menos un número.');
        }

        // Validar confirmación de contraseña
        if (formData.password !== formData.confirmPassword) {
            newErrors.push('Las contraseñas no coinciden.');
        }

        // Validar términos y condiciones
        if (!formData.acceptTerms) {
            newErrors.push('Debes aceptar los términos y condiciones.');
        }

        setErrors(newErrors);
        return newErrors.length === 0;
    };

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (!validateForm()) {
            return;
        }

        try {
            const response = await axios.post('http://localhost:3000/users/post', {
                first_name: formData.firstName,
                last_name: formData.lastName,
                email: formData.email,
                username: formData.username,
                password: formData.password,
                birth_date: formData.birthDate,
                role: 'customer',
            });

            if (response.status === 201) {
                alert('Registro exitoso. Por favor, inicia sesión.');
                navigate('/login');
            }
        } catch (error) {
            console.error('Error al registrar el usuario:', error);
            setErrors(['Error al registrar el usuario. Inténtalo de nuevo.']);
        }
    };

    return (
        <div className="container mt-5">
            <h2 className="text-center">Registro de Usuario</h2>
            <form onSubmit={handleSubmit} className="p-4 border rounded">
                {errors.length > 0 && (
                    <div className="alert alert-danger">
                        {errors.map((error, index) => (
                            <div key={index}>{error}</div>
                        ))}
                    </div>
                )}

                <div className="mb-3">
                    <label htmlFor="firstName" className="form-label">Nombre:</label>
                    <input
                        type="text"
                        id="firstName"
                        name="firstName"
                        className="form-control"
                        value={formData.firstName}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label htmlFor="lastName" className="form-label">Apellido:</label>
                    <input
                        type="text"
                        id="lastName"
                        name="lastName"
                        className="form-control"
                        value={formData.lastName}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label htmlFor="birthDate" className="form-label">Fecha de Nacimiento:</label>
                    <input
                        type="date"
                        id="birthDate"
                        name="birthDate"
                        className="form-control"
                        value={formData.birthDate}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label htmlFor="email" className="form-label">Correo Electrónico:</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        className="form-control"
                        value={formData.email}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label htmlFor="username" className="form-label">Nombre de Usuario:</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        className="form-control"
                        value={formData.username}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label htmlFor="password" className="form-label">Contraseña:</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        className="form-control"
                        value={formData.password}
                        onChange={handleChange}
                        required
                    />
                    <button
                        type="button"
                        className="btn btn-secondary btn-sm mt-2"
                        onClick={() => {
                            const passwordField = document.getElementById('password');
                            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
                        }}
                    >
                        Mostrar
                    </button>
                </div>

                <div className="mb-3">
                    <label htmlFor="confirmPassword" className="form-label">Repetir Contraseña:</label>
                    <input
                        type="password"
                        id="confirmPassword"
                        name="confirmPassword"
                        className="form-control"
                        value={formData.confirmPassword}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div className="mb-3 form-check">
                    <input
                        type="checkbox"
                        id="acceptTerms"
                        name="acceptTerms"
                        className="form-check-input"
                        checked={formData.acceptTerms}
                        onChange={handleChange}
                        required
                    />
                    <label htmlFor="acceptTerms" className="form-check-label">
                        Acepto los términos y condiciones
                    </label>
                </div>

                <button type="submit" className="btn btn-primary">Registrar</button>
            </form>
        </div>
    );
};

export default Register;