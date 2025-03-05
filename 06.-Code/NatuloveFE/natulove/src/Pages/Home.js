import React from 'react';
import Navbar from '../Components/navbar';  // Importa el componente Navbar
import Logo from '../Components/logo';      // Importa el componente Logo
import Footer from '../Components/footer';  // Importa el componente Footer
import rosesImage from '../resources/img/roses2.png';
import productImage from '../resources/img/product.jpg';
import almondsImage from '../resources/img/almonds5.jpg';
import chocolateBagImage from '../resources/img/chocolateBag.jpg';
import flowerImage from '../resources/img/flower2.jpeg';
import almonds2Image from '../resources/img/almonds2.jpg';

const Home = () => {
    return (
        <div>
            <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>NatuLove Products</title>
                <link
                    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
                    rel="stylesheet"
                    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                    crossOrigin="anonymous"
                />
                <link
                    href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
                    rel="stylesheet"
                />
                <script src="https://www.gstatic.com/firebasejs/9.1.3/firebase-app.js"></script>
                <script src="https://www.gstatic.com/firebasejs/9.1.3/firebase-auth.js"></script>
            </head>

            <body>
                {/* Navbar componente */}
                <nav>
                    <Navbar />  {/* Aquí se agrega el componente Navbar */}
                </nav>

                {/* Carrusel */}
                <div className="d-flex justify-content-center">
                    <div id="carouselExampleAutoplaying" className="carousel slide" data-bs-ride="carousel">
                        <div className="carousel-inner">
                            <div className="carousel-item active">
                            <img src={rosesImage} className="d-block mx-auto" width="800" height="400" alt="Paprika Image" />
                            </div>
                            <div className="carousel-item">
                            <img src={productImage} className="d-block mx-auto" width="800" height="400" alt="Buy Online" />
                            </div>
                            <div className="carousel-item">
                            <img src={almondsImage} className="d-block mx-auto" width="800" height="400" alt="Chocolate Bag" />
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

                {/* Contenido principal */}
                <div className="container my-5">
                    <div className="row justify-content-center">
                        <div className="col-md-12 text-center">
                            <h1 className="display-4 mb-3">Bienvenidos a NatuLove</h1>
                            <p className="lead">
                                Nourish your body and soul with nature. Our selection of nuts, seeds and artisanal chocolates is a source of energy, vitamins and minerals essential for your well-being. From strengthening your immune system to improving your concentration, our products will help you achieve your health goals. Customize your order and enjoy the benefits of a healthy and balanced diet with Natu Love.
                            </p>
                        </div>
                    </div>
                </div>

                <div className="col-md-12 text-center">
                    <h1 className="display-4 mb-3">Productos Destacados</h1>
                </div>

                <div className="container my-5">
                    <div className="row row-cols-1 row-cols-md-3 g-4">
                        <div className="col">
                            <div className="card">
                            <img src={chocolateBagImage} className="card-img-top" alt="..." height="300px" />
                                <div className="card-body">
                                    <h5 className="card-title">Mix de chocolates</h5>
                                    <p className="card-text">Una selección de pequeños detalles sobre chocolates, destacando su sabor, textura y variedad.</p>
                                    <a href="../NATULOVE-PHP/php/chocolateDescrip.php" className="btn btn-warning">Ver más</a>
                                </div>
                            </div>
                        </div>

                        <div className="col">
                            <div className="card">
                            <img src={flowerImage} className="card-img-top" alt="..." height="300px" />
                                <div className="card-body">
                                    <h5 className="card-title">Flor Eterna</h5>
                                    <p className="card-text">Arreglos florales que combinan colores, formas y fragancias para crear composiciones únicas y llenas de belleza.</p>
                                    <a href="../NATULOVE-PHP/php/eternalFlower.php" className="btn btn-warning">Ver más</a>
                                </div>
                            </div>
                        </div>

                        <div className="col">
                            <div className="card">
                            <img src={almonds2Image} className="card-img-top" alt="..." height="300px" />
                                <div className="card-body">
                                    <h5 className="card-title">Granola Organica</h5>
                                    <p className="card-text">Variedad de frutos secos, ricos en nutrientes y perfectos para disfrutar como snacks o incorporarlos en diversas preparaciones.</p>
                                    <a href="../NATULOVE-PHP/php/almondsDescrip.php" className="btn btn-warning">Ver más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Footer componente */}
                <footer>
                    <Footer />  {/* Aquí se agrega el componente Footer */}
                </footer>

                <script>
                    // Inicializar Firebase
                    const app = firebase.initializeApp(firebaseConfig);
                    const auth = firebase.auth();
                </script>
            </body>
        </div>
    );
};

export default Home;
