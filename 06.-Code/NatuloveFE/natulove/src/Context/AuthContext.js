import React, { createContext, useState, useEffect } from 'react';
import axios from 'axios';

export const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState(null);

    // Verificar si el usuario está autenticado al cargar la aplicación
    useEffect(() => {
        const storedUser = localStorage.getItem('user');
        if (storedUser) {
            setUser(JSON.parse(storedUser));
        }
    }, []);

    // Función para iniciar sesión
    const login = async (email, password) => {
        try {
            const response = await axios.post('http://localhost:3000/users/login', { email, password });
            const userData = response.data;
            setUser(userData);
            localStorage.setItem('user', JSON.stringify(userData)); // Guardar usuario en localStorage
        } catch (error) {
            console.error('Error al iniciar sesión:', error);
            throw error;
        }
    };

    // Función para cerrar sesión
    const logout = () => {
        setUser(null);
        localStorage.removeItem('user'); // Eliminar usuario del localStorage
    };

    return (
        <AuthContext.Provider value={{ user, login, logout }}>
            {children}
        </AuthContext.Provider>
    );
};