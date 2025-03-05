import React from 'react';

// Componente del carrusel
const Carousel = () => {
  return (
    
    <div className="d-flex justify-content-center">
      <div id="carouselExampleAutoplaying" className="carousel slide" data-bs-ride="carousel">
        <div className="carousel-inner">
          <div className="carousel-item active">
            <img src="/img/products.jpg" className="d-block mx-auto" width="800" height="400" alt="..." />
          </div>
          <div className="carousel-item">
            <img src="/img/buyOnline.jpg" className="d-block mx-auto" width="800" height="400" alt="..." />
          </div>
          <div className="carousel-item">
            <img src="/img/chocolateBag.JPG" className="d-block mx-auto" width="800" height="400" alt="..." />
          </div>
        </div>
        <button className="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span className="carousel-control-prev-icon" aria-hidden="true"></span>
          <span className="visually-hidden">Previous</span>
        </button>
        <button className="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span className="carousel-control-next-icon" aria-hidden="true"></span>
          <span className="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  );
};

export default Carousel;

