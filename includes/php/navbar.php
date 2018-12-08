<?php
    if(!isset($_SESSION['customer_email'])) {
        $logon="Entrar";
        $href="checkout.php";
        $customer="";
    } else {
        $logon="Sair";
        $href="logout.php";
        echo "<script>alert('".$_SESSION["customer_email"]."');</script>";
        $customer='<div class="customer-panel">Bem-vindo, '.$_SESSION['customer_email'].'</div>';
    }
?>

    <div class="menu">
        <nav class="navbar-default">
            <div class="container-fluid" style="background: black">
                <div class="navbar-wrapper">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                Páginas <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="navbar-dropdown-li"><a href="#">Suplementos</a></li>
                                <li class="navbar-dropdown-li"><a href="#">Moda Praia</a></li>
                                <li class="navbar-dropdown-li"><a href="#">Minha Conta</a></li>
                                <li class="navbar-dropdown-li"><a href="#">Minha Ordens</a></li>
                                <li class="navbar-dropdown-li"><a href="#">Contato</a></li>
                                <li class="navbar-dropdown-li"><a href="#">Page 1-6</a></li>
                                <li class="navbar-dropdown-li"><a href="#">Page 1-7</a></li>
                                <li class="navbar-dropdown-li"><a href="#">Page 1-8</a></li>
                                <li class="navbar-dropdown-li"><a href="#">Page 1-9</a></li>
                                <li class="navbar-dropdown-li"><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                        <li class="navbar-li"><a href="#">Moda Praia</a></li>
                        <li class="navbar-li"><a href="#">Suplementos</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                Categorias <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="navbar-dropdown-li"><a href="#">Page 1-1</a></li>
                                <li class="navbar-dropdown-li"><a href="#">Page 1-2</a></li>
                                <li class="navbar-dropdown-li"><a href="#">Page 1-3</a></li>
                                <li class="navbar-dropdown-li"><a href="#">Page 1-4</a></li>
                                <li class="navbar-dropdown-li"><a href="#">Page 1-5</a></li>
                            </ul>
                        </li>
                        <li class="navbar-li">
                            <?php
                                echo "<a href=$href style='color: green; font-weight: 700;'>";
                                echo $logon;
                                echo "</a>";
                            ?>
                        </li>
                        <!--<li class="navbar-li"><a href="#">Carrinho</a></li>-->
                        <li class="navbar-li">
                            <?php
                                echo $customer; 
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
