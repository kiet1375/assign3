<?php
session_start();
if(!isset($_SESSION['orderSummary']) || !isset($_SESSION['cart']) || !isset($_SESSION['card'])){
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
		function display(){
			getSummary();
			var grandTotal = 0.0;
			$("#displayCart").html('');
			$("#totalPrice").html('');
			
			var i;
			$.ajax({
			url: 'setSession.php',
			type: 'post',
			dataType: "JSON",
			data: { "getSessionCart": ""},
			success: function(response) 
			{ 
					for(i=0; i<response.length; i++){
						var type = response[i].type;
						var imgFront = response[i].imgFront;
						var imgRear = response[i].imgRear;
						var productName = response[i].productName;
						var brand = response[i].brand;
						var price = response[i].price;
						var details = response[i].details;
						var id = response[i].id;
						var qty = response[i].qty;
						var total = parseFloat(price) * parseInt(qty);
						grandTotal = grandTotal + total;
						var str = "<a onclick=getDelete("+id+")>";
						var stri = "<input type='number' value='"+qty+"'"+" class='form-control' id='"+"qty"+id+"' min='0' max='100' onkeypress='return false;' name='"+type+"'>"
						var tr_str = "<tr>" +
						"<td>"+"<a href='#'>"+"<img src= "+imgFront+" alt= "+type+ "></a>"+"</td>" +
						"<td>" + productName + "</td>" +
						"<td>" + stri + "</td>" +
						"<td>" + "$AU " + price + ".00" + "</td>" +
						"<td>" + "$AU 0.00" + "</td>" +
						"<td id= 'total'"+ qty +"'>" + "$AU " + total + ".00" + "</td>" +
						"<td>"+str+"Remove from cart"+"</a>"+"</td>" +
						"</tr>";
						$("#displayCart").append(tr_str);
					}
					document.getElementById("qty").text= i;
					var totalPrice = "<tr>" +
						"<th colspan='5'>"+"GrandTotal"+"</th>" +
						"<td colspan='2'>" + "$AU "+grandTotal +".00"+"</td>" +
						"</tr>";
						$("#totalPrice").append(totalPrice);
					var gst = grandTotal / 100 * 10;
					gst = gst.toFixed(2);
					grandTotal = grandTotal.toFixed(2);
					var summaryTotal = parseFloat(grandTotal) + parseFloat(gst) + 20;
					summaryTotal = summaryTotal.toFixed(2);
					document.getElementById("subTotal").innerHTML = "$"+grandTotal;
					document.getElementById("gst").innerHTML = "$"+gst;
					document.getElementById("summaryTotal").innerHTML = "$"+summaryTotal;
					var numCart = "You currently have "+ i +" item(s) in your cart."
					document.getElementById("itemCart").innerHTML = numCart;
					var quantityCart =  i+ " items in cart";
					document.getElementById("quantityCart").innerHTML = quantityCart;
					setSummaryCart(summaryTotal, grandTotal, gst);				
			}
			});
		}
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
	</script>
</head>

<body onload="display()">
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
                        <li><a href="index.html">Home</a>
                        </li>
                        <li>Checkout - Order review</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="checkout4.php">
                            <h1>Checkout - Order review</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="checkout1.php"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                                <!-- <li><a href="checkout2.html"><i class="fa fa-truck"></i><br>Delivery Method</a>
                                </li> -->
                                <li><a href="checkout2.php"><i class="fa fa-money"></i><br>Payment Method</a>
                                </li>
                                <li class="active"><a href="#"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>

                            <div class="content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Product</th>
                                                <th>Quantity</th>
                                                <th>Unit price</th>
                                                <th>Discount</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="displayCart">
                                        </tbody>
                                        <tfoot id="totalPrice">
                                        </tfoot>
                                    </table>

                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.content -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="checkout2.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Payment method</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Place an order<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
							<p id= "qty" hidden></p>
                        </form>
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md-9 -->
					<?php require_once("Masterpages/OrderSummary.php") ?>
                <!-- /.col-md-3 -->
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
	<!-- *** END OF SCRIPT *** --->
</body>
</html>