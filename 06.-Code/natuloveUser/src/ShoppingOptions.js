import React from 'react';
import { Link } from 'react-router-dom';

const ShoppingOptions = () => {
  // List of products to render dynamically
  const products = [
    { img: "/img/pistacho.png", title: "Pistachios", price: "$4.50", link: "/EternalFlower" },
    { img: "/img/almonds.png", title: "Almonds", price: "$5.00", link: "/Granola" },
    { img: "/img/paprika.png", title: "Paprika", price: "$2.50", link: "/Granola" },
    { img: "/img/chocolates2.png", title: "Chocolates", price: "$6.50", link: "/Granola" },
    { img: "/img/redroses.png", title: "Eternal Roses", price: "$10.50", link: "/EternalFlower" },
    { img: "/img/granola3.jpg", title: "Granola", price: "$5.00", link: "/Granola" },
  ];

  return (
    <div className="container my-5">
      <h1 className="display-4 mb-3 text-danger">NatuLove Products Specialized in Love</h1>
      <div className="row row-cols-1 row-cols-md-3 g-4">
        {products.map((product, index) => (
          <div className="col" key={index}>
            <div className="card h-100">
              {/* Product Image */}
              <img
                src={product.img}
                className="card-img-top"
                alt={product.title}
                height="200px"
              />
              <div className="card-body d-flex flex-column">
                <h5 className="card-title">{product.title}</h5>
                <p className="card-text">{product.price}</p>
                <div className="mt-auto d-flex justify-content-around">
                  <button className="btn btn-danger">Add to Cart</button>
                  <Link className="btn btn-info" to={product.link}>
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
