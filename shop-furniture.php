<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Universal : Your Furniture Shop</title>
	<?php require_once("Masterpages/Head.php") ?>
	<?php require_once("JavaScript/FunitureScript.php") ?>
</head>
<body onload="checkStatus()">
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
    </div>
    <!-- *** NAVBAR END *** -->
    <div id="all">
        <div id="content">
            <div class="container">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a>
                        </li>
                        <li>Furniture</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS *** -->
					<?php require_once("Masterpages/SideNavbar.php") ?>
					<?php require_once("Masterpages/BrandFilter.php") ?>
					<?php require_once("Masterpages/Apply.php") ?>
					<?php require_once("Masterpages/Banner.php") ?>
                    <!-- *** MENUS AND FILTERS END *** -->
                </div>
                <div class="col-md-9">
                    <div class="box">
                        <h1>Furniture</h1>
                        <p>In our Furniture department we offer wide selection of the best furniture we have found and carefully selected worldwide.</p>
                    </div>
					<?php require_once("Masterpages/BoxInfo-bar.php") ?>
					<?php require_once("Masterpages/Products.php") ?>
					<?php require_once("Masterpages/Pagination.php") ?>
                </div>
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
        <!-- *** FOOTER *** -->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
				<?php require_once("Masterpages/FooterInformation.php") ?>
            </div>
        </div>
        <!-- *** FOOTER END *** -->
        <!-- *** COPYRIGHT *** -->
		<?php require_once("Masterpages/FooterCopyright.php") ?>
        <!-- *** COPYRIGHT END *** -->
    </div>
    <!-- *** SCRIPTS TO INCLUDE *** -->
	<?php require_once("Masterpages/Scripts.php") ?>
	<script src="js/plugins.js"></script>
    <script src="js/active.js"></script>
    <!-- END OF SCRIPTS-->
</body>
</html>