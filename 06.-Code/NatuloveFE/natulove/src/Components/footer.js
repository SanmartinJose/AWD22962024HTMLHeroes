import React from 'react';
import { Link } from 'react-router-dom';
import logo from '../resources/img/logo.png';
import '../resources/css/footer.css'; // Importar el archivo CSS para el footer

const Footer = () => {
    return (
        <footer className="footer bg-black text-light py-4">
            <div className="container">
                <div className="row">

                    {/* Logo del equipo */}
                    <div className="col-md-2">
                        <img src={logo} alt="Develop Team Logo" className="img-fluid" />
                    </div>

                    {/* Enlaces */}
                    <div className="col-md-3">
                        <h5 className="text-uppercase">Enlaces</h5>
                        <ul className="list-unstyled">
                            <li><Link to="/" className="footer-link">Inicio</Link></li>
                            <li><Link to="/about-us" className="footer-link">¿Quiénes Somos?</Link></li>
                            <li><Link to="/catalog" className="footer-link">Productos</Link></li>
                            <li><a href="#contact" className="footer-link">Contactos</a></li>
                        </ul>
                    </div>

                    {/* Información de contacto */}
                    <div className="col-md-6">
                        <h5 className="text-uppercase">Contacta con nosotros</h5>
                        <ul className="list-unstyled">
                            <li>Email: <a href="mailto:support@natulove.com" className="footer-link">support@natulove.com</a></li>
                            <li>Teléfono: +593 992536817</li>
                            <li>Dirección: San Carlos, Quito, Ecuador</li>
                        </ul>
                    </div>
                </div>

                {/* Derechos de autor */}
                <small>&copy; 2024 Natulove. All Rights Reserved.</small>
            </div>
        </footer>
    );
};

export default Footer;