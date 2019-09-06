<script type="text/javascript" charset="UTF-8">	


function checkStatus()
{
	var input = decodeURIComponent(window.location.search);
	var currentSort = document.getElementById("sortValue").innerHTML;
	
	if(currentSort == ""){
		currentSort = "low";
		document.getElementById("sortValue").innerHTML = currentSort;
	}
	

	if(input == ""){
		
		loadXML(6,input, currentSort);
	}
	else{
		loadXML(4, input, currentSort);
	}
}
function updateShowingProduct()
{
	var count = document.getElementById("showingProduct").innerHTML;
	count = count.split(" ");
	return count[3];
}

function loadXML(num, input, currentSort) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		loadView(this, num, input, currentSort);
    }
  };
  xmlhttp.open("GET", "xml/catalog.xml", true);
  xmlhttp.send();
}

function loadView(xml, num, input, currentSort) {
	var i;
	var xmlDoc = xml.responseXML;
	//var xml;
	var obj;
	var array = [];
	
	switch(input){
		case "":
			xml = xmlDoc.getElementsByTagName("index");
			break;
		case "?chairs":
			xml = xmlDoc.getElementsByTagName("chair");
			break;
		case "?beds":
			xml = xmlDoc.getElementsByTagName("bed");
			break;
		case "?tables":
			xml = xmlDoc.getElementsByTagName("table");
			break;
		case "?storages":
			xml = xmlDoc.getElementsByTagName("storage");
			break;
		default:
			alert("An error has occured... Returning to Home page.");
			//redirect method
		
	}
	if(currentSort == "low"){
		array = sortLow(num, xml, obj, array);
		startClone(num);
		startTemplateID(num);	
		renderView(num, array);
	}
	else{
		array = sortHigh(num, xml, obj, array);
		startClone(num);
		startTemplateID(num);	
		renderView(num, array);
	}
	document.getElementById("showingProduct").innerHTML = "Showing " + num.toString() + " of " + xml.length + " products";
}
function startClone(num)
{
	var elmnt = document.getElementsByTagName("DIV")[70];

	for(i = num; i >= 2; i--){
		clone = elmnt.cloneNode(true);
		clone.id= i;
		document.getElementById("startClone").append(clone);
	}
}

