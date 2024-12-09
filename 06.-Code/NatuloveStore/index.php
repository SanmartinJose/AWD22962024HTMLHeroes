
<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NatuLove Products</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
<?php include 'php/Navbar.php'; ?>


      <div class="d-flex justify-content-center">
      <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <p><img src="img/roses2.png" class="d-block mx-auto" width="800" height="400" alt="Paprika Image"></p>
          </div>
          <div class="carousel-item">
            <img src="img/product.jpg" class="d-block mx-auto" width="800" height="400" alt="Buy Online">
          </div>
          <div class="carousel-item">
            <img src="img/almonds5.jpg" class="d-block mx-auto" width="800" height="400" alt="Chocolate Bag">
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
    </div>

    <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <h1 class="display-4 mb-3">Bienvenidos a NatuLove</h1>
        <p class="lead">
          Nourish your body and soul with nature. Our selection of nuts, seeds and artisanal chocolates is a source of energy, vitamins and minerals essential for your well-being. From strengthening your immune system to improving your concentration, our products will help you achieve your health goals. Customize your order and enjoy the benefits of a healthy and balanced diet with Natu Love.
        </p>
      </div>
    </div>
  </div>

  <div class="col-md-12 text-center">
        <h1 class="display-4 mb-3">Productos Destacados</h1>
  </div>
	
	  <div class="container my-5">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
      <div class="card">
        <img src="img/chocolateBag.jpg " class="card-img-top" alt="..." height="300px" /> 
        <div class="card-body">
          <h5 class="card-title">Mix de chocolotes</h5>
          <p class="card-text">Una selección de pequeños detalles sobre chocolates, destacando su sabor, textura y variedad.</p>
          <a href="../NATULOVE-PHP/php/chocolateDescrip.php" class="btn btn-warning">Ver más</a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <img src="img/flower2.jpeg"  class="card-img-top" alt="..." height="300px"/>
        <div class="card-body">
          <h5 class="card-title">Flor Eterna</h5>
          <p class="card-text">Arreglos florales que combinan colores, formas y fragancias para crear composiciones únicas y llenas de belleza.</p>
          <a href="../NATULOVE-PHP/php/eternalFlower.php" class="btn btn-warning">Ver más</a>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card">
        <img src="img/almonds2.jpg" class="card-img-top" alt="..." height="300px"/> 
        <div class="card-body">
          <h5 class="card-title">Granola Organica</h5>
          <p class="card-text">Variedad de frutos secos, ricos en nutrientes y perfectos para disfrutar como snacks o incorporarlos en diversas preparaciones.</p>
          <a href="../NATULOVE-PHP/php/almondsDescrip.php" class="btn btn-warning">Ver más</a>
        </div>
      </div>
    </div>
  </div>
</div>

	

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <?php include 'php/Footer.php'; ?>
</body>
</html>


<?php


