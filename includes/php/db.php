<?php
    $con = mysqli_connect("localhost", "root", "", "complex_ecommerce_store");

    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        
    }
    mysqli_set_charset($con, "utf8");
?>