import { useState, useEffect } from "react";
import { Link } from "react-router-dom";

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap-icons/font/bootstrap-icons.css";

const Navbar = () => {
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  useEffect(() => {
    // Simulando autenticación (se puede conectar con el backend luego)
    const user = localStorage.getItem("user");
    setIsLoggedIn(!!user);
  }, []);

  return (
    <>
      {/* Imagen arriba de la barra de navegación */}
      <div className="text-center my-3">
        <img src="./img/logo1.png" alt="Banner" className="img-fluid" height={200}/>
      </div>

      <nav className="navbar navbar-expand-lg navbar-light bg-body border-bottom border-3 border-danger">
        <div className="container-fluid">
          <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span className="navbar-toggler-icon"></span>
          </button>

          <div className="collapse navbar-collapse" id="navbarNav">
            <ul className="navbar-nav me-auto mb-2 mb-lg-0 d-flex align-items-center">
              <li className="nav-item">
                <Link className="nav-link d-flex align-items-center" to="/">
                  <i className="bi bi-house-door fs-4"></i>
                </Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/about">¿Quiénes Somos?</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/catalog">Catálogo</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/offers">Ofertas</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link d-flex align-items-center gap-2" to="/cart">
                  <i className="bi bi-cart3"></i>
                  <span>Carrito</span>
                </Link>
              </li>
              <li className="nav-item dropdown">
                <Link className="nav-link dropdown-toggle d-flex align-items-center gap-2" to="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i className="bi bi-person-circle"></i>
                </Link>
                <ul className="dropdown-menu" aria-labelledby="navbarDropdown">
                  {isLoggedIn ? (
                    <li><Link className="dropdown-item" to="/logout">Cerrar sesión</Link></li>
                  ) : (
                    <>
                      <li><Link className="dropdown-item" to="/register">Registrarse</Link></li>
                      <li><Link className="dropdown-item" to="/login">Iniciar Sesión</Link></li>
                    </>
                  )}
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </>
  );
};

export default Navbar;
