<?php
    if(isset($_POST['incoming_product_id'])) {
        $product_id = $_POST['incoming_product_id'];
        echo "<script>alert($product_id)</script>";
    } else {
        $product_id = $_POST['product-id'];
        echo "<script>alert($product_id)</script>";
    }
    include "functions.php";

    include "includes/php/header.php";
    include "includes/php/social-bar.php";
    include "includes/php/top-bar.php";
    include "includes/php/navbar.php";

    $product_buy_resultArray = array();
    $product_buy_query = "select * from products where product_id = '" . $product_id . "'";
    $product_buy_result = mysqli_query($con, $product_buy_query);
    $product_buy_num_rows_array = mysqli_num_rows($product_buy_result);
    while($row = mysqli_fetch_array($product_buy_result)) {
        $product_buy_resultArray[] = $row;
    }

    include "product-main.php";
    include "product-buy.php";

    if(isset($_POST['product_buy_submit'])) {
        $product_buy_product_id = $_POST['product-id'];
        echo "<script>alert($product_buy_product_id)</script>";
        $product_buy_product_qty = $_POST['product-buy-number'];
        echo "<script>alert($product_buy_product_qty)</script>";
        $product_buy_product_price = $_POST['product-price'];
        echo "<script>alert($product_buy_product_price)</script>";
        $product_buy_product_size = $_POST['product-size'];
        echo "<script>alert('" . $product_buy_product_size . "')</script>";
        $product_buy_product_ip_address = $_POST['ip-address'];
        echo "<script>alert('" . $product_buy_product_ip_address . "')</script>";

        $product_buy_query = "insert into cart (p_id, ip_add, qty, p_price, size) values ('$product_buy_product_id', '$product_buy_product_ip_address','$product_buy_product_qty', '$product_buy_product_price', '$product_buy_product_size')";
        echo "<script>alert('" . $product_buy_query . "')</script>";
        $product_buy_result = mysqli_query($con, $product_buy_query);
        echo "<script>alert('" . $product_buy_result . "')</script>";

        if($product_buy_result) {
            echo "<script>alert('New Manufacturer Has Been Inserted')</script>";
            echo "<script>window.open('index.php')</script>";
        }
    }

    include "includes/php/footer.php";
?>
