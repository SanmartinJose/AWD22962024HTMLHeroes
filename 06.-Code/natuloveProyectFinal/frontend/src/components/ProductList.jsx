import { useEffect, useState } from 'react';
import axios from 'axios';

const ProductList = () => {
    const [products, setProducts] = useState([]);

    useEffect(() => {
        axios.get('http://localhost:5000/api/products')
            .then(response => setProducts(response.data))
            .catch(error => console.error('Error:', error));
    }, []);

    return (
        <div className="container my-5">
            <h1 className="text-center">Productos Destacados</h1>
            <div className="row">
                {products.map(product => (
                    <div className="col-md-4" key={product.id}>
                        <div className="card">
                            <img src={product.image} className="card-img-top" alt={product.name} height="300px" />
                            <div className="card-body">
                                <h5 className="card-title">{product.name}</h5>
                                <p className="card-text">{product.description}</p>
                                <button className="btn btn-warning">Ver más</button>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default ProductList;
