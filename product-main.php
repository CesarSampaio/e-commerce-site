
    <div class="product-buy-wrapper">
        <div class="span6-l">
            <div class="product-container-image">
                <?php
                    echo '<img src="/product_images/';
                    echo $product_buy_resultArray[0]['product_img1'];
                    echo '"';
                    echo ' alt="Maiô Verde| Body Decote" id="imagemProduto" itemprop="image" width="600" height="800">';
                ?>
            </div>

            <div class="picture-slider-container">
                <div class="slider3">
                    <!--/***************************************************************************/-->
                    <div class="product-thumbnails">
                        <?php
                            echo '<img id="thumbnails1" src="/product_images/';
                            echo $product_buy_resultArray[0]['product_img2'];
                            echo '"';
                            echo ' alt="" onClick="markActiveLink(this.id)">';
                        ?>
                    </div>

                    <!--/***************************************************************************/-->
                    <div class="product-thumbnails">
                        <?php
                            echo '<img id="thumbnails2" src="/product_images/';
                            echo $product_buy_resultArray[0]['product_img3'];
                            echo '"';
                            echo ' alt="" onClick="markActiveLink(this.id)">';
                        ?>
                    </div>

                    <!--/***************************************************************************/-->
                    <div class="product-thumbnails">
                        <?php
                            echo '<img id="thumbnails3" src="/product_images/';
                            echo $product_buy_resultArray[0]['product_img4'];
                            echo '"';
                            echo ' alt="" onClick="markActiveLink(this.id)">';
                        ?>
                    </div>

                    <!--/***************************************************************************/-->
                    <div class="product-thumbnails">
                        <?php
                            echo '<img id="thumbnails4" src="/product_images/';
                            echo $product_buy_resultArray[0]['product_img5'];
                            echo '"';
                            echo ' alt="" onClick="markActiveLink(this.id)">';
                        ?>
                    </div>
                    
                    <!--/***************************************************************************/-->
                    <div class="product-thumbnails">
                        <?php
                            echo '<img id="thumbnails5" src="/product_images/';
                            echo $product_buy_resultArray[0]['product_img6'];
                            echo '"';
                            echo ' alt="" onClick="markActiveLink(this.id)">';
                        ?>
                    </div>
                </div>
            </div>
        </div>
