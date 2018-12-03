
    <?php
        /*$row="";*/
        $i = 0;

        /*$resultArray = array();
        $resultlog = mysqli_query($con, "SELECT * from product_categories");
            while($row = mysqli_fetch_array($resultlog)) {
                $resultArray[] = $row;
            }
        print_r($resultArray);

        echo "<br>";*/

        $resultArray02 = array();
        $css_query_01 = "select * from categories where cat_title='Moda Praia'";
        $css_result_01 = mysqli_query($con, $css_query_01);
        while($row = mysqli_fetch_array($css_result_01)) {
            $lt = $row['cat_id'];
            $an = $row['cat_title'];
                /*echo "<script>alert(".$lt.")</script>";
                echo $lt; echo "<br>";
                echo $an;
                $resultArray02=$row;*/
        }

        /*print_r($resultArray02);*/

        /*echo "<br>";echo "cccccccccccccccccccccccccccccccccccccccccccccccccccccccccc";*/
        
        $resultArray03 = array();
        $css_query_02 = "select * from products where cat_id = " . $lt;
        /*echo $css_query_02;echo "<br>";echo "*************************************************";*/
        $css_result_02 = mysqli_query($con, $css_query_02);
        /*print_r($css_result_02);echo "<br>";echo "*************************************************";*/
        $num_rows_array = mysqli_num_rows($css_result_02);
        /*echo $num_rows_array;echo "<br>";echo "*************************************************";*/
        while($row = mysqli_fetch_array($css_result_02)) {
            $resultArray03[] = $row;
        }
            /*print_r($resultArray03);echo "<br>";echo "cccccccccccccccccccccccccccccccccccccccccccccccccccccccc";
            echo implode(', ', $resultArray03[0]);
            echo "<br><br>";
            echo $resultArray03[0][0];echo "<br>";
            echo $resultArray03[0]['product_id'];echo "<br>";
            echo $resultArray03[0]['product_features'];echo "<br>";
            echo $resultArray03[0]['product_keywords'];echo "<br>";
            echo $resultArray03[0]['product_label'];echo "<br>";
            echo $resultArray03[0]['product_type'];echo "<br>";
            echo $resultArray03[0]['product_img1'];echo "<br>";
            echo $resultArray03[0]['product_img2'];echo "<br>";
            echo $resultArray03[0]['product_title'];echo "<br>";
            echo $resultArray03[0]['product_price'];echo "<br>";*/
    ?>
    
    <div class="slick-slider-container">
        <div class="slick-slider-title"><?php echo $an ?></div>
            <div class="slider2">
                <?php
                    while($i < $num_rows_array) {
                        echo '              <!--/****************************************************************************************************/-->';
                        echo '              <div class="abc">';
                        echo '                  <div class="product-slider">';
                        echo '                      <div class="product-slider-wrapper">';
                        echo '                          <div class="product-slider-card">';
                        echo '                              <div class="product-slider-image-container">';
                        echo '                                  <img src="/product_images/'; echo $resultArray03[$i]['product_img1']; echo '" alt="" class="product-img-card">';
                        echo '                              </div>';
                        echo '                              <i class="fas fa-heart fa-3x product-slider-icon"></i>';
                        echo '                              <p class="product-slider-nome">'; echo $resultArray03[$i]['product_title']; echo '</p>';
                        echo '                              <p class="product-slider-price">'; echo $resultArray03[$i]['product_price']; echo '</p>';
                        echo '                          </div>';
                        echo '                      </div>';
                        echo '                  </div>';
                        echo '              </div>';
                        $i++;
                    }
                ?>
            </div>
        </div>
    </div>
