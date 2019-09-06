<?php
include_once("Model/Item.php");
include_once("Model/AES256.php");
session_start();
	$message = '';
	if(!isset($_SESSION["cart"]) && !isset($_SESSION["form"]) && !isset($_SESSION["card"]) && !isset($_SESSION["orderSummary"])){
		header("Location: shop-furniture.php");
	}
	else{
		
		$OrID = 0;
		$itID = 0;
		$date = date('d/m/Y H:i:s', time());
		
		require_once("global-connect.inc.php");
		
		
		if(!isset($_COOKIE['user'])){
			$message = 'An account has been created with your email as password. Please login and change password';
			$aes256 = new AES256;
			$aes256 = $aes256-> encrypt($_SESSION['form']['email']);
			echo $aes256->getSalt();
			$customer = "INSERT INTO UserAccount VALUES ('" . $_SESSION['form']['email'] . "', '" . $aes256->getPassword() . "', '" . $aes256->getCryptoKey() . "', '" . $aes256->getSalt() . "')";
			$stmt = oci_parse($db, $customer);
			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			oci_execute($stmt);
			
			$customer = "INSERT INTO Customer VALUES ('" . $_SESSION['form']['email'] . "', '" . $_SESSION['form']['firstName'] . "', '" . $_SESSION['form']['lastName'] . "', '" . $_SESSION['form']['address']. "', '" . $_SESSION['form']['city'] . "', '" . $_SESSION['form']['postcode'] . "', '" . $_SESSION['form']['state'] . "', '" . $_SESSION['form']['country'] . "', '" .$_SESSION['form']['area'] . "', '" . $_SESSION['form']['phone'] . "', '" . $_SESSION['form']['company'] . "')";	
			$stmt = oci_parse($db, $customer);
			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			oci_execute($stmt);
			
			$query = "INSERT INTO Card VALUES ('". $_SESSION['form']['email'] . "', '" . $_SESSION['card']['name'] . "', '" . $_SESSION['card']['cardNumber'] . "', '" . $_SESSION['card']['expiryMonth'] . "', '" . $_SESSION['card']['expiryYear'] . "', '" . $_SESSION['card']['CVV'] . "')";
			
			$stmt = oci_parse($db, $query);
			
			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			
			oci_execute($stmt);
			
			$query = "SELECT max(ID) FROM Orders";
			
			$stmt = oci_parse($db, $query);

			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			oci_execute($stmt);
		
			if(oci_fetch_array($stmt)){
				$OrID = oci_result($stmt,1);
			}
			$OrID++;
			
			$query = "INSERT INTO Orders VALUES ('" . $OrID . "' , '" . $_SESSION['card']['cardNumber'] . "', '" . $_SESSION['orderSummary']['grandTotal'] . "', '" . 20.00 . "', '" . $_SESSION['orderSummary']['gst'] . "','" . $_SESSION['orderSummary']['summaryTotal'] . "', TO_DATE('" . $date . "', 'dd/mm/yyyy hh24:mi:ss'))";
			
			$stmt = oci_parse($db, $query);

			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			oci_execute($stmt);
			
			$query = "SELECT max(ID) FROM Items";
			
			$stmt = oci_parse($db, $query);
			
			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			oci_execute($stmt);
			
			if(oci_fetch_array($stmt)){
				$itID = oci_result($stmt,1);
			}
			$itID++;
			
			foreach($_SESSION['cart'] as $key => $item) {
			
				$query = "INSERT INTO Items VALUES ('" . $itID . "' , '" . $OrID. "', '" . $item->getProductName() . "' , '" . $item->getQty() . "', '" . $item->getPrice() . "' , '" .$item->getImgFront() ."')";
				$stmt = oci_parse($db, $query);
				if(!$stmt) {
					echo "An error occurred in parsing the sql string.\n";
					exit;
				}
				oci_execute($stmt);
				$itID++;
			}
			oci_close($db);
			
			unset($_SESSION["cart"]);
			unset($_SESSION["form"]);
			unset($_SESSION["card"]);
			unset($_SESSION["orderSummary"]);
		}
		else{
			
			if(isset($_COOKIE['user'])){
				$query ="SELECT * FROM Customer WHERE Email = '".$_COOKIE['user']."'";
				$email;
				$stmt = oci_parse($db, $query);
			
				if(!$stmt) {
					echo "An error occurred in parsing the sql string.\n";
					exit;
				}
				oci_execute($stmt);
			
				while(oci_fetch_array($stmt)) {
					$email = oci_result($stmt,"EMAIL");
				}
				if($email == ""){
					$customer = "INSERT INTO Customer VALUES ('" . $_SESSION['form']['email'] . "', '" . $_SESSION['form']['firstName'] . "', '" . $_SESSION['form']['lastName'] . "', '" . $_SESSION['form']['address']. "', '" . $_SESSION['form']['city'] . "', '" . $_SESSION['form']['postcode'] . "', '" . $_SESSION['form']['state'] . "', '" . $_SESSION['form']['country'] . "', '" .$_SESSION['form']['area'] . "', '" . $_SESSION['form']['phone'] . "', '" . $_SESSION['form']['company'] . "')";	
					$stmt = oci_parse($db, $customer);
					if(!$stmt) {
						echo "An error occurred in parsing the sql string.\n";
					exit;
					}
					oci_execute($stmt);
			
					$query = "INSERT INTO Card VALUES ('". $_SESSION['form']['email'] . "', '" . $_SESSION['card']['name'] . "', '" . $_SESSION['card']['cardNumber'] . "', '" . $_SESSION['card']['expiryMonth'] . "', '" . $_SESSION['card']['expiryYear'] . "', '" . $_SESSION['card']['CVV'] . "')";
			
					$stmt = oci_parse($db, $query);
			
					if(!$stmt) {
						echo "An error occurred in parsing the sql string.\n";
						exit;
					}
					oci_execute($stmt);
				}
			}

			
			$query = "SELECT max(ID) FROM Orders";
			
			$stmt = oci_parse($db, $query);

			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			oci_execute($stmt);
		
			if(oci_fetch_array($stmt)){
				$OrID = oci_result($stmt,1);
			}
			$OrID++;
			
			$query = "INSERT INTO Orders VALUES ('" . $OrID . "' , '" . $_SESSION['card']['cardNumber'] . "', '" . $_SESSION['orderSummary']['grandTotal'] . "', '" . 20.00 . "', '" . $_SESSION['orderSummary']['gst'] . "','" . $_SESSION['orderSummary']['summaryTotal'] . "', TO_DATE('" . $date . "', 'dd/mm/yyyy hh24:mi:ss'))";
			
			$stmt = oci_parse($db, $query);

			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			oci_execute($stmt);
			
			$query = "SELECT max(ID) FROM Items";
			
			$stmt = oci_parse($db, $query);
			
			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			oci_execute($stmt);
			
			if(oci_fetch_array($stmt)){

				$itID = oci_result($stmt,1);
			}
			$itID++;
			
			foreach($_SESSION['cart'] as $key => $item) {
			
				$query = "INSERT INTO Items VALUES ('" . $itID . "' , '" . $OrID. "', '" . $item->getProductName() . "' , '" . $item->getQty() . "', '" . $item->getPrice() . "' , '" .$item->getImgFront() ."')";
				$stmt = oci_parse($db, $query);
				if(!$stmt) {
					echo "An error occurred in parsing the sql string.\n";
					exit;
				}
				oci_execute($stmt);
				$itID++;
			}
			oci_close($db);
			
			unset($_SESSION["cart"]);
			unset($_SESSION["form"]);
			unset($_SESSION["card"]);
			unset($_SESSION["orderSummary"]);
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Universal : Your Furniture Shop
    </title>
	<?php require_once("Masterpages/Head.php") ?>
	<?php require_once("JavaScript/FunitureScript.php") ?>
	<script type="text/javascript" charset="UTF-8">
	</script>
</head>

<body>
    <!-- *** TOPBAR ***-->
<?php require_once("Masterpages/TopNav.php") ?>
    <!-- *** TOP BAR END *** -->
    <!-- *** NAVBAR *** -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
			<?php require_once("Masterpages/NavbarHeader.php") ?>
			<?php require_once("Masterpages/NavbarCallapse.php") ?>
			<?php require_once("Masterpages/NavbarButtons.php") ?>
        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>Checkout - Order confirmation</li>
                    </ul>
                </div>

                <div class="col-md-12" id="checkout">

                    <div class="box">
                        <!-- <form method="post" action="checkout3.html"> -->
                            <h1>Order confirmed</h1>                            

                            <div class="content">
                                <div class="table-responsive">
									<p> Thank you! Your order is confirmed.</p>
									<p>You will receive email when your order has shipped. </p>								
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.content -->

                            <div class="box-footer">
								<h3><?php echo $message ?></h3>
                                <div class="pull-left">
									<a href="customer-order.php" class="btn btn-primary">View or manage your order</a>
                                </div>
                            </div>
                        <!-- </form> -->
                    </div>
                    <!-- /.box -->


                </div>                

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


        <!-- *** FOOTER *** -->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4>Information</h4>

                        <ul>
                            <li><a href="aboutus.html">About us</a>
                            </li>
                            <li><a href="terms.html">Terms and conditions</a>
                            </li>
                            <li><a href="faq.html">FAQ</a>
                            </li>
                            <li><a href="contact.html">Contact us</a>
                            </li>
                        </ul>

                        <hr>

                        <h4>User section</h4>

                        <ul>
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                            </li>
                            <li><a href="register.html">Regiter</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg hidden-sm">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Top categories</h4>

                        <h5>Furniture</h5>

                        <ul>
                            <li><a href="shop-furniture.html">Chairs</a>
                            </li>
                            <li><a href="shop-furniture.html">Beds</a>
                            </li>
							<li><a href="shop-furniture.html">Tables</a>
                            </li>
                            <li><a href="shop-furniture.html">Storage</a>
                            </li>
                        </ul>

                        <h5>Accessories</h5>
                        <ul>
                            <li><a href="shop-accessories.html">Home Deco</a>
                            </li>
                            <li><a href="shop-accessories.html">Textiles & Rugs</a>
                            </li>
							<li><a href="shop-accessories.html">Lighting</a>
                            </li>
							<li><a href="shop-accessories.html">Plant pots & Stands</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Where to find us</h4>

                        <p><strong>Universal Ltd.</strong>
                            <br>500 Main Street
                            <br>Geelong
                            <br>Victoria 3200
                            <br>
                            <strong>Australia</strong>
                        </p>

                        <a href="contact.html">Go to contact page</a>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->



                    <div class="col-md-3 col-sm-6">

                        
                        <h4>Stay in touch</h4>

                        <p class="social">
                            <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
                        </p>


                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->




        <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">© 2018 Universal Ltd.</p>

                </div>
                <div class="col-md-6">
                    <p class="pull-right">Template by <a href="https://bootstrapious.com/e-commerce-templates">Bootstrapious.com</a>
                         <!-- Not removing these links is part of the license conditions of the template. Thanks for understanding :) If you want to use the template without the attribution links, you can do so after supporting further themes development at https://bootstrapious.com/donate  -->
                    </p>
                </div>
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->



    </div>
    <!-- /#all -->


    

    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>






</body>

</html>