<?php    
    include "includes/php/header.php";
    include "includes/php/social-bar.php";
    include "includes/php/top-bar.php";
    include "includes/php/navbar.php";

    include "functions.php";

    $ip_add = getRealUserIp();
    
    $order_cart_resultArray = array();
    $order_product_resultArray = array();
    $order_client_resultArray = array();
    $order_address_resultArray = array();

    $qty_total = 0;
    $price_total = 0;

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
    
    $order_client_query = "select * from customers where customer_ip='$ip_add'";
    $order_client_result = mysqli_query($con, $order_client_query);
    $order_client_count = mysqli_num_rows($order_client_result);
    while($row = mysqli_fetch_array($order_client_result)) {
        $order_client_resultArray[] = $row;
    }

    $order_address_query = "select * from customers_addresses where customer_id='" . $order_client_resultArray[0]['customer_id'] . "'";
    $order_address_result = mysqli_query($con, $order_address_query);
    $order_address_count = mysqli_num_rows($order_address_result);
    while($row = mysqli_fetch_array($order_address_result)) {
        $order_address_resultArray[] = $row;
    }
    
    /*echo "<br>"; echo $order_client_resultArray[0]['customer_id']; echo "<br>";
    print_r($order_address_resultArray); echo "<br>"; echo "<br>";
    echo $order_address_resultArray[0]['billing_country']; echo "<br>";*/
?>

    <div class="review_order">
        <div class="review_order_product_wrapper">
            <?php
                for($i=0; $i<sizeof($order_product_resultArray);$i++) {
                    echo "  <div class='review_order_product_box'>";
                    echo "      <div class='review_order_product_image_half'>";
                    echo "          <img src='/product_images/" . $order_product_resultArray[$i]['product_img1'] . "' alt='' class='review_order_image'>";
                    echo "      </div>";
                    echo "      <div class='review_order_product_text_half'>";
                    echo "          <ul>";
                    echo "              <li class='review_order_name'>Nome: " . $order_product_resultArray[$i]['product_title'] . "</li>";
                    echo "              <li class='review_order_qty'>Quantidade: " . $order_cart_resultArray[$i]['qty'] . "</li>";
                    echo "              <li class='review_order_price'>Preço: R$ " . $order_product_resultArray[$i]['product_price'] . "</li>";
                    echo "          </ul>";
                    echo "      </div>";
                    echo "  </div>";
                    
                    $qty_total += $order_cart_resultArray[$i]['qty'];
                    $price_total += ($order_product_resultArray[$i]['product_price'] * $order_cart_resultArray[$i]['qty']);
                }
            ?>
        </div>
        <div class="review_order_product_order_summary">
            <div class="review_order_product_item"><span>Sumário da Ordem</span></div>
            <div class="review_order_product_total"><span>Total R$: <?php echo $qty_total ?></span></div>
            <div class="review_order_product_total_items"><span>Quantidade: <?php echo $price_total ?></span></div>
            <br>
            <div class="review_order_product_frete"><span>Frete</span></div>
            <div class="review_order_product_valor"><span>Valor: R$ 50,00</span></div>
            <br>
            <form action="review-order.php" method="POST">
                <input type="submit" name="review_order_buy" value="Pagamento" class="review_order_buy">
            </form>
        </div>
    </div>

    <div class="address_box">
        <div class="delivery-address">
            <form action="">
                <div style="text-align: left; font-size: 2rem; padding-bottom: 1rem;">Endereço de Entrega</div>
                <label for="delivery-address-name">Nome: </label>
                <input type="text" name="delivery-address-name" value="<?php echo $order_address_resultArray[0]['billing_first_name']; echo " "; echo $order_address_resultArray[0]['billing_last_name']; ?>" class="order-adress-input">
                <label for="delivery-address-street">Rua: </label>
                <input type="text" name="delivery-address-street" value="<?php echo $order_address_resultArray[0]['billing_address_1']; ?>" class="order-adress-input">
                <label for="delivery-address-number">Número: </label>
                <input type="text" name="delivery-address-number" value="<?php echo $order_address_resultArray[0]['billing_number'] ?>" class="order-adress-input">
                <label for="delivery-address-complement">Complemento: </label>
                <input type="text" name="delivery-address-complement" value="<?php echo $order_address_resultArray[0]['billing_complement']; ?>" class="order-adress-input">
                <label for="delivery-address-zone">Bairro: </label>
                <input type="text" name="delivery-address-zone" value="<?php echo $order_address_resultArray[0]['billing_zone']; ?>" class="order-adress-input">
                <label for="delivery-address-city">Cidade: </label>
                <input type="text" name="delivery-address-city" value="<?php echo $order_address_resultArray[0]['billing_city']; ?>" class="order-adress-input">
                <label for="delivery-address-state">Estado: </label>
                <input type="text" name="delivery-address-state" value="<?php echo $order_address_resultArray[0]['billing_state']; ?>" class="order-adress-input">
                <label for="delivery-address-zipcode">CEP: </label>
                <input type="text" name="delivery-address-zipcode" value="<?php echo $order_address_resultArray[0]['billing_postcode']; ?>" class="order-adress-input">
            </form>
        </div>
        <div class="billing-address">
            <!--<form action="">
                <label for="billing-address-name">Nome: </label>
                <input type="text" name="billing-address-name" value="">
                <label for="billing-address-street">Rua: </label>
                <input type="text" name="billing-address-street" value="">
                <label for="billing-address-number">Número: </label>
                <input type="text" name="billing-address-number" value="">
                <label for="billing-address-complement">Complemento: </label>
                <input type="text" name="billing-address-complement" value="">
                <label for="billing-address-zone">Bairro: </label>
                <input type="text" name="billing-address-zone" value="">
                <label for="billing-address-city">Cidade: </label>
                <input type="text" name="billing-address-city" value="">
                <label for="billing-address-state">Estado: </label>
                <input type="text" name="billing-address-state" value="">
                <label for="billing-address-zipcode">CEP: </label>
                <input type="text" name="billing-address-zipcode" value="">
            </form>-->
        </div>
    </div>

