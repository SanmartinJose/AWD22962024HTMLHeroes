import React from "react";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import { Carousel } from "react-bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";


const Index = () => {
  return (
    <div>
      {/* Navbar */}
      

      {/* Carousel */}
      <div className="d-flex justify-content-center">
        <Carousel fade>
          <Carousel.Item>
            <img
              className="d-block w-100"
              src="/img/roses2.png"
              alt="Paprika Image"
              width="1000"
              height="600"
            />
          </Carousel.Item>
          <Carousel.Item>
            <img
              className="d-block w-100"
              src="/img/product.jpg"
              alt="Buy Online"
              width="1000"
              height="600"
            />
          </Carousel.Item>
          <Carousel.Item>
            <img
              className="d-block w-100"
              src="/img/almonds5.jpg"
              alt="Chocolate Bag"
              width="1000"
              height="600"
            />
          </Carousel.Item>
        </Carousel>
      </div>

      {/* Welcome Section */}
      <div className="container my-5">
        <div className="row justify-content-center">
          <div className="col-md-12 text-center">
            <h1 className="display-4 mb-3">Bienvenidos a NatuLove</h1>
            <p className="lead">
              Nourish your body and soul with nature. Our selection of nuts,
              seeds and artisanal chocolates is a source of energy, vitamins and
              minerals essential for your well-being. From strengthening your immune
              system to improving your concentration, our products will help you
              achieve your health goals. Customize your order and enjoy the benefits
              of a healthy and balanced diet with Natu Love.
            </p>
          </div>
        </div>
      </div>

      {/* Featured Products */}
      <div className="col-md-12 text-center">
        <h1 className="display-4 mb-3">Productos Destacados</h1>
      </div>

      <div className="container my-5">
        <div className="row row-cols-1 row-cols-md-3 g-4">
          {/* Product Card 1 */}
          <div className="col">
            <div className="card">
              <img
                src="/img/chocolateBag.jpg"
                className="card-img-top"
                alt="..."
                height="300px"
              />
              <div className="card-body">
                <h5 className="card-title">Mix de chocolotes</h5>
                <p className="card-text">
                  Una selección de pequeños detalles sobre chocolates, destacando su
                  sabor, textura y variedad.
                </p>
                <a href="/php/chocolateDescrip.php" className="btn btn-warning">
                  Ver más
                </a>
              </div>
            </div>
          </div>

          {/* Product Card 2 */}
          <div className="col">
            <div className="card">
              <img
                src="/img/flower2.jpeg"
                className="card-img-top"
                alt="..."
                height="300px"
              />
              <div className="card-body">
                <h5 className="card-title">Flor Eterna</h5>
                <p className="card-text">
                  Arreglos florales que combinan colores, formas y fragancias para
                  crear composiciones únicas y llenas de belleza.
                </p>
                <a href="/php/eternalFlower.php" className="btn btn-warning">
                  Ver más
                </a>
              </div>
            </div>
          </div>

          {/* Product Card 3 */}
          <div className="col">
            <div className="card">
              <img
                src="/img/almonds2.jpg"
                className="card-img-top"
                alt="..."
                height="300px"
              />
              <div className="card-body">
                <h5 className="card-title">Granola Organica</h5>
                <p className="card-text">
                  Variedad de frutos secos, ricos en nutrientes y perfectos para
                  disfrutar como snacks o incorporarlos en diversas preparaciones.
                </p>
                <a href="/php/almondsDescrip.php" className="btn btn-warning">
                  Ver más
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Footer */}
     
    </div>
  );
};

export default Index;
