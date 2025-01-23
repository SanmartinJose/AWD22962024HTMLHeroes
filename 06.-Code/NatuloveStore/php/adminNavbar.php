t<?php
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
            <p><img src="<?php echo $direction ?>img/logo1.png" width="791" height="112" alt=""/></p>
        </center>
    </div>

    <nav class="navbar navbar-expand-lg bg-body border-bottom border-3 border-danger">
        <div class="container-fluid">
            <!-- Botón hamburguesa que aparece en pantallas pequeñas -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex align-items-center">
                    
                    <li class="nav-item d-flex align-items-center">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $direction ?>php/addProduct.php">Agregar Producto</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $direction ?>php/userViewer.php">Usuarios</a>
                    </li>  
                    <li class="nav-item">
<<<<<<< HEAD
                        <a class="nav-link" href="<?php echo $direction ?>php/editProduct.php">Catalogo</a>
                    </li>  
=======
                        <a class="nav-link" href="<?php echo $direction ?>php/seeInventory.php">MostrarInventario</a>
                    </li>  


>>>>>>> 2686a19d7c71cc6b2f49752683289b0586c2a531
                     
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown" style="min-width: 150px;">
                            <div class="p-3">
                            <a class="dropdown-item" href="Login.php">Cerrar sesión</a>

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
