<!DOCTYPE html>
<html lang="en">

<head>

    <title>
        Universal : Your Furniture Shop
    </title>
<?php require_once("Masterpages/Head.php") ?>
	<script type="text/javascript" charset="UTF-8">
		function getState(){
				var input = decodeURIComponent(window.location.search);
				if(input == "?redirect"){
					document.getElementById("error").innerHTML = "error";
					document.getElementById("error").style.color = "red";
				}else{
					document.getElementById("error").innerHTML = "";
					document.getElementById("error").style.color = "black";
				}
		}
	</script>
</head>

<body onload="getState()">
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
    <!-- /#navbar -->
    <!-- *** NAVBAR END *** -->
    <div id="all">
        <div id="content">
            <div class="container">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                </div>
                <div class="col-md-3">
                    <!-- *** PAGES MENU *** -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Pages</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="aboutus.php">About us</a>
                                </li>
                                <li>
                                    <a href="terms.php">Terms and conditions</a>
                                </li>
                                <li>
                                    <a href="contact.php">Contact page</a>
                                </li>
                                <li>
                                    <a href="faq.php">FAQ</a>
                                </li>

                            </ul>

                        </div>
                    </div>

                    <!-- *** PAGES MENU END *** -->


                    <div class="banner">
                        <a href="#">
                            <img src="img/banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                </div>

                <div class="col-md-9">


                    <div class="box" id="contact">
                        <h1>Contact</h1>

                        <p class="lead">Are you curious about something? Do you have some kind of problem with our products?</p>
                        <p>Please feel free to contact us, our customer service center is working for you 24/7.</p>

                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <h3><i class="fa fa-map-marker"></i> Address</h3>
                                <p><strong>Universal Ltd.</strong>
                                    <br>500 Main Street
									<br>Geelong
									<br>Victoria 3200
									<br>
									<strong>Australia</strong>
                                </p>
                            </div>
                            <!-- /.col-sm-4 -->
                            <div class="col-sm-4">
                                <h3><i class="fa fa-phone"></i> Call center</h3>
                                <p class="text-muted">This number is toll free if calling from Australia otherwise we advise you to use the electronic form of communication.</p>
                                <p><strong>+61 800 5244 0000</strong>
                                </p>
                            </div>
                            <!-- /.col-sm-4 -->
                            <div class="col-sm-4">
                                <h3><i class="fa fa-envelope"></i> Electronic support</h3>
                                <p class="text-muted">Please feel free to write an email to us.</p>
                                <ul>
                                    <li><strong><a href="mailto:">info@Universal.com</a></strong>
                                    </li>                                    
                                </ul>
                            </div>
                            <!-- /.col-sm-4 -->
                        </div>
                        <!-- /.row -->

                        <hr>

                        <div id="map">

                        </div>

                        <hr>
                        <h2>Contact form</h2>

                        <form method="post" action="comments.php" id="contact" name="contact" id="usrform">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname">Firstname</label>
                                        <input type="text" class="form-control" id="firstname" name="firstName">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lastname">Lastname</label>
                                        <input type="text" class="form-control" id="lastname" name="lastName">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control" id="subject" name = "subject">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea id="message" class="form-control" id="message" name="message"></textarea>
                                    </div>
                                </div>
							

                                <div class="col-sm-12 text-center">
								<img src="captcha.php" width = "200" height="50"><br>
								<input type="text" name="captcha" /><br>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send message</button>

                                </div>
								<p id ="error"></p>
                            </div>
                            <!-- /.row -->
                        </form>


                    </div>


                </div>
                <!-- /.col-md-9 -->
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
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->
        <!-- *** COPYRIGHT *** -->
		<?php require_once("Masterpages/FooterCopyright.php") ?>
        <!-- *** COPYRIGHT END *** -->
    </div>
    <!-- /#all -->
    <!-- *** SCRIPTS TO INCLUDE *** -->
		<?php require_once("Masterpages/Scripts.php") ?>
	<!-- END OF SCRIPTS-->

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>

    <script>
        function initialize() {
            var mapOptions = {
                zoom: 15,
                center: new google.maps.LatLng(-38.050915, 144.378159),
                mapTypeId: google.maps.MapTypeId.ROAD,
                scrollwheel: false
            }
            var map = new google.maps.Map(document.getElementById('map'),
                mapOptions);

            var myLatLng = new google.maps.LatLng(-38.050915, 144.378159);
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>


</body>

</html>
