<?php
    $current_page = basename($_SERVER['PHP_SELF']);
    $direction = ($current_page == 'index.php') ? "" : "../";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <!-- Enlaces a Bootstrap y a iconos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Encabezado con logo -->
    <div class="text-center my-3">
        <img src="<?php echo $direction ?>img/logo1.png" width="791" height="112" alt="Logo"/>
    </div>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-body border-bottom border-3 border-danger">
        <div class="container-fluid">
            <!-- Botón hamburguesa para pantallas pequeñas -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex align-items-center">
                    <!-- Enlace a la página de inicio -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="<?php echo $direction ?>index.php">
                            <i class="bi bi-house-door fs-4"></i> 
                        </a>
                    </li>

                    <!-- Enlace a "¿Quiénes somos?" -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $direction ?>php/aboutUs.php">¿Quiénes Somos?</a>
                    </li>

                    <!-- Menú desplegable para el catálogo -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Catálogo
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="min-width: 1050px;">
                            <div class="d-flex flex-wrap gap-4 p-3">
                                <a class="dropdown-item" href="<?php echo $direction ?>php/catalog.php">General</a>
                            </div>
                        </div>
                    </li>

                    <!-- Enlace a las ofertas -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $direction ?>php/offersDescription.php">Ofertas</a>
                    </li>

                    <!-- Icono y enlace al carrito de compras -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="cart.php">
                            <i class="bi bi-cart3"></i>
                            <span>Carrito</span>
                        </a>
                    </li>

                    <!-- Menú desplegable para la cuenta de usuario -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown" style="min-width: 150px;">
                            <div class="p-3">
                                <a class="dropdown-item" href="<?php echo $direction ?>php/Register.php">Registrarse</a>
                                <a class="dropdown-item" href="<?php echo $direction ?>php/Login.php">Iniciar Sesión</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Espaciado -->
    <br>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
