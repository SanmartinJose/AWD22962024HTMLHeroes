import React, { useContext, useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';
import { CartContext } from '../Context/CartContext';

const Cart = () => {
    const { cart, updateQuantity, removeFromCart } = useContext(CartContext);
    const [products, setProducts] = useState([]);

    // Función para obtener los detalles de los productos en el carrito
    const fetchProducts = async () => {
        const productIds = Object.keys(cart);
        if (productIds.length > 0) {
            try {
                const response = await axios.get('http://localhost:3000/products', {
                    params: { ids: productIds.join(',') },
                });
                setProducts(response.data);
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        }
    };

    useEffect(() => {
        fetchProducts();
    }, [cart]);

    // Calcular el total del carrito
    const total = products.reduce((acc, product) => {
        return acc + parseFloat(product.price) * cart[product.id];
    }, 0);

    return (
        <div className="container mt-5">
            {products.length === 0 ? (
                <div className="text-center">
                    <h1>El carrito está vacío. ¡Compremos algo! ;)</h1>
                    <img src="/img/carrito.png" alt="Carrito vacío" className="img-fluid" />
                    <Link to="/catalog" className="btn btn-primary mt-3">
                        Volver al catálogo
                    </Link>
                </div>
            ) : (
                <>
                    <h2 className="text-center">Carrito de Compras</h2>
                    <table className="table table-bordered table-striped table-sm mx-auto" style={{ maxWidth: '800px' }}>
                        <thead className="thead-dark">
                            <tr>
                                <th>Nombre del Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            {products.map((product) => (
                                <tr key={product.id}>
                                    <td>{product.name}</td>
                                    <td>${product.price}</td>
                                    <td>
                                        <input
                                            type="number"
                                            value={cart[product.id]}
                                            min="0"
                                            onChange={(e) =>
                                                updateQuantity(product.id, parseInt(e.target.value))
                                            }
                                            className="form-control form-control-sm"
                                            style={{ width: '80px' }}
                                        />
                                    </td>
                                    <td>${(parseFloat(product.price) * cart[product.id]).toFixed(2)}</td>
                                    <td>
                                        <button
                                            className="btn btn-danger btn-sm"
                                            onClick={() => removeFromCart(product.id)}
                                        >
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                    <div className="text-center">
                        <h4>Total: ${total.toFixed(2)}</h4>
                        <Link to="/catalog" className="btn btn-secondary me-2">
                            Volver al catálogo
                        </Link>
                        <Link to="/checkout" className="btn btn-primary">
                            Proceder al pago
                        </Link>
                    </div>
                </>
            )}
        </div>
    );
};

export default Cart;