<?php
    $current_page = basename($_SERVER['PHP_SELF']);
    if ($current_page == 'index.php') {
        $direction = "";
    } else {
        $direction = "../";
    }
?>
<head>
    <link rel="stylesheet" href="<?php echo $direction ?>css/Footer.css" >
</head>
<footer class="footer bg-black text-light py-4">
    <div class="container">
        <div class="row">
            <!-- Logo Section -->
            <div class="col-md-2">
                <img src="<?php echo $direction ?>imagenes/LogoTeam.png" alt="Develop Team Logo" class="img-fluid" />
            </div>
            <!-- Navigation Links -->
            <div class="col-md-3">
                <h5 class="text-uppercase">Enlaces</h5>
                <ul class="list-unstyled">
                    <li><a href="<?php echo $direction ?>index.php" class="footer-link">Inicio</a></li>
                    <li><a href="<?php echo $direction ?>php/aboutUs.php" class="footer-link">¿Quiénes Somos?</a></li>
                    <li><a href="<?php echo $direction ?>php/catalogPro.php" class="footer-link">Productos</a></li>
                    <li><a href="#contact" class="footer-link">Contactos</a></li>
                </ul>
            </div>
            <!-- Contact Info -->
            <div class="col-md-6">
                <h5 class="text-uppercase">Contacta con nosotros</h5>
                <ul class="list-unstyled">
                    <li>Email: <a href="mailto:support@natulove.com" class="footer-link">support@natulove.com</a></li>
                    <li>Telefono: +593 992536817</li>
                    <li>Dirección: San Carlos, Quito, Ecuador</li>
                </ul>
            </div>
        </div>
        <small>&copy; 2024 Natulove. All Rights Reserved.</small>
    </div>
</footer>