<?php require_once 'Navbar.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NatuLove Products</title>

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/Catalog.css">
  <link rel="stylesheet" href="../../NATULOVE-PHP/css/Footer.css" >
</head>
<body>


  <div class="container my-5">
	    
    <h1 class="display-4 mb-3 text-danger" >NatuLove Products Specialized in Love</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4" >
      <?php
        $products = [
          ["img" => "../../NATULOVE-PHP/imagenes/pistacho.png", "title" => "Pistachios", "price" => "$4.50", "link" => "pistachoDescrip.php"],
          ["img" => "../../NATULOVE-PHP/imagenes/almonds.png", "title" => "Almendras", "price" => "$4.99", "link" => "almondsDescrip.php"],
          ["img" => "../../NATULOVE-PHP/imagenes/paprika.png", "title" => "Paprika", "price" => "$2.50", "link" => "paprikaDescrip.php"],
          ["img" => "../../NATULOVE-PHP/imagenes/chocolates2.png", "title" => " Mix Chocolates", "price" => "$6.50", "link" => "chocolateDescrip.php"],
          ["img" => "../../NATULOVE-PHP/imagenes/redroses.png", "title" => "Rosa Eterna", "price" => "$9.99", "link" => "eternalFlower.php"],
          ["img" => "../../NATULOVE-PHP/imagenes/granola3.jpg", "title" => "Granola", "price" => "$5.99", "link" => "granolaDescrip.php"],
        ];

        foreach ($products as $product) {
          echo '
          <div class="col">
            <div class="card h-100">
              <img src="'.$product["img"].'" class="card-img-top" alt="'.$product["title"].'" height="200px">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">'.$product["title"].'</h5>
                <p class="card-text">'.$product["price"].'</p>
                <div class="mt-auto d-flex justify-content-around">
                  <button class="btn btn-danger">Add to Cart</button>
                  <a href="'.$product["link"].'" class="btn btn-info">More Info</a>
                </div>
              </div>
            </div>
          </div>
          ';
        }
      ?>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<?php include 'Footer.php'; ?>
</body>
</html>

