	<div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Offer of the day</a>  
				<a href="#">Get flat 35% off on orders over $500!</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu" id="menu">
				<?php
					if(isset($_COOKIE['user'])){
						echo "<li><a href='#'>Hello " . $_COOKIE['user'] . "!</a></li>" .
							"<li onclick='logoff()' ><a href='#'>Log-off</a></li>" .
						"<li><a href='contact.php'>Contact</a></li>";
					}
					else{
						echo "<li><a href='#' data-toggle='modal' data-target='#login-modal'> Login</a></li>" .
						"<li><a href='register.php'>Register</a></li>" .
						"<li><a href='contact.php'>Contact</a></li>";	
					}
				?>
                </ul>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email-modal" placeholder="email" name="email" onclick ="removeBorderRed('email-modal')">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password-modal" placeholder="password" name="password" onclick="removeBorderRed('password-modal')">
                            </div>
							
							<!--<img src="captcha.php" /><input type="text" name="captcha" /> -->

                            <p class="text-center">
                                <button class="btn btn-primary" name="submit" onclick="login()"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>
                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="register.html">
						<strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute 
						and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
