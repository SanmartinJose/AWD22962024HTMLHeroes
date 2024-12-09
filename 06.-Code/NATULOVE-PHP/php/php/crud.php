<?php

$servidor = "mysql:dbname=bshfoyw8lhufkszxhddq;host=bshfoyw8lhufkszxhddq-mysql.services.clever-cloud.com";
$user = "utoyqieuqvce4tua";
$pass = "OqTJFQWHhe9FNxgfYdni";
try {
    $pdo = new PDO($servidor, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
   
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}


?>