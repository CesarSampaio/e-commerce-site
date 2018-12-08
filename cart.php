<?php
    session_start();
    include "includes/php/db.php";
    include("functions.php");
    mysqli_set_charset($con, "utf8")
?>

<?php
    include "includes/php/header.php";
    include "includes/php/social-bar.php";
    include "includes/php/top-bar.php";
    include "includes/php/navbar.php";
?>

    <div id="content" ><!-- content Starts -->
        <div class="container" ><!-- container Starts -->
            <div class="col-md-9" id="cart" ><!-- col-md-9 Starts -->
                <div class="box" ><!-- box Starts -->
                    <form action="cart.php" method="post" enctype="multipart-form-data" ><!-- form Starts -->
                        <h1> Carrinho de Compras </h1>
                        <?php
                            $ip_add = getRealUserIp();
                            $select_cart = "select * from cart where ip_add='$ip_add'";
                            $run_cart = mysqli_query($con, $select_cart);
                            $count = mysqli_num_rows($run_cart);
                        ?>
                        <p class="text-muted" > Você tem no momento <?php echo items(); ?> item(s) no seu carrinho. </p>
                        <div class="table-responsive" ><!-- table-responsive Starts -->
                            <table class="table" ><!-- table Starts -->
                                <thead><!-- thead Starts -->
                                    <tr>
                                        <th colspan="2" >Produto</th>
                                        <th>Quantidade: </th>
                                        <th>Preço Unitário: </th>
                                        <th>Tamanho: </th>
                                        <th colspan="1">Deletar</th>
                                        <th colspan="2"> SubTotal </th>
                                    </tr>
                                </thead><!-- thead Ends -->
                                <tbody id="cart-products-tbody"><!-- tbody Starts -->
                                    <?php
                                        $total = 0;
                                        $total_weight = 0;
                                        $physical_products = array();
                                        while($row_cart = mysqli_fetch_array($run_cart)) {
                                            $pro_id = $row_cart['p_id'];
                                            $pro_size = $row_cart['size'];
                                            $pro_qty = $row_cart['qty'];
                                            $only_price = $row_cart['p_price'];
                                            $get_products = "select * from products where product_id='$pro_id'";
                                            $run_products = mysqli_query($con, $get_products);
                                            while($row_products = mysqli_fetch_array($run_products)) {
                                                $product_title = utf8_encode($row_products['product_title']);
                                                $product_img1 = $row_products['product_img1'];
                                                $product_type = $row_products['product_type'];
                                                $product_weight = $row_products['product_weight'];
                                                $sub_total_weight = $product_weight * $pro_qty;
                                                $total_weight += $sub_total_weight;
                                                if($product_type == "physical_product" ) {
                                                    array_push($physical_products, $pro_id);
                                                }
                                                $sub_total = $only_price*$pro_qty;
                                                $_SESSION['pro_qty'] = $pro_qty;
                                                $total += $sub_total;
                                    ?>
                                                <tr><!-- tr Starts -->
                                                    <td>
                                                        <img src="product_images/<?php echo $product_img1; ?>" >
                                                    </td>
                                                    <td>
                                                        <a href="#" > <?php echo utf8_encode($product_title); ?> </a>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="quantity" value="<?php echo $_SESSION['pro_qty']; ?>" data-product_id="<?php echo $pro_id; ?>" class="quantity form-control">
                                                    </td>
                                                    <td>
                                                        R$<?php echo $only_price; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $pro_size; ?>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>">
                                                    </td>
                                                    <td>
                                                        R$<?php echo $sub_total; ?>
                                                    </td>
                                                </tr><!-- tr Ends -->
                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody><!-- tbody Ends -->
                                <tfoot><!-- tfoot Starts -->
                                    <tr>
                                        <th colspan="5"> Total: </th>
                                        <th colspan="2"> <span class="subtotal-cart-price">R$<?php echo $total; ?></span></th>
                                    </tr>
                                </tfoot><!-- tfoot Ends -->
                            </table><!-- table Ends -->
                            <div class="form-inline pull-right"><!-- form-inline pull-right Starts -->
                                <div class="form-group"><!-- form-group Starts -->
                                    <label>Código de Cupom: </label>
                                    <input type="text" name="code" class="form-control">
                                </div><!-- form-group Ends -->
                                    <input class="btn btn-primary" type="submit" name="apply_coupon" value="Código do Cupom" >
                            </div><!-- form-inline pull-right Ends -->
                        </div><!-- table-responsive Ends -->
                        <div class="box-footer"><!-- box-footer Starts -->
                            <div class="pull-left"><!-- pull-left Starts -->
                                <a href="index.php" class="btn btn-default">
                                    <i class="fa fa-chevron-left"></i> Continue Suas Compras
                                </a>
                            </div><!-- pull-left Ends -->
                            <div class="pull-right"><!-- pull-right Starts -->
                                <button class="btn btn-default" type="submit" name="update" value="Update Cart">
                                    <i class="fa fa-refresh"></i> Atualizar Carrinho
                                </button>
                                <a href="checkout.php" class="btn btn-primary">
                                    Finalizar Compra <i class="fa fa-chevron-right"></i>
                                </a>
                            </div><!-- pull-right Ends -->
                        </div><!-- box-footer Ends -->
                    </form><!-- form Ends -->
                </div><!-- box Ends -->
    
                <?php
                    if(isset($_POST['apply_coupon'])) {
                        $code = $_POST['code'];
                        if($code == "") {
                        } else {
                            $get_coupons = "select * from coupons where coupon_code='$code'";
                            $run_coupons = mysqli_query($con,$get_coupons);
                            $check_coupons = mysqli_num_rows($run_coupons);
                            if($check_coupons == 1) {
                                $row_coupons = mysqli_fetch_array($run_coupons);
                                $coupon_pro = $row_coupons['product_id'];
                                $coupon_price = $row_coupons['coupon_price'];
                                $coupon_limit = $row_coupons['coupon_limit'];
                                $coupon_used = $row_coupons['coupon_used'];
                                if($coupon_limit == $coupon_used) {
                                    echo "<script>alert('Your Coupon Code Has Been Expired')</script>";
                                } else {
                                    $get_cart = "select * from cart where p_id='$coupon_pro' AND ip_add='$ip_add'";
                                    $run_cart = mysqli_query($con,$get_cart);
                                    $check_cart = mysqli_num_rows($run_cart);
                                    if($check_cart == 1) {
                                        $add_used = "update coupons set coupon_used=coupon_used+1 where coupon_code='$code'";
                                        $run_used = mysqli_query($con,$add_used);
                                        $update_cart = "update cart set p_price='$coupon_price' where p_id='$coupon_pro' AND ip_add='$ip_add'";
                                        $run_update = mysqli_query($con,$update_cart);
                                        echo "<script>alert('Seu cupom foi aplicado')</script>";
                                        echo "<script>window.open('cart.php','_self')</script>";
                                    } else {
                                        echo "<script>alert('Produto Não Existe No Carrinho')</script>";
                                    }
                                }
                            } else {
                                echo "<script> alert('Seu Código de Cupom Não é Válido') </script>";
                            }
                        }
                    }
                ?>

                <?php
                    function update_cart() {
                        global $con;
                        if(isset($_POST['update'])) {
                            foreach($_POST['remove'] as $remove_id) {
                                $delete_product = "delete from cart where p_id='$remove_id'";
                                $run_delete = mysqli_query($con,$delete_product);
                                if($run_delete) {
                                    echo "<script>window.open('cart.php','_self')</script>";
                                }
                            }
                        }
                    }
                    echo @$up_cart = update_cart();
                ?>
    
                <div id="row same-height-row"><!-- row same-height-row Starts -->
                    <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Starts -->
                        <div class="box same-height headline"><!-- box same-height headline Starts -->
                            <h3 class="text-center"> Você pode gostar desses produtos: </h3>
                        </div><!-- box same-height headline Ends -->
                    </div><!-- col-md-3 col-sm-6 Ends -->
                    <?php
                        $get_products = "select * from products order by rand() LIMIT 0,3";
                        $run_products = mysqli_query($con, $get_products);
                        while($row_products=mysqli_fetch_array($run_products)) {
                            $pro_id = $row_products['product_id'];
                            $pro_title = $row_products['product_title'];
                            $pro_price = $row_products['product_price'];
                            $pro_img1 = $row_products['product_img1'];
                            $pro_label = $row_products['product_label'];
                            $manufacturer_id = $row_products['manufacturer_id'];
                            $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";
                            $run_manufacturer = mysqli_query($db,$get_manufacturer);
                            $row_manufacturer = mysqli_fetch_array($run_manufacturer);
                            $manufacturer_name = $row_manufacturer['manufacturer_title'];
                            $pro_psp_price = $row_products['product_psp_price'];
                            $pro_url = $row_products['product_url'];
                            if($pro_label == "Sale" or $pro_label == "Gift"){
                                $product_price = "<del> $$pro_price </del>";
                                $product_psp_price = "| $$pro_psp_price";
                            } else {
                                $product_psp_price = "";
                                $product_price = "$$pro_price";
                            }
                            if($pro_label == "") {
                            } else {
                                $product_label = "
                                    <a class='label sale' href='#' style='color:black;'>
                                        <div class='thelabel'>$pro_label</div>
                                        <div class='label-background'> </div>
                                    </a>
                                    ";
                            }
                            echo "
                                <div class='col-md-3 col-sm-6 center-responsive' >
                                    <div class='product' >
                                        <a href='$pro_url' >
                                            <img src='product_images/$pro_img1' class='img-responsive' >
                                        </a>
                                        <div class='text' >
                                            <hr>
                                            <h3><a href='$pro_url' >$pro_title</a></h3>
                                            <p class='price' > $product_price $product_psp_price </p>
                                            <p class='buttons' >
                                                <a href='$pro_url' class='btn btn-default' >Ver detalhes</a>
                                                <a href='$pro_url' class='btn btn-primary'>
                                                    <i class='fa fa-shopping-cart'></i> Comprar
                                                </a>
                                            </p>
                                        </div>
                                        $product_label
                                    </div>
                                </div>
                                ";
                        }
                    ?>
                </div><!-- row same-height-row Ends -->
            </div><!-- col-md-9 Ends -->

            <div class="col-md-3"><!-- col-md-3 Starts -->
                <div class="box" id="order-summary"><!-- box Starts -->
                    <div class="box-header"><!-- box-header Starts -->
                        <h3>Resumo da Ordem</h3>
                    </div><!-- box-header Ends -->
                    <p class="text-muted">
                        Frete e Custos Adicionais são calculados com Base nos Valores
                        <!--Shipping and additional costs are calculated based on the values you have entered.-->
                    </p>
                    <div class="table-responsive"><!-- table-responsive Starts -->
                        <table class="table"><!-- table Starts -->
                            <tbody id="cart-summary-tbody"><!-- tbody Starts -->
                                <tr>
                                    <td> Subtotal da Ordem: </td>
                                    <th> R$<?php echo $total; ?></th>
                                </tr>   
                                
                                <?php if(count($physical_products) > 0) { ?>
                                
                                <tr>
                                    <th colspan="2">
                                        <p class="shipping-header text-muted">
                                            Peso Total da Ordem: <?php echo $total_weight; ?> Kg
                                        </p>
                                        <p class="shipping-header text-muted">
                                            <i class="fa fa-truck"></i> Frete:
                                        </p>
                                        <ul class="list-unstyled"><!-- ul list-unstyled Starts -->
                                            <?php
                                                if(isset($_SESSION['customer_email'])) {
                                                    $customer_email = $_SESSION['customer_email'];
                                                    $get_customer = "select * from customers where customer_email='$customer_email'";
                                                    $run_customer = mysqli_query($con, $get_customer);
                                                    $row_customer = mysqli_fetch_array($run_customer);
                                                    $customer_id = $row_customer['customer_id'];
                                                    $select_customers_addresses = "select * from customers_addresses where customer_id='$customer_id'";
                                                    $run_customers_addresses = mysqli_query($con, $select_customers_addresses);
                                                    $row_customers_addresses = mysqli_fetch_array($run_customers_addresses);
                                                    $billing_country = $row_customers_addresses['billing_country'];
                                                    $billing_postcode = $row_customers_addresses['billing_postcode'];
                                                    $shipping_country = $row_customers_addresses['shipping_country'];
                                                    $shipping_postcode = $row_customers_addresses['shipping_postcode'];
                                                    $shipping_zone_id = "";
                                                    if(@$_SESSION["is_shipping_address_same"] == "yes") {
                                                        if(empty($billing_country) and empty($billing_postcode)) {
                                                            echo "
                                                                    <li>
                                                                        <p>
                                                                            Não há opções de frete com base nos dados digitados. Por favor cheque seu endereço novamente ou entere em contato conosco.
                                                                        </p>
                                                                    </li>
                                                                ";
                                                        }
                                                        $select_zones = "select * from zones order by zone_order DESC";	
                                                        $run_zones = mysqli_query($con, $select_zones);
                                                        while($row_zones = mysqli_fetch_array($run_zones)) {
                                                            $zone_id = $row_zones['zone_id'];
                                                            $select_zones_locations = "select DISTINCT zone_id from zones_locations where zone_id='$zone_id' and (location_code='$billing_country' and location_type='country')";
                                                            $run_zones_locations = mysqli_query($con, $select_zones_locations);
                                                            $count_zones_locations = mysqli_num_rows($run_zones_locations);
                                                            if($count_zones_locations != "0") {
                                                                $row_zones_locations = mysqli_fetch_array($run_zones_locations);
                                                                $zone_id = $row_zones_locations["zone_id"];
                                                                $select_zone_shipping = "select * from shipping where shipping_zone='$zone_id'";
                                                                $run_zone_shipping = mysqli_query($con, $select_zone_shipping);
                                                                $count_zone_shipping = mysqli_num_rows($run_zone_shipping);
                                                                if($count_zone_shipping != "0") {
                                                                    $select_zone_postcodes = "select * from zones_locations where zone_id='$zone_id' and location_type='postcode'";
                                                                    $run_zone_postcodes = mysqli_query($con, $select_zone_postcodes);
                                                                    $count_zone_postcodes = mysqli_num_rows($run_zone_postcodes);
                                                                    if($count_zone_postcodes != "0") {
                                                                        while($row_zones_postcodes = mysqli_fetch_array($run_zone_postcodes)){
                                                                            $location_code = $row_zones_postcodes["location_code"];
                                                                            if($location_code == $billing_postcode){
                                                                                $shipping_zone_id = $zone_id;
                                                                            }
                                                                        }
                                                                    } else {
                                                                        $shipping_zone_id = $zone_id;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    } elseif(@$_SESSION["is_shipping_address_same"] == "no") {
                                                        if(empty($shipping_country) and empty($shipping_postcode)) {
                                                            echo "
                                                                    <li>
                                                                        <p>
                                                                            Não há opções de frete com base nos dados digitados. Por favor cheque seu endereço novamente ou entere em contato conosco.
                                                                        </p>
                                                                    </li>
                                                                ";
                                                        }
                                                        $select_zones = "select * from zones order by zone_order DESC";	
                                                        $run_zones = mysqli_query($con, $select_zones);
                                                        while($row_zones = mysqli_fetch_array($run_zones)){
                                                            $zone_id = $row_zones['zone_id'];
                                                            $select_zones_locations = "select DISTINCT zone_id from zones_locations where zone_id='$zone_id' and (location_code='$shipping_country' and location_type='country')";
                                                            $run_zones_locations = mysqli_query($con, $select_zones_locations);
                                                            $count_zones_locations = mysqli_num_rows($run_zones_locations);
                                                            if($count_zones_locations != "0"){
                                                                $row_zones_locations = mysqli_fetch_array($run_zones_locations);
                                                                $zone_id = $row_zones_locations["zone_id"];
                                                                $select_zone_shipping = "select * from shipping where shipping_zone='$zone_id'";
                                                                $run_zone_shipping = mysqli_query($con, $select_zone_shipping);
                                                                $count_zone_shipping = mysqli_num_rows($run_zone_shipping);
                                                                if($count_zone_shipping != "0"){
                                                                    $select_zone_postcodes = "select * from zones_locations where zone_id='$zone_id' and location_type='postcode'";
                                                                    $run_zone_postcodes = mysqli_query($con, $select_zone_postcodes);
                                                                    $count_zone_postcodes = mysqli_num_rows($run_zone_postcodes);
                                                                    if($count_zone_postcodes != "0"){
                                                                        while($row_zones_postcodes = mysqli_fetch_array($run_zone_postcodes)) {
                                                                        $location_code = $row_zones_postcodes["location_code"];
                                                                            if($location_code == $shipping_postcode) {
                                                                                $shipping_zone_id = $zone_id;
                                                                            }
                                                                        }
                                                                    } else {
                                                                        $shipping_zone_id = $zone_id;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        if(empty($billing_country) and empty($billing_postcode)) {
                                                            echo "
                                                                    <li>
                                                                        <p>
                                                                            Não há opções de frete com base nos dados digitados. Por favor cheque seu endereço novamente ou entere em contato conosco.
                                                                        </p>
                                                                    </li>
                                                                ";
                                                        }
                                                        $select_zones = "select * from zones order by zone_order DESC";	
                                                        $run_zones = mysqli_query($con, $select_zones);
                                                        while($row_zones = mysqli_fetch_array($run_zones)) {
                                                            $zone_id = $row_zones['zone_id'];
                                                            $select_zones_locations = "select DISTINCT zone_id from zones_locations where zone_id='$zone_id' and (location_code='$billing_country' and location_type='country')";
                                                            $run_zones_locations = mysqli_query($con, $select_zones_locations);
                                                            $count_zones_locations = mysqli_num_rows($run_zones_locations);
                                                            if($count_zones_locations != "0") {
                                                                $row_zones_locations = mysqli_fetch_array($run_zones_locations);
                                                                $zone_id = $row_zones_locations["zone_id"];
                                                                $select_zone_shipping = "select * from shipping where shipping_zone='$zone_id'";
                                                                $run_zone_shipping = mysqli_query($con, $select_zone_shipping);
                                                                $count_zone_shipping = mysqli_num_rows($run_zone_shipping);
                                                                if($count_zone_shipping != "0") {
                                                                    $select_zone_postcodes = "select * from zones_locations where zone_id='$zone_id' and location_type='postcode'";
                                                                    $run_zone_postcodes = mysqli_query($con, $select_zone_postcodes);
                                                                    $count_zone_postcodes = mysqli_num_rows($run_zone_postcodes);
                                                                    if($count_zone_postcodes != "0") {
                                                                        while($row_zones_postcodes = mysqli_fetch_array($run_zone_postcodes)) {
                                                                            $location_code = $row_zones_postcodes["location_code"];
                                                                            if($location_code == $billing_postcode){
                                                                                $shipping_zone_id = $zone_id;
                                                                            }
                                                                        }
                                                                    } else {
                                                                        $shipping_zone_id = $zone_id;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if(!empty($shipping_zone_id)){
                                                        $select_shipping_types =    "
                                                                                    select *, if(
                                                                                        $total_weight > (
                                                                                            select max(shipping_weight) from shipping
                                                                                            where shipping_type=type_id AND shipping_zone='$shipping_zone_id'
                                                                                        ),
                                                                                        (
                                                                                            select shipping_cost from shipping 
                                                                                            where shipping_type=type_id AND shipping_zone='$shipping_zone_id' order by shipping_weight DESC LIMIT 0,1
                                                                                        ),
                                                                                        (
                                                                                            select shipping_cost from shipping where shipping_type=type_id
                                                                                            AND shipping_zone='$shipping_zone_id' AND shipping_weight >= '$total_weight' order by shipping_weight ASC LIMIT 0,1
                                                                                        )
                                                                                    ) AS shipping_cost from shipping_types where type_local='yes' order by type_order ASC
                                                                                    ";
                                                        $run_shipping_types = mysqli_query($con, $select_shipping_types);
                                                        $i = 0;
                                                        while($row_shipping_types = mysqli_fetch_array($run_shipping_types)) {
                                                            $i++;	
                                                            $type_id = $row_shipping_types['type_id'];
                                                            $type_name = $row_shipping_types['type_name'];
                                                            $type_default = $row_shipping_types['type_default'];
                                                            $shipping_cost = $row_shipping_types['shipping_cost'];
                                                            if(!empty($shipping_cost)) {
                                            ?>
                                                                <li>
                                                                    <input type="radio" name="shipping_type" value="<?php echo $type_id; ?>" class="shipping_type" data-shipping_cost="<?php echo $shipping_cost; ?>" 
                                                                        <?php
                                                                            if($type_default == "yes") {
                                                                                $_SESSION["shipping_type"] = $type_id;
                                                                                $_SESSION["shipping_cost"] = $shipping_cost;
                                                                                echo "checked";
                                                                            } elseif($i == 1) {
                                                                                $_SESSION["shipping_type"] = $type_id;
                                                                                $_SESSION["shipping_cost"] = $shipping_cost;
                                                                                echo "checked";	
                                                                            }
                                                                        ?>
                                                                    >
                                                                    <?php echo $type_name; ?>: <span class="text-muted"> $<?php echo $shipping_cost; ?> </span>
                                                                </li>
                                                                <?php
                                                                            }
                                                                        }
                                                                    } else {
                                                                        if(!empty($billing_country) or !empty($shipping_country)){
                                                                            if(@$_SESSION["is_shipping_address_same"] == "yes") {
                                                                                $select_country_shipping = "select * from shipping where shipping_country='$billing_country'";
                                                                            } elseif(@$_SESSION["is_shipping_address_same"] == "no") {
                                                                                $select_country_shipping = "select * from shipping where shipping_country='$shipping_country'";	
                                                                            } else {
                                                                                $select_country_shipping = "select * from shipping where shipping_country='$billing_country'";	
                                                                            }
                                                                            $run_country_shipping = mysqli_query($con, $select_country_shipping);
                                                                            $count_country_shipping = mysqli_num_rows($run_country_shipping);
                                                                            if($count_country_shipping == "0"){
                                                                                echo    "
                                                                                        <li>
                                                                                            <p>
                                                                                                <!--
                                                                                                There are no shipping types matched/available for your address, or contact us if you need any help.
                                                                                                Não há opções de frete disponiveis para seu endereço, contate-nos se precisar de ajuda.
                                                                                            </p>
                                                                                        </li>
                                                                                        ";
                                                                            } else {
                                                                                if(@$_SESSION["is_shipping_address_same"] == "yes") {
                                                                                    $select_shipping_types =    "
                                                                                                                    select *,if (
                                                                                                                                $total_weight > (
                                                                                                                                select max(shipping_weight) from shipping
                                                                                                                                where shipping_type=type_id AND shipping_country='$billing_country'
                                                                                                                                ),
                                                                                                                                (
                                                                                                                                    select shipping_cost from shipping 
                                                                                                                                    where shipping_type=type_id AND shipping_country='$billing_country' order by shipping_weight DESC LIMIT 0,1
                                                                                                                                ),
                                                                                                                                (
                                                                                                                                    select shipping_cost from shipping where shipping_type=type_id
                                                                                                                                    AND shipping_country='$billing_country' AND shipping_weight >= '$total_weight' order by shipping_weight ASC LIMIT 0,1
                                                                                                                                )
                                                                                                                            ) AS shipping_cost from shipping_types where type_local='no' order by type_order ASC
                                                                                                                ";
                                                                                } elseif(@$_SESSION["is_shipping_address_same"] == "no") {
                                                                                    $select_shipping_types = "
                                                                                                                select *,if(
                                                                                                                $total_weight > (
                                                                                                                select max(shipping_weight) from shipping
                                                                                                                where shipping_type=type_id AND shipping_country='$shipping_country'
                                                                                                                ),
                                                                                                                (
                                                                                                                select shipping_cost from shipping 
                                                                                                                where shipping_type=type_id AND shipping_country='$shipping_country' order by shipping_weight DESC LIMIT 0,1
                                                                                                                    ),
                                                                                                                    (
                                                                                                                    select shipping_cost from shipping where shipping_type=type_id
                                                                                                                    AND shipping_country='$shipping_country' AND shipping_weight >= '$total_weight' order by shipping_weight ASC LIMIT 0,1
                                                                                                                    )
                                                                                                                    ) AS shipping_cost from shipping_types where type_local='no' order by type_order ASC
                                                                                                                ";
                                                                                    } else {
                                                                                        $select_shipping_types = "
                                                                                                                    select *,if(
                                                                                                                    $total_weight > (
                                                                                                                    select max(shipping_weight) from shipping
                                                                                                                    where shipping_type=type_id AND shipping_country='$billing_country'
                                                                                                                    ),
                                                                                                                    (
                                                                                                                    select shipping_cost from shipping 
                                                                                                                    where shipping_type=type_id AND shipping_country='$billing_country' order by shipping_weight DESC LIMIT 0,1
                                                                                                                    ),
                                                                                                                    (
                                                                                                                    select shipping_cost from shipping where shipping_type=type_id
                                                                                                                    AND shipping_country='$billing_country' AND shipping_weight >= '$total_weight' order by shipping_weight ASC LIMIT 0,1
                                                                                                                    )
                                                                                                                    ) AS shipping_cost from shipping_types where type_local='no' order by type_order ASC
                                                                                                                ";	
                                                                                    }
                                                                                    $run_shipping_types = mysqli_query($con, $select_shipping_types);
                                                                                    $i = 0;
                                                                                    while($row_shipping_types = mysqli_fetch_array($run_shipping_types)) {
                                                                                        $i++;	
                                                                                        $type_id = $row_shipping_types['type_id'];
                                                                                        $type_name = $row_shipping_types['type_name'];
                                                                                        $type_default = $row_shipping_types['type_default'];
                                                                                        $shipping_cost = $row_shipping_types['shipping_cost'];
                                                                                        if(!empty($shipping_cost)) {
                                                                            ?>
                                                                            <li>
                                                                                <input type="radio" name="shipping_type" value="<?php echo $type_id; ?>" class="shipping_type" data-shipping_cost="<?php echo $shipping_cost; ?>" 
                                                                                    <?php
                                                                                        if($type_default == "yes") {
                                                                                            $_SESSION["shipping_type"] = $type_id;
                                                                                            $_SESSION["shipping_cost"] = $shipping_cost;
                                                                                            echo "checked";
                                                                                        } elseif($i == 1) {
                                                                                            $_SESSION["shipping_type"] = $type_id;
                                                                                            $_SESSION["shipping_cost"] = $shipping_cost;
                                                                                            echo "checked";	
                                                                                        }
                                                                                    ?>
                                                                                >
                                                                                <?php echo $type_name; ?>: <span class="text-muted"> $<?php echo $shipping_cost; ?> </span>
                                                                            </li>
                                                                            <?php
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }else{
                                                                                    echo "
                                                                                            <li>
                                                                                            <p> 
                                                                                            Por favor logue em sua conta para ver as opções de frete, ou nos contate se precisar de ajuda.
                                                                                            </p>
                                                                                            </li>
                                                                                            ";
                                                                                }
                                                                            ?>
                                                </ul><!-- ul list-unstyled Ends -->
                                            </th>
                                        </tr>
                                        <?php 
                                            $total_cart_price = $total + @$_SESSION["shipping_cost"];
                                        } 
                                        ?>
                                        <tr class="total">
                                            <td>Total</td>
                                            <?php if(count($physical_products) > 0){ ?>
                                            <th class="total-cart-price">R$ <?php echo $total_cart_price; ?></th>
                                            <?php }else{ ?>
                                            <th class="total-cart-price">R$ <?php echo $total; ?></th>
                                            <?php } ?>
                                        </tr>
                            </tbody><!-- tbody Ends -->
                        </table><!-- table Ends -->
                    </div><!-- table-responsive Ends -->
                </div><!-- box Ends -->
            </div><!-- col-md-3 Ends -->
        </div><!-- container Ends -->
    </div><!-- content Ends -->
            
    <?php
        include "includes/php/footer.php";
    ?>

    <script src="js/jquery.min.js"> </script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(data){
        $(document).on('keyup', '.quantity', function(){
            var id = $(this).data("product_id");
            var quantity = $(this).val();
            var shipping_type = $("input[name=shipping_type]:checked").val();
            var shipping_cost = Number($("input[name=shipping_type]:checked").data("shipping_cost"));
            if(quantity  != ''){
                $.ajax({
                    url:"change.php",
                    method:"POST",
                    data:{id:id, quantity:quantity, shipping_type: shipping_type, shipping_cost: shipping_cost},
                    success:function(data){
                        $(".subtotal-cart-price").html(data);
                        $("#cart-products-tbody").load("cart_products_tbody.php");
                        $("#cart-summary-tbody").load("cart_summary_tbody.php");
                    }
                });
            }
        });
        <?php if(count($physical_products) > 0){ ?>
            $(document).on("change", ".shipping_type", function(){
                var shipping_cost = Number($(this).data("shipping_cost"));
                var total = Number(<?php echo $total; ?>);
                var total_cart_price = total + shipping_cost;
                $(".total-cart-price").html("$" + total_cart_price); });
        <?php
            }
        ?>
    });
    </script>
