<?php    
    include "includes/php/header.php";
    include "includes/php/social-bar.php";
    include "includes/php/top-bar.php";
    include "includes/php/navbar.php";

    include "functions.php";

    $ip_add = getRealUserIp();
    
    $order_cart_resultArray = array();
    $order_product_resultArray = array();

    $order_cart_query = "select * from cart where ip_add='$ip_add'";
    $order_cart_result = mysqli_query($con, $order_cart_query);
    $order_cart_count = mysqli_num_rows($order_cart_result);
    while($row1 = mysqli_fetch_array($order_cart_result)) {
        $order_cart_resultArray[] = $row1;
        $order_product_query = "select * from products where product_id='" . $row1['p_id'] . "'";
        //echo $order_product_query;
        //echo '<script>alert("' . $order_product_query . '")</script>';
        $order_product_result = mysqli_query($con, $order_product_query);
        $order_product_count = mysqli_num_rows($order_product_result);
        while($row2 = mysqli_fetch_array($order_product_result)) {
            $order_product_resultArray[] = $row2;
        }
    }
    
    /*foreach ($order_cart_resultArray as $value) {
        print_r($value);
    }

    echo "$order_cart_count"; echo "<br>";
    echo "$order_product_count"; echo "<br>";
    
    foreach ($order_product_resultArray as $value) {
        print_r($value);
    }*/

    for($i=0; $i<sizeof($order_cart_resultArray); $i++) {
        echo $order_cart_resultArray[$i]['cart_id']; echo "<br>";
        echo $order_cart_resultArray[$i]['p_id']; echo "<br>";
        echo $order_cart_resultArray[$i]['ip_add']; echo "<br>";
        echo $order_cart_resultArray[$i]['qty']; echo "<br>";
        echo $order_cart_resultArray[$i]['p_price']; echo "<br>";
        echo $order_cart_resultArray[$i]['size']; echo "<br>";
    }

    for($i=0; $i<sizeof($order_product_resultArray); $i++) {
        echo $order_product_resultArray[$i]['product_id']; echo "<br>";
        echo $order_product_resultArray[$i]['p_cat_id']; echo "<br>";
        echo $order_product_resultArray[$i]['cat_id']; echo "<br>";
        echo $order_product_resultArray[$i]['manufacturer_id']; echo "<br>";
        echo $order_product_resultArray[$i]['date']; echo "<br>";
        echo $order_product_resultArray[$i]['product_title']; echo "<br>";
        echo $order_product_resultArray[$i]['product_seo_desc']; echo "<br>";
        echo $order_product_resultArray[$i]['product_url']; echo "<br>";
        echo $order_product_resultArray[$i]['product_img1']; echo "<br>";
        echo $order_product_resultArray[$i]['product_img2']; echo "<br>";
        echo $order_product_resultArray[$i]['product_img3']; echo "<br>";
        echo $order_product_resultArray[$i]['product_img4']; echo "<br>";
        echo $order_product_resultArray[$i]['product_img5']; echo "<br>";
        echo $order_product_resultArray[$i]['product_img6']; echo "<br>";
        echo $order_product_resultArray[$i]['product_price']; echo "<br>";
        echo $order_product_resultArray[$i]['product_psp_price']; echo "<br>";
        echo $order_product_resultArray[$i]['product_desc']; echo "<br>";
    }
                                    
    include "includes/php/instagram.php";
    include "includes/php/footer.php";
?>