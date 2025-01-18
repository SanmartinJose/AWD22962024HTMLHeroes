<?php
function getDatabaseConnection($table = null) {
    $host = 'bfbfl0wgtltgn4vaqzjs-mysql.services.clever-cloud.com'; // CleverCloud MySQL host
    $dbname = 'bfbfl0wgtltgn4vaqzjs'; 
    $username = 'uglbkixcek6wynq5';
    $password = 'K51uMlLuFC2RLgSk0fY0';

    $connection = new mysqli($host, $username, $password, $dbname);

    if ($connection->connect_error) {
        die("Error al conectar con la base de datos: " . $connection->connect_error);
    }

    return $connection;
}
?>
