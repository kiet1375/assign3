<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once("Masterpages/Head.php") ?>
    <title>Universal : Your Furniture Shop</title>
</head>
<body>
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
	<!-- *** END OF NAVBAR *** -->
	<!-- *** ALL *** -->
    <div id="all">
      <div id="content">
            <div class="container">
                <div class="col-md-12">			
					<div id="main-slider">
                        <div class="item">
                            <img src="images/getinspired1.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/getinspired2.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/getinspired3.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/getinspired4.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div id="advantages">
                <div class="container">
                    <div class="same-height-row">
                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-heart"></i>
                                </div>
                                <h3><a href="#">We love our customers</a></h3>
                                <p>We are known to provide best possible service ever</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-tags"></i>
                                </div>
                                <h3><a href="#">Best prices</a></h3>
                                <p>You pay less to buy big brands here.</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box same-height clickable">
                                <div class="icon"><i class="fa fa-thumbs-up"></i>
                                </div>
                                <h3><a href="#">100% satisfaction guaranteed</a></h3>
                                <p>Free returns on everything for 3 months.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
            <div class="container">
                <div class="col-md-12" data-animate="fadeInUp">
                    <div id="blog-homepage" class="row"> </div>
              </div>
          </div>
        </div>
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
    <!-- /#all -->
    <!-- *** SCRIPTS TO INCLUDE *** -->
	<?php require_once("Masterpages/Scripts.php") ?>
	<!-- *** END OF SCRIPTS  *** -->
</body>
</html>