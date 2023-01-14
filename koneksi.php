<?php
    $host   = 'localhost';
    $user   = 'root';
    $pass   = '';
    $db     = 'tabel'; //nama data base harus disesuakan (db = data base yang berada di localhost)
    $conn   = mysqli_connect($host, $user, $pass, $db,);

    mysqli_select_db($conn, $db);
?>