import React from 'react';

const Footer = () => {
  // Define el comportamiento para la dirección
  const currentPage = window.location.pathname.split('/').pop();
  const direction = currentPage === 'index.php' ? '' : '../';

  return (
    <footer className="footer bg-black text-light py-4">
      <div className="container">
        <div className="row">
          <div className="col-md-2">
            <img
              src={`${direction}img/LogoTeam.png`}
              alt="Develop Team Logo"
              className="img-fluid"
            />
          </div>

          <div className="col-md-3">
            <h5 className="text-uppercase">Enlaces</h5>
            <ul className="list-unstyled">
              <li><a href={`${direction}index.php`} className="footer-link">Inicio</a></li>
              <li><a href={`${direction}php/aboutUs.php`} className="footer-link">¿Quiénes Somos?</a></li>
              <li><a href={`${direction}php/catalogPro.php`} className="footer-link">Productos</a></li>
              <li><a href="#contact" className="footer-link">Contactos</a></li>
            </ul>
          </div>

          <div className="col-md-6">
            <h5 className="text-uppercase">Contacta con nosotros</h5>
            <ul className="list-unstyled">
              <li>Email: <a href="mailto:support@natulove.com" className="footer-link">support@natulove.com</a></li>
              <li>Telefono: +593 992536817</li>
              <li>Dirección: San Carlos, Quito, Ecuador</li>
            </ul>
          </div>
        </div>
        <small>&copy; 2024 Natulove. All Rights Reserved.</small>
      </div>
    </footer>
  );
}

export default Footer;
