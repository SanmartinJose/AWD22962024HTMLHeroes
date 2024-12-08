<?php
    $current_page = basename($_SERVER['PHP_SELF']);
    if ($current_page == 'index.php') {
        $direction = "";
    } else {
        $direction = "../";
    }
?>
<head>
   <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

	
</head>

<body>
	<div>
	<center>	
	  <p><img src="<?php echo $direction ?>imagenes/logo1.png" width="791" height="112" alt=""/></p>
	</center>
	</div>
		
		


<nav class="navbar navbar-expand-lg bg-body border-bottom border-3 border-danger">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex align-items-center">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="<?php echo $direction ?>index.php">
            <i class="bi bi-house-door fs-4"></i> 
          </a>
        </li>
        <li class="nav-item d-flex align-items-center">
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $direction ?>php/aboutUs.php">¿Quiénes Somos?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $direction ?>php/ProductManagment.php">Agregar Producto</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="<?php echo $direction ?>php/natuLove.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Catálogo
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="min-width: 1050px;">
            <div class="d-flex flex-wrap gap-4 p-3">
              <div>
                <h6 class="dropdown-header">Chocolates</h6>
                <a class="dropdown-item" href="#">Chocolate con naranja</a>
                <a class="dropdown-item" href="#">Chocolate con cereza</a>
                <a class="dropdown-item" href="#">Chocolate semi amargo</a>
                <a class="dropdown-item" href="#">Chocolate con maracuyá</a>
                <a class="dropdown-item" href="#">Chocolate con almendras</a>
                <a class="dropdown-item" href="#">Chocolate blanco</a>
                <a class="dropdown-item" href="<?php echo $direction ?>php/chocolateDescrip.php">Mix chocolates</a>
              </div>
              <div>
                <h6 class="dropdown-header">Dulces y regalos</h6>
                <a class="dropdown-item" href="#">Gomitas de fresa</a>
                <a class="dropdown-item" href="#">Gomitas de mora</a>
                <a class="dropdown-item" href="#">Caramelos de jengibre y eucalipto</a>
                <a class="dropdown-item" href="#">Caumales</a>
                <a class="dropdown-item" href="<?php echo $direction ?>php/eternalFlower.php">Flor eterna</a>
              </div>
              <div>
                <h6 class="dropdown-header">Especias</h6>
                <a class="dropdown-item" href="#">Cúrcuma</a>
                <a class="dropdown-item" href="#">Comino</a>
                <a class="dropdown-item" href="#">Ajo en polvo</a>
                <a class="dropdown-item" href="#">Cebolla en polvo</a>
                <a class="dropdown-item" href="#">Ají peruano</a>
                <a class="dropdown-item" href="<?php echo $direction ?>php/paprikaDescrip.php">Paprika</a>
                <a class="dropdown-item" href="#">Nuez moscada</a>
              </div>
              <div>
                <h6 class="dropdown-header">Frutos Secos</h6>
                <a class="dropdown-item" href="<?php echo $direction ?>php/granolaDescrip.php">Granola</a>
                <a class="dropdown-item" href="<?php echo $direction ?>php/almondsDescrip.php">Almendra</a>
                <a class="dropdown-item" href="#">Maní sin sal</a>
                <a class="dropdown-item" href="#">Maní con sal</a>
                <a class="dropdown-item" href="#">Pasas</a>
                <a class="dropdown-item" href="<?php echo $direction ?>php/pistachoDescrip.php">Pistacho</a>
              </div>
              <div>
                <h6 class="dropdown-header">Hojas Medicinales</h6>
                <a class="dropdown-item" href="#">Jinsen</a>
                <a class="dropdown-item" href="#">Moringa</a>
                <a class="dropdown-item" href="#">Laurel</a>
                <a class="dropdown-item" href="#">Zen</a>
              </div>
              <div>
                <a class="dropdown-item" href="<?php echo $direction ?>php/catalogPro.php">General</a>
              </div>
            </div>
          </div>
        </li>
		  <li class="nav-item">
          <a class="nav-link" href="almondsDescrip.php">Ofertas</a>
        </li>     
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="#">
            <i class="bi bi-cart3"></i>
            <span>Carrito</span>
          </a>
        </li>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="userDropdown" style="min-width: 150px;">
            <div class="p-3">
              <a class="dropdown-item" href="<?php echo $direction ?>php/Register.php">Registrarse</a>
              <a class="dropdown-item" href="#">Iniciar Sesión</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>


</br>




	
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>