<?php
    /*echo "<form>";
    echo "<label>Endereço de Entrega:</label>";
    echo "<input type='text' name='checkout_shipping_customer_name' value=''>";
    echo "<input type='textarea' name='checkout_shipping_customer_address' value=''>";
    echo "<label>Endereço de Cobrança:</label>";
    echo "<input type='text' name='checkout_payment_customer_name' value=''>";
    echo "<input type='textarea' name='checkout_payment_customer_address' value=''>";
    echo "</form>";*/

    echo "<div></div>";

    include "includes/php/footer.php";
?>

<?php
    if(isset($_POST['review_order_buy'])) {
        //[ORDERS]
        $customer_id = $order_client_resultArray[0]['customer_id'];
        $shipping_cost = 50.00;
        $order_date = (new \DateTime())->format('Y-m-d H:i:s');
        $order_total = 150.00;
        $order_status = 'processing';

        $order_query = "insert into orders (customer_id, shipping_cost, order_date, order_total, order_status) 
                        values ('$customer_id', '$shipping_cost', '$order_date', '$order_total', '$order_status')";
        $order_result = mysqli_query($con, $order_query);
        $last_id = mysqli_insert_id($con);

        //[ORDER_ADDRESSES]         [CUSTOMERS_ADDRESSES]
        $order_id		            = $last_id;
        $billing_first_name         = $order_address_resultArray[0]['billing_first_name'];
        $billing_last_name	        = $order_address_resultArray[0]['billing_last_name'];
        $billing_country	        = $order_address_resultArray[0]['billing_country'];
        $billing_address_1	        = $order_address_resultArray[0]['billing_address_1'];
        $billing_zone		        = $order_address_resultArray[0]['billing_zone'];
        $billing_complement	        = $order_address_resultArray[0]['billing_complement'];
        $billing_number		        = $order_address_resultArray[0]['billing_number'];
        $billing_state		        = $order_address_resultArray[0]['billing_state'];
        $billing_city		        = $order_address_resultArray[0]['billing_city'];
        $billing_postcode	        = $order_address_resultArray[0]['billing_postcode'];
        $is_shipping_address_same   = 'yes';
        $shipping_first_name	    = $order_address_resultArray[0]['shipping_first_name'];
        $shipping_last_name	        = $order_address_resultArray[0]['shipping_last_name'];
        $shipping_country	        = $order_address_resultArray[0]['shipping_country'];
        $shipping_address_1	        = $order_address_resultArray[0]['shipping_address_1'];
        $shipping_zone		        = $order_address_resultArray[0]['shipping_zone'];
        $shipping_complement	    = $order_address_resultArray[0]['shipping_complement'];
        $shipping_number		    = $order_address_resultArray[0]['shipping_number'];
        $shipping_state		        = $order_address_resultArray[0]['shipping_state'];
        $shipping_city		        = $order_address_resultArray[0]['shipping_city'];
        $shipping_postcode	        = $order_address_resultArray[0]['shipping_postcode'];

        $order_addresses_resultArray = array();
        $order_addresses_query = "insert into orders_addresses (order_id, billing_first_name, billing_last_name, billing_country, billing_address_1, billing_zone, billing_complement, 
                                                    billing_number, billing_state, billing_city, billing_postcode, is_shipping_address_same, shipping_first_name, 
                                                    shipping_last_name, shipping_country, shipping_address_1, shipping_zone, shipping_complement, shipping_number, 
                                                    shipping_state, shipping_city, shipping_postcode) 
                                values ('$order_id', '$billing_first_name', '$billing_last_name', '$billing_country', '$billing_address_1', '$billing_zone', '$billing_complement', 
                                        '$billing_number', '$billing_state', '$billing_city', '$billing_postcode', '$is_shipping_address_same', '$shipping_first_name', 
                                        '$shipping_last_name', '$shipping_country', '$shipping_address_1', '$shipping_zone', '$shipping_complement', '$shipping_number', '$shipping_state', 
                                        '$shipping_city', '$shipping_postcode')";

        $order_addresses_result = mysqli_query($con, $order_addresses_query);

        //[ORDERS_ITEMS]
        $order_id = $last_id;
        $price = array();
        $qty = array();
        $size = array();
        for($i=0; $i<sizeof($order_cart_resultArray); $i++) {
            $price[$i] = $order_cart_resultArray[$i]['p_price'];
            $qty[$i] = $order_cart_resultArray[$i]['qty'];
            $size[$i] = $order_cart_resultArray[$i]['size'];
        }
        $order_items_resultArray = array();
        for($i=0; $i<sizeof($price); $i++) {
            $order_items_query = "insert into orders_items (order_id, price, qty, size) values ('$order_id', '{$price[$i]}', '{$qty[$i]}', '{$size[$i]}')";
            echo $order_items_query; echo "<br>";
            $order_items_result = mysqli_query($con, $order_items_query);
        }
    }
