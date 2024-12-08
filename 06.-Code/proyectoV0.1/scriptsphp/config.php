<?php 
    $conn = mysqli_connect(
        'localhost',
        'admin',
        'admin',
        'sistema_inventario'
    );
    //print_r($conn);
    if (mysqli_connect_errno()) {
        echo "Fallo en la base de datos". $conn->connect_error;
    }
?>