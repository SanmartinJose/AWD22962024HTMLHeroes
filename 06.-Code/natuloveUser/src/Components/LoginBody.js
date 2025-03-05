import React from "react";
import "./css/Login.css";

const LoginBody = () => {

  const handleLogin = (e) => {
    e.preventDefault();
    console.log("Inicio de sesión exitoso");
  };


  return (
    <div className="loginBackground">
      <div className="loginContainer">
        <h2>Inicia sesión</h2>
        <form onSubmit={handleLogin}>
          <label htmlFor="username">Usuario:</label>
          <input
            type="text"
            id="username"
            name="username"
            placeholder="Ingresa usuario"
            required
          />

          <label htmlFor="password">Contraseña:</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Ingresa contraseña"
            required
          />

          <button type="submit" className="loginButton">Ingresar</button>
        </form>
      </div>
    </div>
  );
};

export default LoginBody;

