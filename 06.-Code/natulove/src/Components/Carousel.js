import React from 'react';
import "./css/Carousel.css";

// Componente del carrusel
const Carousel = () => {
  return (
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/img/products.jpg" class="d-block w-100" width="350px" alt="..."/>
    </div>
    <div class="carousel-item">
      <img src="/img/buyOnline.jpg" class="d-block w-100" alt="..."/>
    </div>
    <div class="carousel-item">
      <img src="/img/chocolateBag.JPG" class="d-block w-100" alt="..."/>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
  );
};

export default Carousel;