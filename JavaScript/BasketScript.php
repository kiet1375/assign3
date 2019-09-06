	<script type="text/javascript" charset="UTF-8">
		function details(){;
			var input = decodeURIComponent(window.location.search);
			var value = input.split("?");
			var old = document.referrer;
			
			if (window.performance && window.performance.navigation.type == window.performance.navigation.TYPE_BACK_FORWARD) {
				//This will stop the qty being added by 1 due to user pressing back or forward button
				getSessionCart();
				return false;
			}
			if(document.referrer == ""){
				//This will stop the qty being added by 1 due to user pressed URL twice
				getSessionCart();
				return false;
			}
			else{
				setSession(value[1]);
			}
		}
		
		function getSessionCart(){ //This is when a user pushes go forward or backward button. 
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
					document.getElementById("numberInCart").innerHTML = quantityCart;
					setSummaryCart(summaryTotal, grandTotal, gst);				
			}
			});
		}
		
		
		function setSession(type)
		{
			var grandTotal = 0.0;
			$("#displayCart").html('');
			$("#totalPrice").html('');
			
			var i;
			
			$.ajax({
				url: 'setSession.php',
				type: 'post',
				dataType: "json",
				data: {"getCart" : type},
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
					document.getElementById("numberInCart").innerHTML = quantityCart;
					setSummaryCart(summaryTotal, grandTotal, gst);
				}
			});
		}
		function getDelete(index){
			var grandTotal = 0;
			$("#displayCart").html('');
			$("#totalPrice").html('');
			var i;
			
			$.ajax({
				url: 'setSession.php',
				type: 'post',
				dataType: "JSON",
				data: { "deleteItem": index},
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
					document.getElementById("numberInCart").innerHTML = quantityCart;
					setSummaryCart(summaryTotal, grandTotal, gst);
				}
			});
		}
		
		//Function is updateCart when user presses update cart
		function updateQty(){
			var length = document.getElementById("qty").text;
			var qty;
			var type;
			var i;
			var obj;
			var grandTotal = 0;
			var list = [];
			for( i = 0; i < length; i++){
				qty = document.getElementById("qty"+i).value;
				type = document.getElementById("qty"+i).name;
				obj = new update(type, qty);
				list[i] = obj;
			}
			$("#displayCart").html('');
			$("#totalPrice").html('');
			$.ajax({
			url: 'setSession.php',
			type: 'post',
			dataType: "JSON",
			data: { "actionQty": list},
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
					var stri = "<input type='number' value='"+qty+"'"+" class='form-control' id='"+"qty"+id+"' min='1' max='100' onkeypress='return false;' name='"+type+"'>"
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
				document.getElementById("numberInCart").innerHTML = quantityCart;
				setSummaryCart(summaryTotal, grandTotal, gst);
			}
			});
		}
		
		function setSummaryCart(summaryTotal, grandTotal, gst){
			var summary = new summaryClass(summaryTotal, grandTotal, gst);
			$.ajax({
			url: 'summarySession.php',
			type: 'post',
			dataType: "JSON",
			data: { "setSession": summary},
			success: function(response) 
			{ 
			}
			});
		}
		
		function summaryClass(summaryTotal, grandTotal, gst){
			this.summaryTotal = summaryTotal;
			this.grandTotal = grandTotal;
			this.gst = gst;
		}
		
		//function is to create class object to pass to ajax to setSession.php when user presses 
		//update cart
		function update(type, qty){
			this.type = type;
			this.qty = qty;
		}
		
	</script>