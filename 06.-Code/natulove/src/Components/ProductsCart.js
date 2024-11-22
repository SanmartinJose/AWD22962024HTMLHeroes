import React from 'react';
import { FaTrash } from 'react-icons/fa';
import './css/Cart.css';

export const ProductsCart = () => {
  return (
    <>
      <div className="card text-bg-primary mb-3" style={{ maxWidth: '70em' }}>
        <div className="card-header d-flex justify-content-between">
          <span>Aceite de Coco</span>
          <FaTrash />
        </div>
        <div className="card-body">
          <h5 className="card-title">Aceite de Coco Orgánico</h5>
          <p className="card-text">500ml de aceite de coco virgen extra, ideal para cocinar y cuidado personal.</p>
        </div>
      </div>
      <div className="card text-bg-secondary mb-3" style={{ maxWidth: '70em' }}>
        <div className="card-header d-flex justify-content-between">
          <span>Miel de Abeja</span>
          <FaTrash />
        </div>
        <div className="card-body">
          <h5 className="card-title">Miel de Abeja Pura</h5>
          <p className="card-text">Tarro de 1kg de miel de abeja 100% natural, sin aditivos ni conservantes.</p>
        </div>
      </div>
      <div className="card text-bg-success mb-3" style={{ maxWidth: '70em' }}>
        <div className="card-header d-flex justify-content-between">
          <span>Jabón de Aloe Vera</span>
          <FaTrash />
        </div>
        <div className="card-body">
          <h5 className="card-title">Jabón Artesanal de Aloe Vera</h5>
          <p className="card-text">Pastilla de 100g de jabón natural con extracto de aloe vera, ideal para pieles sensibles.</p>
        </div>
      </div>
      <div className="card text-bg-danger mb-3" style={{ maxWidth: '70em' }}>
        <div className="card-header d-flex justify-content-between">
          <span>Té Verde</span>
          <FaTrash />
        </div>
        <div className="card-body">
          <h5 className="card-title">Té Verde Orgánico</h5>
          <p className="card-text">Caja con 20 bolsitas de té verde orgánico, rico en antioxidantes.</p>
        </div>
      </div>
      <div className="card text-bg-warning mb-3" style={{ maxWidth: '70em' }}>
        <div className="card-header d-flex justify-content-between">
          <span>Quinoa</span>
          <FaTrash />
        </div>
        <div className="card-body">
          <h5 className="card-title">Quinoa Orgánica</h5>
          <p className="card-text">Paquete de 500g de quinoa orgánica, perfecta para ensaladas y platos saludables.</p>
        </div>
      </div>
      <div className="card text-bg-info mb-3" style={{ maxWidth: '70em' }}>
        <div className="card-header d-flex justify-content-between">
          <span>Aceite Esencial de Lavanda</span>
          <FaTrash />
        </div>
        <div className="card-body">
          <h5 className="card-title">Aceite Esencial de Lavanda</h5>
          <p className="card-text">Botella de 30ml de aceite esencial de lavanda, ideal para aromaterapia y relajación.</p>
        </div>
      </div>
    </>
  );
};
