<?php
    session_start();
    include("includes/db.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Admin Forgot Password </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" >
        <link rel="stylesheet" href="css/login.css" >
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" >
    </head>
    <body>
        <div class="container" ><!-- container Starts -->
            <div class="alert alert-info">
                <strong> Info </strong> Please enter your email address. You will receive a link to create a new password via email.
            </div>
            <form class="form-login" action="" method="post" ><!-- form-login Starts -->
                <h2 class="form-login-heading" > Forgot Password </h2>
                <input type="text" class="form-control" name="admin_email" placeholder="Endereço de Email" required >
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="forgot_password" >
                    Submit
                </button>
                <h4 class="forgot-password">
                    <a href="login.php">
                        <i class="fa fa-arrow-left"></i> Voltar a página de login
                    </a>
                </h4>
            </form><!-- form-login Ends -->
        </div><!-- container Ends -->
    </body>
</html>
<?php
    if(isset($_POST['forgot_password'])) {
        $admin_email = mysqli_real_escape_string($con, $_POST['admin_email']);
        $select_admin = "select * from admins where admin_email='$admin_email'";
        $run_admin = mysqli_query($con, $select_admin);
        $count_admin = mysqli_num_rows($run_admin);
        if($count_admin == 0) {
        echo "
            <script>
            alert('Desculpe, mas não temos registro do seu email nos nossos registros.');
            </script>
            ";
    } else {
        $row_admin = mysqli_fetch_array($run_admin);
        $admin_name = $row_admin["admin_name"];
        $hashed_admin_pass = $row_admin["admin_pass"];
        $message = "
                <img src='http://localhost/Ecom_store/images/email-logo.png' width='100'>
                <h3> Alguém solicitou uma nova senha para a seguinte conta de email: </h3>
                <h3> Site Url: www.lizlu.com.br </h3>
                <h3> Endereço de Email: $admin_email </h3>
                <h3> Nome: $admin_name </h3>
                <h3> Se você não pediu essa alteração, ignore esse email e nada vai acontecer. </h3>
                <h3>
                <a href='http://localhost/Ecom_store/admin_area/change_password.php?change_password=$hashed_admin_pass'>
                Para mudar sua senha, clique aqui.
                </a>
                </h3>
                ";
        $from = "example@gmail.com"; 
        $subject = "!Importante, sua senha de Admin do site LizLu";
        $headers = "From: $from\r\n";
        $headers .= "Content-type: text/html\r\n";
        mail($admin_email,$subject,$message,$headers);
        echo "
            <script>
            alert('Seu link de mudança de senha foi mandado para seu email. Cheque sua caixa de entrada.');
            window.open('login.php','_self');
            </script>
            ";
        }
    }
?>