import React from 'react';
import Granola from '../resources/img/granola2.jpg';

const AboutUs = () => {
    return (
        <div>

            {/* Contenido de la página */}
            <div className="container mt-5">
                <div className="row">
                    <div className="col-md-12 text-center">
                        <h1>Quiénes Somos</h1>
                        <p className="lead">Bienvenidos a NATULOVE, tu tienda de alimentos y decoraciones naturales.</p>
                    </div>
                    <img src={Granola} alt="Granola" className="img-fluid" />
                </div>

                <div className="row mt-4">
                    <div className="col-md-6">
                        <h2>Nuestra Historia</h2>
                        <p>
                            NATULOVE nació con la misión de ofrecer productos naturales y ecológicos que promuevan un estilo de vida saludable y sostenible. Desde nuestros inicios, hemos trabajado arduamente para seleccionar los mejores productos que respeten el medio ambiente y beneficien a nuestros clientes.
                        </p>
                    </div>
                    <div className="col-md-6">
                        <h2>Nuestra Misión</h2>
                        <p>
                            En NATULOVE, nos comprometemos a proporcionar alimentos y decoraciones naturales de alta calidad. Creemos en la importancia de cuidar nuestro planeta y fomentar prácticas sostenibles. Nuestra misión es inspirar a nuestros clientes a vivir de manera más consciente y respetuosa con la naturaleza.
                        </p>
                    </div>
                </div>

                <div className="row mt-4">
                    <div className="col-md-6">
                        <h2>Nuestros Valores</h2>
                        <ul>
                            <li>Calidad: Ofrecemos productos de la más alta calidad.</li>
                            <li>Sostenibilidad: Promovemos prácticas ecológicas y sostenibles.</li>
                            <li>Compromiso: Estamos dedicados a la satisfacción de nuestros clientes.</li>
                            <li>Innovación: Buscamos constantemente nuevas formas de mejorar y crecer.</li>
                        </ul>
                    </div>
                    <div className="col-md-6">
                        <h2>Nuestro Equipo</h2>
                        <p>
                            Contamos con un equipo de profesionales apasionados por la naturaleza y el bienestar. Cada miembro de nuestro equipo aporta su experiencia y conocimientos para ofrecer el mejor servicio y productos a nuestros clientes.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default AboutUs;