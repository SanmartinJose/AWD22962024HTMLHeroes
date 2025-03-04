import React, { useState, useEffect, useContext } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import ProductCard from '../Components/ProductCard';
import Pagination from '../Components/Pagination';
import { CartContext } from '../Context/CartContext';

const Catalog = () => {
    const [products, setProducts] = useState([]);
    const [categories, setCategories] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState('');
    const [searchTerm, setSearchTerm] = useState('');
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);
    const { addToCart } = useContext(CartContext);

    // Función para obtener productos desde la API
    const fetchProducts = async () => {
        try {
            const response = await axios.get('http://localhost:3000/products', {
                params: {
                    category: selectedCategory,
                    search: searchTerm,
                    page: currentPage,
                    limit: 6,
                },
            });
            setProducts(response.data);
            setTotalPages(Math.ceil(response.data.length / 6)); // Calcular el total de páginas
        } catch (error) {
            console.error('Error fetching products:', error);
        }
    };

    // Función para obtener categorías desde la API
    const fetchCategories = async () => {
        try {
            const response = await axios.get('http://localhost:3000/products/categories');
            setCategories(response.data);
        } catch (error) {
            console.error('Error fetching categories:', error);
        }
    };

    useEffect(() => {
        fetchProducts();
        fetchCategories();
    }, [selectedCategory, searchTerm, currentPage]);

    return (
        <div className="container my-5">
            <h1 className="text-center mb-4">NatuLove Productos con Amor</h1>
            <div className="row">
                <div className="col-md-3">
                    <h5>Categorías</h5>
                    <div className="list-group">
                        <button
                            className={`list-group-item list-group-item-action ${!selectedCategory ? 'active' : ''}`}
                            onClick={() => setSelectedCategory('')}
                        >
                            Todas
                        </button>
                        {categories.map((category) => (
                            <button
                                key={category}
                                className={`list-group-item list-group-item-action ${selectedCategory === category ? 'active' : ''}`}
                                onClick={() => setSelectedCategory(category)}
                            >
                                {category}
                            </button>
                        ))}
                    </div>
                    <form
                        className="mt-3"
                        onSubmit={(e) => {
                            e.preventDefault();
                            setCurrentPage(1);
                        }}
                    >
                        <input
                            type="text"
                            className="form-control"
                            placeholder="Buscar producto..."
                            value={searchTerm}
                            onChange={(e) => setSearchTerm(e.target.value)}
                        />
                        <button type="submit" className="btn btn-primary mt-2">
                            Buscar
                        </button>
                    </form>
                </div>
                <div className="col-md-9">
                    <div className="row row-cols-1 row-cols-md-3 g-4">
                        {products.map((product) => (
                            <ProductCard
                                key={product.id}
                                product={product}
                                addToCart={addToCart}
                            />
                        ))}
                    </div>
                    <Pagination
                        currentPage={currentPage}
                        totalPages={totalPages}
                        onPageChange={setCurrentPage}
                    />
                </div>
            </div>
        </div>
    );
};

export default Catalog;