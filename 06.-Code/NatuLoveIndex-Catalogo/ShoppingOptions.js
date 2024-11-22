import React from 'react';

const ShoppingOptions = () => {
  return (
    <div className="container my-5">
      <h1 className="display-4 mb-3 text-danger">NatuLove products specialized in love </h1>

      <div className="row row-cols-1 row-cols-md-3 g-4">
        <div className="col">
          <div className="card">
            <img src="/img/pistacho.png" className="card-img-top" alt="..."  height=" 200px "/>
            <div className="card-body">
              <h5 className="card-title">Pistachios</h5>
              <p className="card-text">$4.50 </p>
              <div className="d-flex justify-content-center">
                <a href="#" className="btn btn-danger">Add Car</a>
              </div>
            </div>
          </div>
        </div>

        <div className="col">
          <div className="card">
          <img src="/img/almonds.png" className="card-img-top" alt="..."  height=" 200px "/>
            <div className="card-body">
              <h5 className="card-title">Almonds</h5>
              <p className="card-text">$5.00</p>
              <div className="d-flex justify-content-center">
                <a href="#" className="btn btn-danger">Add Car</a>
              </div>
            </div>
          </div>
        </div>

        <div className="col">
          <div className="card">
          <img src="/img/paprika.png" className="card-img-top" alt="..."  height=" 200px "/>
            <div className="card-body">
              <h5 className="card-title">Paprika</h5>
              <p className="card-text">$2.50</p>
              <div className="d-flex justify-content-center">
                <a href="#" className="btn btn-danger">Add Car</a>
              </div>
            </div>
          </div>
        </div>

        <div className="col">
          <div className="card">
          <img src="/img/chocolates2.png" className="card-img-top" alt="..."  height=" 200px "/>
            <div className="card-body">
              <h5 className="card-title">Chocolates</h5>
              <p className="card-text">$6.50</p>
              <div className="d-flex justify-content-center">
                <a href="#" className="btn btn-danger">Add Car</a>
              </div>
            </div>
          </div>
        </div>

        <div className="col">
          <div className="card">
          <img src="/img/redroses.png" className="card-img-top" alt="..."  height=" 200px "/>
            <div className="card-body">
              <h5 className="card-title">Eternal roses</h5>
              <p className="card-text">$10.50</p>
              <div className="d-flex justify-content-center">
                <a href="#" className="btn btn-danger">Add Car</a>
              </div>
            </div>
          </div>
        </div>

        <div className="col">
          <div className="card">
          <img src="/img/roses.png" className="card-img-top" alt="..."  height=" 200px "/>
            <div className="card-body">
              <h5 className="card-title">Box of roses</h5>
              <p className="card-text">$15.00</p>
              <div className="d-flex justify-content-center">
                <a href="#" className="btn btn-danger">Add Car</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ShoppingOptions;

