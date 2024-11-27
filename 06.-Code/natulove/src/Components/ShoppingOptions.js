import React from 'react';
import { Link } from 'react-router-dom';

const ShoppingOptions = () => {
  // Lista de productos para renderizar dinámicamente
  const products = [
    { img: "/img/pistacho.png", title: "Pistachios", price: "$4.50" },
    { img: "/img/almonds.png", title: "Almonds", price: "$5.00" },
    { img: "/img/paprika.png", title: "Paprika", price: "$2.50" },
    { img: "/img/chocolates2.png", title: "Chocolates", price: "$6.50" },
    { img: "/img/redroses.png", title: "Eternal Roses", price: "$10.50" },
    { img: "/img/roses.png", title: "Box of Roses", price: "$15.00" },
    
  ];

  return (
    <div className="container my-5">
      <h1 className="display-4 mb-3 text-danger">NatuLove Products Specialized in Love</h1>
      <div className="row row-cols-1 row-cols-md-3 g-4">
        {products.map((product, index) => (
          <div className="col" key={index}>
            <div className="card h-100">
              {/* Imagen del producto */}
              <img
                src={product.img}
                className="card-img-top"
                alt={product.title}
                height="200px"
              />
              <div className="card-body d-flex flex-column">
                {/* Título y precio */}
                <h5 className="card-title">{product.title}</h5>
                <p className="card-text">{product.price}</p>
                {/* Botones: "Add to Cart" y "More Info" */}
                <div className="mt-auto d-flex justify-content-around">
                  <button className="btn btn-danger">Add to Cart</button>
                  <Link className="btn btn-info" to="/EternalFlower">
                    More Info
                  </Link>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default ShoppingOptions;