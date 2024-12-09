<?php 
    $conn = mysqli_connect(
        'bshfoyw8lhufkszxhddq-mysql.services.clever-cloud.com',
        'utoyqieuqvce4tua',
        'OqTJFQWHhe9FNxgfYdni',
        'bshfoyw8lhufkszxhddq'
    );
    //print_r($conn);
    if (mysqli_connect_errno()) {
        echo "Fallo en la base de datos". $conn->connect_error;
    }
?>