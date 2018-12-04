<?php    
    include "includes/php/header.php";
    include "includes/php/social-bar.php";
    include "includes/php/top-bar.php";
    include "includes/php/navbar.php";
    include "includes/php/carousel.php";
    include "includes/php/promo.php";
    include "includes/php/banners.php";

    $index_resultArray01 = array();
    $index_resultArray02 = array();

    $index_query_01 = "select * from categories where cat_id >= 8";
    $index_result_01 = mysqli_query($con, $index_query_01);
    $index_num_rows_01 = mysqli_num_rows($index_result_01);
    while($row1 = mysqli_fetch_array($index_result_01)) {
        $index_resultArray01[] = $row1;
        $index_query_02 = "select * from product_categories where p_cat_top = " . $row1['cat_id'];
        /*echo "<script>$index_query_02</script>";*/
        $index_result_02 = mysqli_query($con, $index_query_02);
        $index_num_rows_02 = mysqli_num_rows($index_result_02);
        while($row2 = mysqli_fetch_array($index_result_02)) {
            $index_resultArray02[] = $row2;
        }
    }
    /*print_r($index_resultArray01);
    print_r($index_resultArray02);*/

    /*echo"<br>";*/

    /*echo $index_resultArray01[0]['cat_title'];echo "<br>";
    echo $index_resultArray02[0]['p_cat_title'];echo "<br>";
    echo $index_resultArray02[1]['p_cat_title'];echo "<br>";

    echo $index_resultArray02[0]['p_cat_id'];echo "<br>";
    echo $index_resultArray02[1]['p_cat_id'];echo "<br>";

    echo $index_resultArray01[1]['cat_title'];echo "<br>";
    echo $index_resultArray02[2]['p_cat_title'];echo "<br>";
    echo $index_resultArray02[3]['p_cat_title'];echo "<br>";

    echo $index_resultArray02[2]['p_cat_id'];echo "<br>";
    echo $index_resultArray02[3]['p_cat_id'];echo "<br>";

    echo $index_num_rows_01; echo "<br>";
    echo $index_num_rows_02; echo "<br>";*/

        /*for($i=0; $i<$index_num_rows_01;$i++) {
            echo $i; echo "<br>";
            for($j=0; $j<(sizeof($index_resultArray02));$j++) {
                echo ".      ."; echo $j; echo "<br>"; 
            }
        }*/

        for($i=0; $i<$index_num_rows_01;$i++) {
            /*echo $i;echo "<br>";*/
            /*echo $index_resultArray01[$i]['cat_title'];echo "<br>";*/
            for($j=($i*2); $j<(($i*2)+2);$j++) {
                /*echo $j;echo "<br>";
                echo $index_resultArray02[$j]['p_cat_title'];echo "<br>";*/
                include "includes/php/categories-slick-slider.php";
            }
        }
    
    include "includes/php/instagram.php";
    include "includes/php/footer.php";
?>