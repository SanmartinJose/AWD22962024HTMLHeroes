import React from 'react';

const ProductsIndex = () => {
  return (
    <div class="container my-5">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
      <div class="card">
        <img src="/img/chocolateBag.jpg" class="card-img-top" alt="..." height="300px" /> 
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="btn btn-warning">See more</a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <img src="/img/flowers1.jpg" class="card-img-top" alt="..." height="300px"/>
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="btn btn-warning">See more</a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <img src="/img/roses2.png" class="card-img-top" alt="..." height="300px"/> 
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="btn btn-warning">See more</a>
        </div>
      </div>
    </div>
  </div>
</div>

   
  );
};

export default ProductsIndex;