?>

    <!--foreach ($order_cart_resultArray as $value) {
        print_r($value);
    }

    echo "$order_cart_count"; echo "<br>";
    echo "$order_product_count"; echo "<br>";
    
    foreach ($order_product_resultArray as $value) {
        print_r($value);
    }

    for($i=0; $i<sizeof($order_cart_resultArray); $i++) {
        echo $order_cart_resultArray[$i]['cart_id']; echo "<br>";
        echo $order_cart_resultArray[$i]['p_id']; echo "<br>";
        echo $order_cart_resultArray[$i]['ip_add']; echo "<br>";
        echo $order_cart_resultArray[$i]['qty']; echo "<br>";
        echo $order_cart_resultArray[$i]['p_price']; echo "<br>";
        echo $order_cart_resultArray[$i]['size']; echo "<br>"; echo "<br>";
    }

    echo "<br>";

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
        echo $order_product_resultArray[$i]['product_desc']; echo "<br>"; echo "<br>";
    }

    echo "<br>";

    for($i=0; $i<sizeof($order_client_resultArray); $i++) {
        echo $order_client_resultArray[$i]['customer_id']; echo "<br>";
        echo $order_client_resultArray[$i]['customer_name']; echo "<br>";
        echo $order_client_resultArray[$i]['customer_email']; echo "<br>";
        echo $order_client_resultArray[$i]['customer_pass']; echo "<br>";
        echo $order_client_resultArray[$i]['customer_country']; echo "<br>";
        echo $order_client_resultArray[$i]['customer_city']; echo "<br>";
        echo $order_client_resultArray[$i]['customer_ip']; echo "<br>";
        echo $order_client_resultArray[$i]['customer_address']; echo "<br>";
    }
                                    
-->