import React, { useState } from "react";
import "./css/FlowerDescription.css";

const FlowerDescription = () => {

  const [mainImage, setMainImage] = useState("/img/flowers1.jpg");

  const thumbnails = [
    { src: "/img/flowers1.jpg", alt: "miniature 1" },
    { src: "/img/flower1.jpeg", alt: "miniature 2" },
    { src: "/img/flower2.jpeg", alt: "miniature 3" },
    { src: "/img/flower4.jpeg", alt: "miniature 4" },
    { src: "/img/flower5.jpeg", alt: "miniature 5" },
  ];

  return (
    <div className="productContainer">
      <div className="productGallery">
        <img src={mainImage} alt="Eternal flower gift" className="mainImage" />
        <div className="thumbnailGallery">
          {thumbnails.map((thumbnail, index) => (
            <img
              key={index}
              src={thumbnail.src}
              alt={thumbnail.alt}
              className="thumbnail"
              onClick={() => setMainImage(thumbnail.src)}
            />
          ))}
        </div>
      </div>

      <div className="productDetails">
        <h1>Regalo natural flor eterna - Amor eterno</h1>
        <p className="price">$9.99</p>
        <p className="rating">4.8 ★★★★★</p>
        <p className="description">
        La flor eterna es una pieza única y encantadora que captura la belleza natural 
        de las flores en su forma más duradera. Con un proceso especial de preservación, 
        esta flor mantiene su frescura y color durante años, sin necesidad de agua ni 
        cuidados especiales. Ideal para decorar tu hogar o regalar a alguien especial, 
        la flor eterna simboliza la belleza perdurable y la eternidad de los momentos 
        más preciados. Perfecta para quienes buscan un toque natural y elegante que 
        perdure en el tiempo.
        </p>
        <div className="availability">
          <p>
            Disponibles: <span className="status">15 stock</span>
          </p>
        </div>
        <div className="deliveryOptions">
          <p>
            Entregar a <strong>Conocoto</strong>
          </p>
          <p>No se puede entregar a la ubicación seleccionada...</p>
        </div>
        <button className="addToCart">Agregar al Carrito</button>
      </div>


      <section className="commentsSection">
        <h3>Reseñas de Clientes</h3>
        <div className="comments">
          <p>
            <strong>User1:</strong> ¡Este es un producto increíble!
          </p>
          <p>
            <strong>User2:</strong> Lo recomiendo altamente.
          </p>
        </div>
        <textarea placeholder="Agrega tu comentario aquí..."></textarea>
        <h4> </h4>
        <button className="addComment">Agregar Comentario</button>
      </section>
    </div>
  );
};

export default FlowerDescription;
