import React from 'react';
import { Link } from 'react-router-dom';

const ProductCard = ({ product, addToCart }) => {
    const { id, name, price, images } = product;
    const image = images && images.length > 0 ? images[0] : '/img/logo.png';

    return (
        <div className="col">
            <div className="card h-100">
                <img src={image} className="card-img-top" alt={name} height="200px" />
                <div className="card-body d-flex flex-column">
                    <h5 className="card-title">{name}</h5>
                    <p className="card-text">${price}</p>
                    <div className="mt-auto d-flex justify-content-around">
                        <button
                            className="btn btn-success"
                            onClick={() => addToCart(id)}
                        >
                            Agregar a Carrito
                        </button>
                    </div>
                    <Link to={`/product/${id}`} className="btn btn-primary mt-2">
                        Más Info
                    </Link>
                </div>
            </div>
        </div>
    );
};

export default ProductCard;