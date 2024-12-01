<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NatuLove Products</title>
  <!-- Agregar Bootstrap para los estilos -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/"> <!-- Estilos personalizados -->
</head>
<body>
  <div class="container my-5">
    <h1 class="display-4 mb-3 text-danger">NatuLove Products Specialized in Love</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php
        $products = [
          ["img" => "/img/pistacho.png", "title" => "Pistachios", "price" => "$4.50", "link" => "/EternalFlower"],
          ["img" => "/img/almonds.png", "title" => "Almonds", "price" => "$5.00", "link" => "/Granola"],
          ["img" => "/img/paprika.png", "title" => "Paprika", "price" => "$2.50", "link" => "/Granola"],
          ["img" => "/img/chocolates2.png", "title" => "Chocolates", "price" => "$6.50", "link" => "/Granola"],
          ["img" => "/img/redroses.png", "title" => "Eternal Roses", "price" => "$10.50", "link" => "/EternalFlower"],
          ["img" => "/img/granola3.jpg", "title" => "Granola", "price" => "$5.00", "link" => "/Granola"],
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
  <!-- Agregar scripts de Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

