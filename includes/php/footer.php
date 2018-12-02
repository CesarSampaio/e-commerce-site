    
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

        <?php
            include 'includes/php/body-functions.php';
        ?>

        <div id="footer"><!-- footer Starts -->
            <div class="container"><!-- container Starts -->
                <div class="row" ><!-- row Starts -->
                    <div class="col-md-3 col-sm-6" ><!-- col-md-3 col-sm-6 Starts -->
                        <h4>Páginas</h4>
                        <ul><!-- ul Starts -->
                            <li><a href="cart.php">Carrinho de Compras</a></li>
                            <li><a href="contact.php">Contato</a></li>
                            <li><a href="shop.php">Loja</a></li>
                            <li>
                            <?php
                            if(!isset($_SESSION['customer_email'])){
                                echo "<a href='checkout.php'>Minha Conta</a>";
                            }
                            else{
                                echo "<a href='customer/my_account.php?my_orders'>Minha Conta</a>";
                            }
                            ?>
                            </li>
                        </ul><!-- ul Ends -->
                        <hr>
                        <h4>Sessão do Usuário</h4>
                        <ul><!-- ul Starts -->
                            <li>
                                <?php
                                if(!isset($_SESSION['customer_email'])){
                                    echo "<a href='checkout.php'>Login</a>";
                                } else {
                                    echo "<a href='customer/my_account.php?my_orders'>Minha Conta</a>";
                                }
                                ?>
                            </li>
                            <li><a href="customer_register.php">Registro</a></li>
                            <li><a href="terms.php">Termos e Condições </a></li>
                        </ul><!-- ul Ends -->
                        <hr class="hidden-md hidden-lg hidden-sm" >
                    </div><!-- col-md-3 col-sm-6 Ends -->
                    <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Starts -->
                        <h4> Categorias Principais </h4>
                        <ul><!-- ul Starts -->
                            <li><a href="#">Categoria 01</a></li>
                            <li><a href="#">Categoria 02</a></li>
                            <li><a href="#">Categoria 03</a></li>
                            <li><a href="#">Categoria 04</a></li>
                            <li><a href="#">Categoria 05</a></li>
                            <li><a href="#">Categoria 06</a></li>
                            <li><a href="#">Categoria 07</a></li>
                            <li><a href="#">Categoria 08</a></li>
                            <li><a href="#">Categoria 09</a></li>
                        </ul><!-- ul Ends -->
                        <hr class="hidden-md hidden-lg">
                    </div><!-- col-md-3 col-sm-6 Ends -->
                    <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Starts -->
                        <h4>Onde Nos Encontrar</h4>
                        <p><!-- p Starts -->
                            <strong>Loja Exemplo</strong>
                            <br>Rua Exemplo
                            <br>Bairro XYZ
                            <br>09289488948
                            <br>cesarsampaio@cesarsampaio.pro
                            <br>
                            <strong>Cesar Sampaio</strong>
                        </p><!-- p Ends -->
                        <a href="contact.php">Contatos</a>
                        <hr class="hidden-md hidden-lg">
                        </div><!-- col-md-3 col-sm-6 Ends -->
                        <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Starts -->
                        <h4>Novidades</h4>
                        <p class="text-muted">
                        Lorem Ipsum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                        </p>
                        <form action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=computerfever', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true"><!-- form Starts -->
                            <div class="input-group"><!-- input-group Starts -->
                                <input type="text" class="form-control" name="email">
                                <input type="hidden" value="computerfever" name="uri"/>
                                <input type="hidden" name="loc" value="en_US"/>
                                <span class="input-group-btn"><!-- input-group-btn Starts -->
                                    <input type="submit" value="subscribe" class="btn btn-default">
                                </span><!-- input-group-btn Ends -->
                            </div><!-- input-group Ends -->
                        </form><!-- form Ends -->
                        <hr>
                        <h4> Redes Sociais </h4>
                        <p class="social"><!-- social Starts --->
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-google-plus"></i></a>
                        <a href="#"><i class="fa fa-envelope"></i></a>
                        </p><!-- social Ends --->
                    </div><!-- col-md-3 col-sm-6 Ends -->
                </div><!-- row Ends -->
            </div><!-- container Ends -->
        </div><!-- footer Ends -->
        <div id="copyright"><!-- copyright Starts -->
            <div class="container" ><!-- container Starts -->
                <div class="col-md-6" ><!-- col-md-6 Starts -->
                    <p class="pull-left">
                    &copy; 2017 Cesar Sampaio
                    </p>
                </div><!-- col-md-6 Ends -->
                <div class="col-md-6" ><!-- col-md-6 Starts -->
                    <p class="pull-right" >
                    Template by <a href="http://www.example.com" >example.com</a>
                    </p>
                </div><!-- col-md-6 Ends -->
            </div><!-- container Ends -->
        </div><!-- copyright Ends -->

    </body>
</html>