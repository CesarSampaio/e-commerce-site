<?php
    $con = mysqli_connect("localhost", "root", "", "complex_ecommerce_store");

    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Falha na conexão com o MySQL: " . mysqli_connect_error();
    } else {
        
    }
    mysqli_set_charset($con, "utf8");
?>