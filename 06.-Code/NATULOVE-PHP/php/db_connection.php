<?php
function getDatabaseConnection($table = null) {
    $host = 'bshfoyw8lhufkszxhddq-mysql.services.clever-cloud.com'; // CleverCloud MySQL host
    $dbname = 'bshfoyw8lhufkszxhddq'; 
    $username = 'utoyqieuqvce4tua';
    $password = 'OqTJFQWHhe9FNxgfYdni';

    $connection = new mysqli($host, $username, $password, $dbname);

    if ($connection->connect_error) {
        die("Error al conectar con la base de datos: " . $connection->connect_error);
    }

    return $connection;
}
?>
