<!DOCTYPE html>
<html lang="en">
<head>
    <title>Universal : Your Furniture Shop</title>
	<?php require_once("Masterpages/Head.php") ?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<?php require_once("JavaScript/FunitureScript.php") ?>
		<?php require_once("JavaScript/BasketScript.php") ?>
</head>
<body onload="details()">
    <!-- *** TOPBAR *** -->
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
    <!-- *** NAVBAR END *** -->
    <div id="all">
        <div id="content">
            <div class="container">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>Shopping cart</li>
                    </ul>
                </div>
                <div class="col-md-9" id="basket">
                    <div class="box">
                            <h1>Shopping cart</h1>
                            <p class="text-muted" id="itemCart"></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th>Discount</th>
                                            <th colspan="1">Total</th>
											<th colspan="1"></th>
                                        </tr>
                                    </thead>
                                    <tbody id= "displayCart">
                                    </tbody>
                                    <tfoot id="totalPrice">
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="shop-furniture.php" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                                </div>
                                <div class="pull-right">
									<button class="btn btn-default" id="updateCart" onclick ="updateQty()"><i class="fa fa-refresh"></i> Update cart</button>

                                    <button onclick= "location.href = 'checkout1.php';"  class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
							<p id= "qty" hidden></p>
                    </div>
                </div>
					<?php require_once("Masterpages/OrderSummary.php") ?>
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
        <!-- *** FOOTER *** -->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
			<?php require_once("Masterpages/FooterInformation.php") ?>
            </div>
            <!-- /.container -->
        </div>
        <!-- *** FOOTER END *** -->
        <!-- *** COPYRIGHT *** -->
		<?php require_once("Masterpages/FooterCopyright.php") ?>
        <!-- *** COPYRIGHT END *** -->
    </div>
    <!-- /#all -->
    <!-- *** SCRIPTS TO INCLUDE *** -->
	<?php require_once("Masterpages/Scripts.php") ?>
	<!-- *** END OF SCRIPT *** --->
</body>
</html>