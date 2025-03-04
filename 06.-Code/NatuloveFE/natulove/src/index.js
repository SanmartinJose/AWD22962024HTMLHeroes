import React from 'react';
import { createRoot } from 'react-dom/client'; // Importa createRoot desde react-dom/client
import App from './App';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';

// Selecciona el elemento raíz de tu aplicación
const container = document.getElementById('root');

// Crea una raíz para tu aplicación
const root = createRoot(container);

// Renderiza la aplicación dentro de la raíz
root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);