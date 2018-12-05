  
        <div class="span6-r">
            <h3>
                <?php
                    echo $product_buy_resultArray[0]['product_title'];
                    $size = false;
                    $ip_address = getRealUserIp();
                ?>
            </h3>
            <p>CÓDIGO: </p>
            <?php
                echo $product_buy_resultArray[0]['date'];
            ?>

            <?php
                if($product_buy_resultArray[0]['cat_id'] == '8') {
                    $size = true;
                    echo '  <div>';
                    echo '      <p class="product-buy-label">Selecione Tamanho</p>';
                    echo '      <ul class="product-buy-ul" id="sizes">';
                    echo '          <li id="Pequeno" class="size-button">P</li>';
                    echo '          <li id="Médio" class="size-button">M</li>';
                    echo '          <li id="Grande" class="size-button">G</li>';
                    echo '      </ul>';
                    echo '  </div>';
                    echo '  <div>Tamanho Escolhido: <p id="size_label"></p></div>';
                }
            ?>

            <div class="product-buy-price">
                <p>R$ 
                    <?php
                        echo $product_buy_resultArray[0]['product_price'];
                    ?>
                </p>
            </div>
            <form action="product-page.php" class="product-buy-form" method="POST">
                <label for="product-buy-number">Quantidade: </label>
                <input type="number" name="product-buy-number" class="product-buy-number"><br>
                <?php
                    echo "<input type='hidden' name='product-id' value='" . $product_buy_resultArray[0]['product_id'] . "' />";
                ?>
                <?php
                    if($product_buy_resultArray[0]['cat_id'] == '8') {
                        echo "<input type='hidden' id='product-size' name='product-size' value='' />";
                    }
                ?>
                <?php
                    echo "<input type='hidden' name='product-price' value='" . $product_buy_resultArray[0]['product_price'] . "' />";
                ?>
                <?php
                    echo "<input type='hidden' name='ip-address' value='" . $ip_address . "' />";
                ?>
                <button name="product_buy_submit" class="product-buy-button">Comprar</button>
            </form>
            <p class="product-buy-label">Pagamento via PagSeguro</p>
            <img src="/images/pagseguro.png" alt="" width="300px" height="auto">
        </div>
    </div>
