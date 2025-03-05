import React, { useContext } from 'react';
import { useNavigate } from 'react-router-dom';
import { AuthContext } from '../Context/AuthContext';

const Logout = () => {
    const { logout } = useContext(AuthContext);
    const navigate = useNavigate();

    React.useEffect(() => {
        logout();
        navigate('/login'); // Redirigir al login después del logout
    }, [logout, navigate]);

    return null; // No necesita renderizar nada
};

export default Logout;