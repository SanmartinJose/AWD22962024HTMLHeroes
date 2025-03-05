import React, { useState } from "react";
import "./css/FlowerDescription.css";

const GranolaDescription = () => {

  const [mainImage, setMainImage] = useState("/img/granola1.jpg");

  const thumbnails = [
    { src: "/img/granola1.jpg", alt: "miniature 1" },
    { src: "/img/granola2.jpg", alt: "miniature 2" },
    { src: "/img/granola3.jpg", alt: "miniature 3" },
    { src: "/img/granola4.jpg", alt: "miniature 4" },
    { src: "/img/granola5.webp", alt: "miniature 5" },
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
        <h1>Granola organica - Alimento sano</h1>
        <p className="price">$5.99</p>
        <p className="rating">4.6 ★★★★</p>
        <p className="description">
        Nuestra granola natural es una mezcla deliciosa y saludable de avena integral, nueces, 
        semillas y un toque de miel, todo cuidadosamente horneado para resaltar su sabor y mantener 
        sus beneficios nutricionales. Sin azúcares añadidos ni conservantes, es la opción perfecta 
        para quienes buscan un snack energético o una adición saludable a sus desayunos. Rica en fibra, 
        proteínas y antioxidantes, nuestra granola te brinda la energía que necesitas para empezar el día 
        de forma natural y deliciosa. Ideal para combinar con yogur, frutas frescas o disfrutarla 
        directamente del paquete.
        </p>
        <div className="availability">
          <p>
            Disponibles: <span className="status">20 stock</span>
          </p>
        </div>
        <div className="deliveryOptions">
          <p>
            Entregar a <strong>Sangolqui</strong>
          </p>
          <p>No se puede entregar a la ubicación seleccionada...</p>
        </div>
        <button className="addToCart">Agregar al Carrito</button>
      </div>


      <section className="commentsSection">
        <h3>Reseñas de Clientes</h3>
        <div className="comments">
          <p>
            <strong>User1:</strong> ¡Este producto es muy bueno!
          </p>
          <p>
            <strong>User2:</strong> Tienen un gran sabor.
          </p>
        </div>
        <textarea placeholder="Agrega tu comentario aquí..."></textarea>
        <h4> </h4>
        <button className="addComment">Agregar Comentario</button>
      </section>
    </div>
  );
};

export default GranolaDescription;