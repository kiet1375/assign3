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
        Universal : Checkout
    </title>
	<?php require_once("Masterpages/Head.php") ?>
	<?php require_once("JavaScript/FunitureScript.php") ?>
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
        $(document).ready(function () {
            $(function () {
                $("#postcode").autocomplete({
                    source: function (request, response) {
                        var element = $('#postcode').val();
                        if (element.length != 4) {
                            return false;
                        }
                        $.ajax({
                            url: 'Checkout.php',
							type: 'post',
							dataType: "JSON",
							data: { "getPostcode": element},
                            success: function (data) {
                                response($.map(data, function (item) {
                                    return {
                                        label: item.postcode + ',' + item.name + ',' + item.state["abbreviation"],
                                        value: item.value,
                                    };
                                }))
                            },
                            error: function (response) {
                                alert(response.responseText);
                            },
                            failure: function (response) {
                                alert(response.responseText);
                            }
                        });
                    },
                    select: function (e, i) {
                        var res = i.item.value.split(",");
						$("#city").val(res[1]);
						$("#city").css("border-color", "#CDCDCD");
						$("#city").css("color", "black");
						$("#state").val(res[2]);
						$("#state").css("border-color", "#CDCDCD");
						$("#state").css("color", "black");
						$("#country").val("Australia");
						$("#country").css("border-color", "#CDCDCD");
						$("#country").css("color", "black");
						i.item.value = res[0];
                    },
                });
            });
        });
		
		function validateInput(){
			
			var form = new convertToClassObject();
			
			$.ajax({
				url: 'Checkout.php',
				type: 'post',
				dataType: "JSON",
				data: { "validateForm": form},
                success: function (response) {
					var firstName = response["firstName"];
					var lastName = response["lastName"];
					var address = response["address"];
					var company = response["company"];
					var city = response["city"];
					var postcode = response["postcode"];
					var state = response["state"];
					var country = response["country"];
					var area = response["area"];
					var phone = response["phone"];
					var email = response["email"];
					
					if(firstName == "invalid"){
						document.getElementById("firstName").style.color = "#FF0000";
						document.getElementById("firstName").value = firstName;
						document.getElementById("firstName").style.borderColor = "#FF0000";
					}
					if(lastName == "invalid"){
						document.getElementById("lastName").style.color = "#FF0000";
						document.getElementById("lastName").value = lastName;
						document.getElementById("lastName").style.borderColor = "#FF0000";
					}
					if(address == "invalid"){
						document.getElementById("address").style.color = "#FF0000";
						document.getElementById("address").value = address;
						document.getElementById("address").style.borderColor = "#FF0000";
					}
					if(company == "invalid"){
						document.getElementById("company").style.borderColor = "#FF0000";
						document.getElementById("company").style.color = "#FF0000";
						document.getElementById("company").value = company;
					}
					if(city == "invalid"){
						document.getElementById("city").style.color = "#FF0000";
						document.getElementById("city").value = city;
						document.getElementById("city").style.borderColor = "#FF0000";

					}
					if(postcode == "invalid"){
						document.getElementById("postcode").style.color = "#FF0000";
						document.getElementById("postcode").value = postcode;
						document.getElementById("postcode").style.borderColor = "#FF0000";

					}
					if(state == "invalid"){
						document.getElementById("state").style.color = "#FF0000";
						document.getElementById("state").value = state;
						document.getElementById("state").style.borderColor = "#FF0000";

					}
					if(country == "invalid"){
						document.getElementById("country").style.color = "#FF0000";
						document.getElementById("country").value = country;
						document.getElementById("country").style.borderColor = "#FF0000";

					}
					if(area == "invalid"){
						document.getElementById("area").style.borderColor = "#FF0000";
					}
					if(phone == "invalid"){
						document.getElementById("phone").style.color = "#FF0000";
						document.getElementById("phone").value = phone;
						document.getElementById("phone").style.borderColor = "#FF0000";

					}
					if(email == "invalid"){
						document.getElementById("email").style.color = "#FF0000";
						document.getElementById("email").value = city;
						document.getElementById("email").style.borderColor = "#FF0000";

					}
					else{
						window.location.href = "checkout2.php";
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
			this.firstName = document.getElementById("firstName").value;
			this.lastName = document.getElementById("lastName").value;
			this.address = document.getElementById("address").value;
			this.company = document.getElementById("company").value;
			this.city = document.getElementById("city").value;
			this.postcode = document.getElementById("postcode").value;
			this.state = document.getElementById("state").value;
			this.country = document.getElementById("country").value;
			this.area = document.getElementById("area").value;
			this.phone = document.getElementById("phone").value;
			this.email = document.getElementById("email").value;
		}
		
		function fillDetails(){
			
			$.ajax({
			url: 'Checkout.php',
			type: 'post',
			dataType: "JSON",
			data: { "getDetails": ""},
			success: function(response) 
			{
				if(!response == ""){
					document.getElementById("firstName").value = response['firstName'];
					document.getElementById("lastName").value = response['lastName'];
					document.getElementById("address").value = response['address'];
					document.getElementById("email").value = response['email'];
					document.getElementById("company").value = response['company'];
					document.getElementById("city").value = response['city'];
					document.getElementById("postcode").value = response['postcode'];
					document.getElementById("state").value = response['state'];
					document.getElementById("country").value = response['country'];
					document.getElementById("area").value = response['area'];
					document.getElementById("phone").value = response['phone'];
				}

			}
			});
		}
	</script>
</head>
<body onload = "getSummary()">
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
                        <li>Checkout - Address</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                            <h1>Checkout</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>Payment Method</a>
                                </li>
                                <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>
                            <div class="content">
								<p class="from-group text-muted">* field is compulsory.</p> <!-- added by Shang -->
								
                                <div class="row">									
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="firstName">Firstname *</label>
                                            <input type="text" class="form-control" id="firstName" name="firstName" onclick = "removeBorderRed('firstName')">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lastName">Lastname *</label>
                                            <input type="text" class="form-control" id="lastName" name ="lastName" onclick = "removeBorderRed('lastName')">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="address">Address *</label>
                                            <input type="text" class="form-control" id="address" name ="address" onclick = "removeBorderRed('address')">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="company">Company</label>
                                            <input type="text" class="form-control" id="company" onclick = "removeBorderRed('company')">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="city">City *</label>
                                            <input type="text" class="form-control" id="city" name="city" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="postcode">Postcode *</label>
                                            <input type="text" class="form-control" id="postcode" onclick = "removeBorderRed('postcode')">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="state">State *</label>
											<input type="text" class="form-control" id="state" disabled>                                         
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="country">Country *</label>
											<input type="text" class="form-control" id="country" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-1">
										<div class="form-group">
                                            <label for="area">area *</label>
											<br>
												<select name ="area" id="area" onclick = "removeBorderRed('area')" >
													<option value="select">select</option>
													<option value="02">02</option>
													<option value="03">03</option>
													<option value="07">07</option>
													<option value="08">08</option>
												</select>
										</div>
                                    </div>
                                    <div class="col-sm-6 col-md-5">
                                        <div class="form-group">
                                            <label for="phone">Telephone *</label>
                                            <input type="text" class="form-control" id="phone" name="phone" onclick = "removeBorderRed('phone')">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email *</label>
                                            <input type="text" class="form-control" id="email" name="email" onclick = "removeBorderRed('email')">
                                        </div>
                                    </div>
                                </div>
								<p class="from-group">Note: For all Australian orders over $500 we offer free express shipping. 
								We offer $20 Flat rate shipping for orders under $500. </p> <!-- added by Shang -->
								<p id= "test"></p>
                            </div>
                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="basket.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to basket</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"  name= "submit" onclick="validateInput()">Continue to Payment Method<i class="fa fa-chevron-right"></i></button>
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
    <!-- /#all -->
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