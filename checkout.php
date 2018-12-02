<?php
    session_start();
    include "includes/php/db.php";
    include "functions.php";
    define("customer_login", TRUE);
    define("review_order", TRUE);
?>

<?php
    include "includes/php/header.php";
    include "includes/php/social-bar.php";
    include "includes/php/top-bar.php";
    include "includes/php/navbar.php";
?>

<div id="content" ><!-- content Starts -->
    <div class="container" ><!-- container Starts -->
        <div class="col-md-12" ><!--- col-md-12 Starts -->
            <?php
                if(!isset($_SESSION["customer_email"])){
                    include("customer_login.php");
                } else {
                    echo "<script>window.open('index.php','_self')</script>";
                }
            ?>
        </div><!--- col-md-12 Ends -->
    </div><!-- container Ends -->
</div><!-- content Ends -->


<?php
    include "includes/php/footer.php";
?>