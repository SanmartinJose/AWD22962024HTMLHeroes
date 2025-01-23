<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiénes Somos - NATULOVE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php include 'Navbar.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Quiénes Somos</h1>
                <p class="lead">Bienvenidos a NATULOVE, tu tienda de alimentos y decoraciones naturales.</p>
            </div>
            <img src="../img/granola2.jpg" alt="" />
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Nuestra Historia</h2>
                <p>NATULOVE nació con la misión de ofrecer productos naturales y ecológicos que promuevan un estilo de vida saludable y sostenible. Desde nuestros inicios, hemos trabajado arduamente para seleccionar los mejores productos que respeten el medio ambiente y beneficien a nuestros clientes.</p>
            </div>
            <div class="col-md-6">
                <h2>Nuestra Misión</h2>
                <p>En NATULOVE, nos comprometemos a proporcionar alimentos y decoraciones naturales de alta calidad. Creemos en la importancia de cuidar nuestro planeta y fomentar prácticas sostenibles. Nuestra misión es inspirar a nuestros clientes a vivir de manera más consciente y respetuosa con la naturaleza.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Nuestros Valores</h2>
                <ul>
                    <li>Calidad: Ofrecemos productos de la más alta calidad.</li>
                    <li>Sostenibilidad: Promovemos prácticas ecológicas y sostenibles.</li>
                    <li>Compromiso: Estamos dedicados a la satisfacción de nuestros clientes.</li>
                    <li>Innovación: Buscamos constantemente nuevas formas de mejorar y crecer.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h2>Nuestro Equipo</h2>
                <p>Contamos con un equipo de profesionales apasionados por la naturaleza y el bienestar. Cada miembro de nuestro equipo aporta su experiencia y conocimientos para ofrecer el mejor servicio y productos a nuestros clientes.</p>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
	<div class="col-md-6 well" style="background-color: #0BA9FD">
		<h3 class="text-primary">Display Google Map Data</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<button class="btn btn-primary" id="get_map"><span class="glyphicon glyphicon-location"></span> Load Map</button>
		<div id="map" style="height:500px; display:none;"></div>
	</div>
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-AB-9XZd-iQby-bNLYPFyb0pR2Qw3orw&callback=initMap" async defer></script>	
	<script>
		var map;
		function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: 9.5162, lng: 123.158},
				zoom: 8
			});
		}
	</script>
	<script src="js/script.js"></script>

    
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <?php include 'footer.php'; ?>
 
</body>
</html>