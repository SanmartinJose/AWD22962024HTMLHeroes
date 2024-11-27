import React from 'react';
import { FaTrash } from 'react-icons/fa';
import './css/Cart.css';

export const ProductsCart = () => {
  return (
    <>
      <div className="container mt-5">
        <h2>Carrito de Compras</h2>
        <form>
        <table className="table table-bordered">
          <thead>
            <tr>
              <th>Cantidad</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr className="spacing-row">
              <td> <input type="number" className="form-control" defaultValue="1" min="1" /></td>
              <td>Aceite de Coco Orgánico 500ml</td>
              <td>$10.00</td>
              <td>
                <button className="btn btn-danger btn-sm">
                  Eliminar
                </button>
              </td>
            </tr>
            <tr className="spacing-row">
            <td> <input type="number" className="form-control" defaultValue="1" min="1" /></td>
              <td>Miel de Abeja Pura 1kg</td>
              <td>$15.00</td>
              <td>
                <button className="btn btn-danger btn-sm">
                  Eliminar
                </button>
              </td>
            </tr>
            <tr className="spacing-row">
            <td> <input type="number" className="form-control" defaultValue="1" min="1" /></td>
              <td>Jabón Artesanal de Aloe Vera 100g</td>
              <td>$5.00</td>
              <td>
                <button className="btn btn-danger btn-sm">
                  Eliminar
                </button>
              </td>
            </tr>
            <tr className="spacing-row">
            <td> <input type="number" className="form-control" defaultValue="1" min="1" /></td>
              <td>Té Verde Orgánico Caja con 20 bolsitas</td>
              <td>$8.00</td>
              <td>
                <button className="btn btn-danger btn-sm">
                  Eliminar
                </button>
              </td>
            </tr>
            <tr className="spacing-row">
            <td> <input type="number" className="form-control" defaultValue="1" min="1" /></td>
              <td>Quinoa Orgánica 500g</td>
              <td>$12.00</td>
              <td>
                <button className="btn btn-danger btn-sm">
                  Eliminar
                </button>
              </td>
            </tr>
            <tr className="spacing-row">
            <td> <input type="number" className="form-control" defaultValue="1" min="1" /></td>
              <td>Aceite Esencial de Lavanda 30ml</td>
              <td>$7.00</td>
              <td>
                <button className="btn btn-danger btn-sm">
                  Eliminar
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        </form>
      </div>
    </>
  );
};
