    <?php
        session_start();
        include "includes/php/db.php";
        include("functions.php");
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        if(isset($_SESSION['customer_email'])) {
            echo "<script> window.open('index.php','_self'); </script>";	
        }
    ?>

    <?php
        include "includes/php/header.php";
        include "includes/php/social-bar.php";
        include "includes/php/top-bar.php";
        include "includes/php/navbar.php";
    ?>

    <div class="col-md-12" ><!-- col-md-12 Starts -->
        <div class="box" ><!-- box Starts -->
            <div class="box-header" ><!-- box-header Starts -->
                <center><!-- center Starts -->
                    <h2> Registre uma Nova Conta </h2>
                </center><!-- center Ends -->
            </div><!-- box-header Ends -->
            <form action="customer_register.php" method="post" enctype="multipart/form-data" ><!-- form Starts -->
                <div class="form-group" ><!-- form-group Starts -->
                    <label>Nome</label>
                    <input type="text" class="form-control" name="c_name" required>
                </div><!-- form-group Ends -->
                <div class="form-group"><!-- form-group Starts -->
                    <label> Email</label>
                    <input type="email" class="form-control" name="c_email" required>
                </div><!-- form-group Ends -->
                <div class="form-group"><!-- form-group Starts -->
                    <label> Senha </label>
                    <div class="input-group"><!-- input-group Starts -->
                        <span class="input-group-addon"><!-- input-group-addon Starts -->
                            <i class="fa fa-check tick1"> </i>
                            <i class="fa fa-times cross1"> </i>
                        </span><!-- input-group-addon Ends -->
                        <input type="password" class="form-control" id="pass" name="c_pass" required>
                        <span class="input-group-addon"><!-- input-group-addon Starts -->
                            <div id="meter_wrapper"><!-- meter_wrapper Starts -->
                                <span id="pass_type">
                                </span>
                                <div id="meter">
                                </div>
                            </div><!-- meter_wrapper Ends -->
                        </span><!-- input-group-addon Ends -->
                    </div><!-- input-group Ends -->
                </div><!-- form-group Ends -->
                <div class="form-group"><!-- form-group Starts -->
                    <label> Confirmar Senha </label>
                    <div class="input-group"><!-- input-group Starts -->
                        <span class="input-group-addon"><!-- input-group-addon Starts -->
                            <i class="fa fa-check tick2"> </i>
                            <i class="fa fa-times cross2"> </i>
                        </span><!-- input-group-addon Ends -->
                        <input type="password" class="form-control confirm" id="con_pass" required>
                    </div><!-- input-group Ends -->
                </div><!-- form-group Ends -->
                <div class="form-group"><!-- form-group Starts -->
                    <label> Estado </label>
                    <input type="text" class="form-control" name="c_country" required>
                </div><!-- form-group Ends -->
                <div class="form-group"><!-- form-group Starts -->
                    <label> Cidade </label>
                    <input type="text" class="form-control" name="c_city" required>
                </div><!-- form-group Ends -->
                <div class="form-group"><!-- form-group Starts -->
                    <label> Fone </label>
                    <input type="text" class="form-control" name="c_contact" >
                </div><!-- form-group Ends -->
                <div class="form-group"><!-- form-group Starts -->
                    <label> Endereço </label>
                    <input type="text" class="form-control" name="c_address" required>
                </div><!-- form-group Ends -->
                <div class="text-center"><!-- text-center Starts -->
                    <button type="submit" name="register" class="btn btn-primary">
                        <i class="fa fa-user-md"></i> Registrar
                    </button>
                </div><!-- text-center Ends -->
            </form><!-- form Ends -->
        </div><!-- box Ends -->
    </div><!-- col-md-12 Ends -->

    <?php
        include "includes/php/footer.php";
    ?>

    <script src="js/jquery.min.js"> </script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tick1').hide();
            $('.cross1').hide();
            $('.tick2').hide();
            $('.cross2').hide();
            $('.confirm').focusout(function() {
                var password = $('#pass').val();
                var confirmPassword = $('#con_pass').val();
                if(password == confirmPassword){
                    $('.tick1').show();
                    $('.cross1').hide();
                    $('.tick2').show();
                    $('.cross2').hide();
                } else {
                    $('.tick1').hide();
                    $('.cross1').show();
                    $('.tick2').hide();
                    $('.cross2').show();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#pass").keyup(function() {
                check_pass();
            });
        });
        function check_pass() {
            var val=document.getElementById("pass").value;
            var meter=document.getElementById("meter");
            var no=0;
            if(val!="") {
                // If the password length is less than or equal to 6
                if(val.length<=6)no=1;
                // If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
                if(val.length>6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))no=2;
                // If the password length is greater than 6 and contain alphabet,number,special character respectively
                if(val.length>6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))))no=3;
                // If the password length is greater than 6 and must contain alphabets,numbers and special characters
                if(val.length>6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))no=4;
                if(no==1) {
                    $("#meter").animate({width:'50px'},300);
                    meter.style.backgroundColor="red";
                    document.getElementById("pass_type").innerHTML="Very Weak";
                }
                if(no==2) {
                    $("#meter").animate({width:'100px'},300);
                    meter.style.backgroundColor="#F5BCA9";
                    document.getElementById("pass_type").innerHTML="Weak";
                }
                if(no==3) {
                    $("#meter").animate({width:'150px'},300);
                    meter.style.backgroundColor="#FF8000";
                    document.getElementById("pass_type").innerHTML="Good";
                }
                if(no==4) {
                    $("#meter").animate({width:'200px'},300);
                    meter.style.backgroundColor="#00FF40";
                    document.getElementById("pass_type").innerHTML="Strong";
                }
            } else {
                meter.style.backgroundColor="";
                document.getElementById("pass_type").innerHTML="";
            }
        }
    </script>

    <?php
        if(isset($_POST['register'])) {
            echo "<script>alert('You are in da register function 1')</script>";
            $c_name = mysqli_real_escape_string($con, $_POST['c_name']);
            $c_email = mysqli_real_escape_string($con, $_POST['c_email']);
            $c_pass = mysqli_real_escape_string($con, $_POST['c_pass']);
            $encrypted_password = password_hash($c_pass, PASSWORD_DEFAULT);
            $c_country = mysqli_real_escape_string($con, $_POST['c_country']);
            $c_city = mysqli_real_escape_string($con, $_POST['c_city']);

            if(isset($_POST['c_contact'])) {
                $c_contact = mysqli_real_escape_string($con, $_POST['c_contact']);
                echo "<script>alert('You are in da register function 2')</script>";
            }

            $c_address = mysqli_real_escape_string($con, $_POST['c_address']);
            
            if(isset($_FILES['c_image']['name'])) {
                $c_image = $_FILES['c_image']['name'];
                $c_image_tmp = $_FILES['c_image']['tmp_name'];
                echo "<script>alert('You are in da register function 3')</script>";
            }

            $c_ip = getRealUserIp(); 
        
            if(!filter_var($c_email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('You are in da register function 4')</script>";
                echo "<script> alert('Email digitado não é válido.'); </script>";
                exit();
            } else {
                echo "<script>alert('Email Validado!')</script>";
            }

            echo "<script>alert('You are in da register function 4-0')</script>";
            $get_email = "select * from customers where customer_email='$c_email'";
            echo "<script>alert('You are in da register function 4a')</script>";
            $run_email = mysqli_query($con, $get_email) or die(mysqli_error($con));
            echo "<script>alert('You are in da register function 4b')</script>";
            $check_email = mysqli_num_rows($run_email);
            echo "<script>alert('You are in da register function 4c')</script>";
            if($check_email == 1) {
                echo "<script>alert('You are in da register function 5')</script>";
                echo "<script>alert('Email já registrado. Por favor recupere sua senha ou tente otro email.')</script>";
                exit();
            } else {
                echo "<script>alert('Email OK!')</script>";
                echo "<script>alert('You are in da register function 5a')</script>";
            }

            $customer_confirm_code = mt_rand();
            $subject = "Confirmação de Cadastro - Komodo";
            $from = "cesar.onlinebiz@gmail.com";
            $message =  "
                        <h2>
                            Confirmação de Cadastro - Loja Komodo para $c_name
                        </h2>
                        <a href='localhost/ecom_store/customer/my_account.php?$customer_confirm_code'>
                            Clique aqui para Confirmar Email
                        </a>
                        ";
            $headers = "From: $from \r\n";
            $headers .= "Content-type: text/html\r\n";

            $mail_success = mail($c_email, $subject, $message, $headers);;
            if (!$mail_success) {
                $mail_errorMessage = error_get_last()['message'];
                echo "<script>alert('mail error!' . $mail_errorMessage)</script>";
            }

            echo "<script>alert('You are in da register function 9')</script>";
            $insert_customer = "insert into customers (customer_name, customer_email, customer_pass, 
                                                       customer_country, customer_city) 
                                                       values ('$c_name', '$c_email', '$encrypted_password', 
                                                                '$c_country', '$c_city')";

            $run_customer = mysqli_query($con, $insert_customer) or die(mysqli_error($con));
            echo "<script>alert('You are in da register function 10')</script>";
            $last_insert_customer_id = mysqli_insert_id($con) or die(mysqli_error($con));
            echo "<script>alert('You are in da register function 10A')</script>";
            $insert_customers_addresses = "insert into customers_addresses (customer_id) values ('$last_insert_customer_id')";
            $run_customers_addresses = mysqli_query($con, $insert_customers_addresses) or die(mysqli_error($con));
            echo "<script>alert('You are in da register function 10b')</script>";
            $sel_cart = "select * from cart where ip_add='$c_ip'";
            $run_cart = mysqli_query($con, $sel_cart) or die(mysqli_error($con));
            echo "<script>alert('You are in da register function 10C')</script>";
            $check_cart = mysqli_num_rows($run_cart);

            if($check_cart>0){
                $_SESSION['customer_email']=$c_email;
                echo "<script>alert('Você se registrou com sucesso!')</script>";
                echo "<script>window.open('checkout.php','_self')</script>";
            } else {
                $_SESSION['customer_email']=$c_email;
                echo "<script>alert('Você se registrou com sucesso!')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
        }
    ?>