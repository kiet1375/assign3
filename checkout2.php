<?php 
session_start(); 
	if(!isset($_SESSION["orderSummary"])){
		header("Location: shop-furniture.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Universal : Your Furniture Shop
    </title>
	<?php require_once("Masterpages/Head.php") ?>
	<script type="text/javascript" charset="UTF-8">
		function getSummary(){
			$.ajax({
			url: 'summarySession.php',
			type: 'post',
			dataType: "JSON",
			data: { "getSession": ""},
			success: function(response) 
			{ 
				document.getElementById("subTotal").innerHTML = "$"+response["grandTotal"];
				document.getElementById("gst").innerHTML = "$"+response["gst"];
				document.getElementById("summaryTotal").innerHTML = "$"+response["summaryTotal"];
			}
			});
		}
		
		function validateInput(){
			var card = new convertToClassObject();

			var name = ""; var cardNumber = ""; var expiryMonth = ""; var expiryYear = ""; var CVV = "";
			$.ajax({
				url: 'Checkout.php',
				type: 'post',
				dataType: "JSON",
				data: { "validateCard": card},
                success: function (response) {
					var name = response["name"];
					var cardNumber = response["cardNumber"];
					var expiryMonth = response["expiryMonth"];
					var expiryYear = response["expiryYear"];
					var CVV = response["CVV"];
					if(name == "invalid"){
						document.getElementById("name").style.color = "#FF0000";
						document.getElementById("name").value = name;
						document.getElementById("name").style.borderColor = "#FF0000";
					}
					if(cardNumber == "invalid"){
						document.getElementById("cardNumber").style.color = "#FF0000";
						document.getElementById("cardNumber").value = cardNumber;
						document.getElementById("cardNumber").style.borderColor = "#FF0000";
					}
					if(expiryMonth == "invalid"){
						document.getElementById("expiryMonth").style.color = "#FF0000";
						document.getElementById("expiryMonth").value = expiryMonth;
						document.getElementById("expiryMonth").style.borderColor = "#FF0000";
					}
					if(expiryYear == "invalid"){
						document.getElementById("expiryYear").style.borderColor = "#FF0000";
						document.getElementById("expiryYear").style.color = "#FF0000";
						document.getElementById("expiryYear").value = expiryYear;
					}
					if(CVV == "invalid"){
						document.getElementById("CVV").style.color = "#FF0000";
						document.getElementById("CVV").value = CVV;
						document.getElementById("CVV").style.borderColor = "#FF0000";

					}
					else{
						window.location.href = "checkout3.php";
					}
                },
                error: function (response) {
                    alert(response.responseText);
                },
                failure: function (response) {
                    alert(response.responseText);
                }
            });
		}
		
		function convertToClassObject(){
			this.name = document.getElementById("name").value;
			this.cardNumber = document.getElementById("cardNumber").value;
			this.expiryMonth = document.getElementById("expiryMonth").value;
			this.expiryYear = document.getElementById("expiryYear").value;
			this.CVV = document.getElementById("CVV").value;
		}
		
		function removeBorderRed(input){
			if(document.getElementById(input).style.borderColor == "rgb(255, 0, 0)"){
				document.getElementById(input).style.borderColor = "#CDCDCD";
				document.getElementById(input).value = "";
				document.getElementById(input).style.color = "black";
			}
		}
		
		function fillDetails(){
			$.ajax({
			url: 'Checkout.php',
			type: 'post',
			dataType: "JSON",
			data: { "getCard": ""},
			success: function(response) 
			{ 
				if(response != ""){
					document.getElementById("name").value = response['name'];
					document.getElementById("cardNumber").value = response['cardNumber'];
					document.getElementById("expiryMonth").value = response['expiryMonth'];
					document.getElementById("expiryYear").value = response['expiryYear'];
					document.getElementById("CVV").value = response['CVV'];
				}
			}
			});
		}
	</script>
</head>
<body onload="getSummary()">
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
                        <li>Checkout - Payment method</li>
                    </ul>
                </div>
                <div class="col-md-9" id="checkout">
                    <div class="box">
                        <h1>Checkout - Payment method</h1>
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="checkout1.php"><i class="fa fa-map-marker"></i><br>Address</a></li>
                            <li class="active"><a href="#"><i class="fa fa-money"></i><br>Payment Method</a></li>
                            <li class="disabled"><a href="checkout3.php"><i class="fa fa-eye"></i><br>Order Review</a></li>
                        </ul>
                        <div class="content">
                            <div class="row">
								<div class="box payment-method">
                                    <h4>Payment gateway</h4>
                                    <p>VISA and Mastercard only.</p>							                        												
									<ul class="list-unstyled list-inline">
										<li class="list-inline-item"><img src="img/visa.svg" alt="visa" width="50"></li>
										<li class="list-inline-item"><img src="img/mastercard.svg" alt="mastercard" width="50"></li>
									</ul>
									<div class="row">
										<div class="col-sm-10 form-group">
											<input type="text" name="name" placeholder="Name On Card"  class="form-control" id="name" onclick="removeBorderRed('name')">
										</div>
										<div class="col-sm-10 form-group">
											<input type="text" name="cardNumber" placeholder="Card Number" maxlength="19"  class="form-control" id="cardNumber" onclick="removeBorderRed('cardNumber')">
										</div>
										<div class="col-sm-4 form-group">
											<input type="text" name="expiryMonth" placeholder="Expiry Month"  class="form-control" id="expiryMonth" onclick="removeBorderRed('expiryMonth')">
										</div>
										<div class="col-sm-4 form-group">
											<input type="text" name="expiryYear" placeholder="Expiry Year"  class="form-control" id="expiryYear" onclick="removeBorderRed('expiryYear')">
										</div>
										<div class="col-sm-4 form-group">
											<input type="text" name="CVV" placeholder="CVV" maxlength="3"  class="form-control" id="CVV" onclick="removeBorderRed('CVV')">
										</div>											  
									</div>											
                                </div>									
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="pull-left">
                                <a href="checkout1.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Address</a>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary" onclick="validateInput()">Continue to Order review<i class="fa fa-chevron-right"></i></button>
                                </div>
                        </div>
                    </div>
                </div>
				<?php require_once("Masterpages/OrderSummary.php") ?>
            </div>
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
	<!-- *** ALL END *** -->
    <!-- *** SCRIPTS TO INCLUDE *** -->
		<?php require_once("Masterpages/Scripts.php") ?>
    <!-- END OF SCRIPTS-->
</body>
</html>

<?php
	if(isset($_COOKIE["user"])){
			echo '<script type="text/javascript"> fillDetails(); </script>';
	}
?>