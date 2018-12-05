
    <?php
        $k = 0;

        $resultArray02 = array();
        $css_query_01 = "select * from categories where cat_title = '" . $index_resultArray01[$i]['cat_title'] . "'";
        /*echo $css_query_01; echo "<br>";*/
        $css_result_01 = mysqli_query($con, $css_query_01);
        while($row = mysqli_fetch_array($css_result_01)) {
            $lt = $row['cat_id'];
            $an = $row['cat_title'];
        }

        $resultArray03 = array();
        $css_query_02 = "select * from products where p_cat_id = '" . $index_resultArray02[$j]['p_cat_id'] . "'";
        /*echo $css_query_02; echo "<br>";*/
        $css_result_02 = mysqli_query($con, $css_query_02);
        $num_rows_array = mysqli_num_rows($css_result_02);
        /*echo "Num de Rows: ";echo $num_rows_array;echo "<br>";echo "*************************************************";*/
        while($row = mysqli_fetch_array($css_result_02)) {
            $resultArray03[] = $row;
        }
        echo $i;echo"<br>";echo $j;echo"<br>";
    ?>
    
    <div class="slick-slider-container">
        <div class="slick-slider-title"><?php echo $index_resultArray02[$j]['p_cat_title'] ?></div>
            <div class="slider2">
                <?php
                    while($k < $num_rows_array) {
                        echo '              <!--/****************************************************************************************************/-->';
                        echo '              <div class="abc">';
                        echo '                  <div class="product-slider">';
                        echo '                      <div class="product-slider-wrapper">';
                        echo '                          <div class="product-slider-card">';
                        echo '                              <div class="product-slider-image-container">';
                        echo '                                  <img src="/product_images/'; echo $resultArray03[$k]['product_img1']; echo '" alt="" class="product-img-card">';
                        echo '                              </div>';
                        echo '                              <i class="fas fa-heart fa-3x product-slider-icon"></i>';
                        echo '                              <p class="product-slider-nome">'; echo $resultArray03[$k]['product_title']; echo '</p>';
                        echo '                              <p class="product-slider-price">R$ '; echo $resultArray03[$k]['product_price']; echo '</p>';
                        echo '                              <form action="product-page.php" class="slick-add-button" method="POST">';
                        echo '                                  <input type="hidden" name="incoming_product_id" value="' . $resultArray03[$k]['product_id'] . '">';
                        echo '                                  <input type="submit" value="Comprar" class="product-slider-submit">';
                        echo '                              </form>';
                        echo '                          </div>';
                        echo '                      </div>';
                        echo '                  </div>';
                        echo '              </div>';
                        $k++;
                    }
                ?>
            </div>
        </div>
    </div>
