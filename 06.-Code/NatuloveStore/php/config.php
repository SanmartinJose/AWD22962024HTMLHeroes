<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once '../vendor/autoload.php';

//Make object of Google API Client for call Google API
$evenFile = '.even'; // Cambia el nombre si es necesario
$config = json_decode(file_get_contents($evenFile), true);

// Crear cliente de Google
$google_client = new Google_Client();

// Configurar cliente de Google con los datos del archivo .even
$google_client->setClientId($config['client_id']);
$google_client->setClientSecret($config['client_secret']);
$google_client->setRedirectUri($config['redirect_uri']);

// Agregar scopes
foreach ($config['scopes'] as $scope) {
    $google_client->addScope($scope);
}

?>