function startTemplateID(num)
{
	for(i = num; i >= 2; i--){
		document.getElementById("h3Element1").id = "h3Element".concat(i.toString());
		document.getElementById("priceElement1").id = "priceElement".concat(i.toString());
		document.getElementById("imgFront1").id = "imgFront".concat(i.toString());
		document.getElementById("imgBack1").id = "imgBack".concat(i.toString());
		document.getElementById("brand1").id = "brand".concat(i.toString());
		document.getElementById("details1").id = "details".concat(i.toString());
		document.getElementById("detailsPost1").id = "detailsPost".concat(i.toString());
		document.getElementById("addToCart1").id = "addToCart".concat(i.toString());
		document.getElementById("returnShopping1").id = "returnShopping".concat(i.toString());
	}
}
function renderView(num, array)
{	
	for (i = 1; i <= num; i++) { 
		document.getElementById("h3Element".concat(i.toString())).innerHTML = array[i-1].product;
		document.getElementById("priceElement".concat(i.toString())).innerHTML = "$AU"+array[i-1].price;
		document.getElementById("imgFront".concat(i.toString())).src = array[i-1].imgFront;
		document.getElementById("imgBack".concat(i.toString())).src = array[i-1].imgRear;
		document.getElementById("brand".concat(i.toString())).innerHTML = array[i-1].brand;
		document.getElementById("details".concat(i.toString())).innerHTML = array[i-1].details;
		document.getElementById("detailsPost".concat(i.toString())).href = "detail.php?".concat(array[i-1].detailsPost); 
		document.getElementById("addToCart".concat(i.toString())).href = "basket.php?".concat(array[i-1].detailsPost);
	} 
}
function sortLow(num, xml, obj, array)
{
	for (i = 0; i < num; i++) { 
		obj = new Object();
		obj.product = xml[i].getElementsByTagName("product")[0].childNodes[0].nodeValue;
		obj.price = xml[i].getElementsByTagName("price")[0].childNodes[0].nodeValue;
		obj.imgFront = xml[i].getElementsByTagName("imgFront")[0].childNodes[0].nodeValue;
		obj.imgRear = xml[i].getElementsByTagName("imgRear")[0].childNodes[0].nodeValue;
		obj.brand = xml[i].getElementsByTagName("brand")[0].childNodes[0].nodeValue;
		obj.details = xml[i].getElementsByTagName("details")[0].childNodes[0].nodeValue;
		obj.detailsPost = xml[i].getElementsByTagName("type")[0].childNodes[0].nodeValue;
		array.push(obj);
	}	
	for (i = 0; i < array.length ; i++) {
		for(j = 0 ; j < array.length - i - 1; j++){ // this was missing
			var a = parseInt(array[j].price);
			var b = parseInt(array[j + 1].price);
			if (a < b) {
				obj = new Object();
				obj.product = array[j].product;
				obj.price = array[j].price;
				obj.imgFront = array[j].imgFront;
				obj.imgRear = array[j].imgRear;
				obj.brand = array[j].brand;
				obj.details = array[j].details;
				obj.detailsPost = array[j].detailsPost;
				array[j].product = array[j+1].product;
				array[j].price = array[j+1].price;
				array[j].imgFront = array[j+1].imgFront;
				array[j].imgRear = array[j+1].imgRear;
				array[j].brand = array[j+1].brand;
				array[j].details = array[j+1].details;
				array[j].detailsPost = array[j+1].detailsPost;
				array[j+1].product = obj.product;
				array[j+1].price = obj.price;
				array[j+1].imgFront = obj.imgFront;
				array[j+1].imgRear = obj.imgRear;
				array[j+1].brand = obj.brand;
				array[j+1].details = obj.details;
				array[j+1].detailsPost = obj.detailsPost;
			}
       }
     }
	return array;
}
function sortHigh(num, xml, obj, array)
{
	for (i = 0; i < num; i++) { 
		obj = new Object();
		obj.product = xml[i].getElementsByTagName("product")[0].childNodes[0].nodeValue;
		obj.price = xml[i].getElementsByTagName("price")[0].childNodes[0].nodeValue;
		obj.imgFront = xml[i].getElementsByTagName("imgFront")[0].childNodes[0].nodeValue;
		obj.imgRear = xml[i].getElementsByTagName("imgRear")[0].childNodes[0].nodeValue;
		obj.brand = xml[i].getElementsByTagName("brand")[0].childNodes[0].nodeValue;
		obj.details = xml[i].getElementsByTagName("details")[0].childNodes[0].nodeValue;
		obj.detailsPost = xml[i].getElementsByTagName("type")[0].childNodes[0].nodeValue;
		array.push(obj);
	}
	
	for (i = 0; i < array.length ; i++) {
		for(j = 0 ; j < array.length - i - 1; j++){ // this was missing
			var a = parseInt(array[j].price);
			var b = parseInt(array[j + 1].price);
			if (a > b) {
				obj = new Object();
				obj.product = array[j].product;
				obj.price = array[j].price;
				obj.imgFront = array[j].imgFront;
				obj.imgRear = array[j].imgRear;
				obj.brand = array[j].brand;
				obj.details = array[j].details;
				obj.detailsPost = array[j].detailsPost;
				array[j].product = array[j+1].product;
				array[j].price = array[j+1].price;
				array[j].imgFront = array[j+1].imgFront;
				array[j].imgRear = array[j+1].imgRear;
				array[j].brand = array[j+1].brand;
				array[j].details = array[j+1].details;
				array[j].detailsPost = array[j+1].detailsPost;
				array[j+1].product = obj.product;
				array[j+1].price = obj.price;
				array[j+1].imgFront = obj.imgFront;
				array[j+1].imgRear = obj.imgRear;
				array[j+1].brand = obj.brand;
				array[j+1].details = obj.details;
				array[j+1].detailsPost = obj.detailsPost;
			}
       }
     }
	return array;
}
function showAmount(num)
{
	var illuminate = "btn btn-default btn-sm btn-primary";
	var deIlluminate = "btn btn-default btn-sm";
	var element;
	var x = getCount();
	var guard = updateShowingProduct();
	var input = decodeURIComponent(window.location.search);
	var currentSort = document.getElementById("sortValue").innerHTML;

	
	switch(num)
	{
		case "6":
			if(x < guard || guard == 16){
				document.getElementById("show6").className = illuminate;
				document.getElementById("show12").className = deIlluminate;
				document.getElementById("showAll").className = deIlluminate;
				
				for(i = 1; i < x; i++){
					element = document.getElementsByTagName("DIV")[70];
					element.remove(70+ i);
				}
				loadXML(num,input, currentSort);

			}
			break;
		case "12":
			if(x < guard || guard == 16){
				document.getElementById("show6").className = deIlluminate;
				document.getElementById("show12").className = illuminate;
				document.getElementById("showAll").className = deIlluminate;
				
				for(i = 1; i < x; i++){
					element = document.getElementsByTagName("DIV")[70];
					element.remove(70+ i);
				}
				loadXML(num,input, currentSort);
			}
			break;
		case "all":
				if(x < guard || guard == 16){
					document.getElementById("show6").className = deIlluminate;
					document.getElementById("show12").className = deIlluminate;
					document.getElementById("showAll").className = illuminate;
				
					for(i = 1; i < x; i++){
						element = document.getElementsByTagName("DIV")[70];
						element.remove(70+ i);
					}
					loadXML(guard,input, currentSort);
				}


			
			break;
		default:
		alert("error has occurred");
	}
}
function sort(currentSort)
{
	var input = decodeURIComponent(window.location.search);
	var x = getCount();
	document.getElementById("sortValue").innerHTML = currentSort;
	
	for(i = 1; i < x; i++){
		element = document.getElementsByTagName("DIV")[70];
		element.remove(70+ i);
	}
	loadXML(x, input, currentSort);
}
function getCount(){
	var count = 0;
	var detailsPost = "detailsPost"
	var i;
	var a;
	for(i = 1; i < 21; i++){
		try{
			document.getElementById(detailsPost.concat(i.toString())).innerHTML;
			count++;
		}
		catch(err){
			break;
		}
	}
	return count;
}
$( function() {
    var availableTags = getXml();
    $( "#search1" ).autocomplete({
      source: availableTags,
	  select: function (event, ui) {
		complete(ui.item.label);
      },
    });
  } 
  );
  
  function getXml(){
	var array = [];
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET", "xml/index.xml", false);
	xmlhttp.setRequestHeader("Content-Type", "text/xml");
	xmlhttp.send(null);
	var xmlDoc = xmlhttp.responseXML;
	var xml = xmlDoc.getElementsByTagName("index");
	for (i = 0; i < xml.length; i++) { 
		array.push(xml[i].getElementsByTagName("product")[0].childNodes[0].nodeValue);
	}
	return array;
  }
  
  function complete(input){
	var array = [];
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET", "xml/index.xml", false);
	xmlhttp.setRequestHeader("Content-Type", "text/xml");
	xmlhttp.send(null);
	var xmlDoc = xmlhttp.responseXML;
	var xml = xmlDoc.getElementsByTagName("index");
	for (i = 0; i < xml.length; i++) {
		if(xml[i].getElementsByTagName("product")[0].childNodes[0].nodeValue == input){
			var obj = new Object();
			obj.product = xml[i].getElementsByTagName("product")[0].childNodes[0].nodeValue;
			obj.price = xml[i].getElementsByTagName("price")[0].childNodes[0].nodeValue;
			obj.imgFront = xml[i].getElementsByTagName("imgFront")[0].childNodes[0].nodeValue;
			obj.imgRear = xml[i].getElementsByTagName("imgRear")[0].childNodes[0].nodeValue;
			obj.brand = xml[i].getElementsByTagName("brand")[0].childNodes[0].nodeValue;
			obj.details = xml[i].getElementsByTagName("details")[0].childNodes[0].nodeValue;
			obj.detailsPost = xml[i].getElementsByTagName("type")[0].childNodes[0].nodeValue;
			array.push(obj);	
		}
	}
	var x = getCount();
	for(i = 1; i < x; i++){
		element = document.getElementsByTagName("DIV")[70];
		element.remove(71+ i);
	}
	for(var i = 0; i < 1; i++){
		document.getElementById("h3Element1").innerHTML = array[i].product;
		document.getElementById("priceElement1").innerHTML = "$AU"+array[i].price;
		document.getElementById("imgFront1").src = array[i].imgFront;
		document.getElementById("imgBack1").src = array[i].imgRear;
		document.getElementById("brand1").innerHTML = array[i].brand;
		document.getElementById("details1").innerHTML = array[i].details;
		document.getElementById("detailsPost1").href = "detail.php?".concat(array[i].detailsPost); 
		document.getElementById("addToCart1").href = "basket.php?".concat(array[i].detailsPost);
		document.getElementById("returnShopping1").style.visibility = "visible";
	}
	
  }
  
	function login(){
		var email = document.getElementById("email-modal").value;
		var password = document.getElementById("password-modal").value;
		var input = new loginClass(email, password);
			$.ajax({
			url: 'AuthenticationManager.php',
			type: 'post',
			dataType: "JSON",
			data: { "login": input},
			success: function(response) 
			{ 
				switch(response)
				{
					case "exist":
						
						document.getElementById("email-modal").style.color = "#FF0000";
						document.getElementById("email-modal").style.borderColor = "#FF0000";
						document.getElementById("email-modal").value = "*REQUIRr";
						document.getElementById("password-modal").style.color = "#FF0000";
						document.getElementById("password-modal").style.borderColor = "#FF0000";
						document.getElementById("password-modal").value = "*REQUIRt";
						document.getElementById("password-modal").type = "text";
						break;
					case "nulls":
						document.getElementById("email-modal").style.color = "#FF0000";
						document.getElementById("email-modal").style.borderColor = "#FF0000";
						document.getElementById("email-modal").value = "no account exist";
						document.getElementById("password-modal").style.color = "#FF0000";
						document.getElementById("password-modal").style.borderColor = "#FF0000";
						document.getElementById("password-modal").value = "Incorrect input please they again...";
						document.getElementById("password-modal").type = "text";
						break;
					case "fail":
						alert(response);
						document.getElementById("email-modal").style.color = "#FF0000";
						document.getElementById("email-modal").style.borderColor = "#FF0000";
						document.getElementById("email-modal").value = "no account exist";
						document.getElementById("password-modal").style.color = "#FF0000";
						document.getElementById("password-modal").style.borderColor = "#FF0000";
						document.getElementById("password-modal").value = "Wrong password or email. Please try again..";
						document.getElementById("password-modal").type = "text";
						break;
					case "no account exist":
						document.getElementById("email-modal").style.color = "#FF0000";
						document.getElementById("email-modal").style.borderColor = "#FF0000";
						document.getElementById("email-modal").value = "no account exist";
						document.getElementById("password-modal").style.color = "#FF0000";
						document.getElementById("password-modal").style.borderColor = "#FF0000";
						document.getElementById("password-modal").value = "Wrong password or email. Please try again..";
						document.getElementById("password-modal").type = "text";
						break;
					case "passFail":
						document.getElementById("email-modal").style.color = "#FF0000";
						document.getElementById("email-modal").style.borderColor = "#FF0000";
						document.getElementById("password-modal").style.color = "#FF0000";
						document.getElementById("password-modal").style.borderColor = "#FF0000";
						document.getElementById("password-modal").value = "Wrong password or email";
						document.getElementById("password-modal").type = "text";
						break;
					case "success":
						location.reload();
						break;
					default:
						break;
				}
			}
			});
  }
  
  function logoff(){
	$.ajax({
	url: 'AuthenticationManager.php',
	type: 'post',
	dataType: "JSON",
	data: { "logoff": ""},
	success: function(response) 
	{ 
		if(response == "success"){
			location.reload();
		}
	}
	});
  }
  
  function loginClass(email, password){
	  this.email = email;
	  this.password = password;
  }
  
	function removeBorderRed(input){
		if(document.getElementById(input).style.borderColor == "rgb(255, 0, 0)"){
				document.getElementById(input).style.borderColor = "#CDCDCD";
				document.getElementById(input).value = "";
				document.getElementById(input).style.color = "black";
				if(input == "password-modal"){
					document.getElementById(input).type = "password";
				}
				
		}
	}
	
	function register(){
		var email = document.getElementById("email").value;
		var password = document.getElementById("password").value;
		var input = new registerClass(email, password);
		$.ajax({
		url: 'AuthenticationManager.php',
		type: 'post',
		dataType: "JSON",
		data: { "register": input},
		success: function(response) 
		{ 
			switch(response)
			{
				case "fail":
					document.getElementById("email").style.color = "#FF0000";
					document.getElementById("email").style.borderColor = "#FF0000";
					document.getElementById("password").style.color = "#FF0000";
					document.getElementById("password").style.borderColor = "#FF0000";
					break;
				case "nulls":
					document.getElementById("email").style.color = "#FF0000";
					document.getElementById("email").style.borderColor = "#FF0000";
					document.getElementById("email").value = "*REQUIRED";
					document.getElementById("password").style.color = "#FF0000";
					document.getElementById("password").style.borderColor = "#FF0000";
					document.getElementById("password").value = "*REQUIRED";
					document.getElementById("password").type = "text";
					break;
				case "exist":
					document.getElementById("email").style.color = "#FF0000";
					document.getElementById("email").style.borderColor = "#FF0000";
					document.getElementById("email").value = "*EMAIL ALREADY EXIST. PLEASE TRY ANOTHER";
					break;
				case "success":
					window.location.href = "shop-furniture.php";
					break;
				default:
					alert(response);
					break;
			}
		}
		});			
	}
		
	function registerClass(email, password){
		this.email = email;
		this.password = password;
	}
	
	
  
</script>