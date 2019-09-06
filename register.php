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
    <!-- *** TOPBAR *** -->
		<?php require_once("Masterpages/TopNavRegister.php") ?> 
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
                        <li><a href="index.html">Home</a>
                        </li>
                        <li>New account / Sign in</li>
                    </ul>

                </div>
				<?php
				
				?>
                <div class="col-md-6">
                    <div class="box">
                        <h1>New account</h1>

                        <p class="lead">Not our registered customer yet?</p>
                        <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

                        <div class="form-group">
							<label for="email">Email</label>
								<input type="text" class="form-control" id="email" name="email" id= "email" placeholder= "email" onclick="removeBorderRed('email')">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" id="password" placeholder= "password" onclick="removeBorderRed('password')">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" onclick="register()"><i class="fa fa-user-md"></i> Register</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
        <!-- *** FOOTER ***-->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
			<?php require_once("Masterpages/FooterInformation.php") ?>
            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->
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
