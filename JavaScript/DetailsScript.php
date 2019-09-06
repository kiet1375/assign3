	<script type="text/javascript" charset="UTF-8">
	
		function details(){
			var input = decodeURIComponent(window.location.search);
			var cut = input.split("?");
			loadDetails(cut[1]);
		}
		
		function loadDetails(type){
			  var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						loadView(this, type);
					}
				};
				xmlhttp.open("GET", "xml/catalog.xml", true);
				xmlhttp.send();
			
		}
		
		function loadView(xml, type){
			var xmlDoc = xml.responseXML;
			var xml;
			var y;
			var i;
			var j;

			xml = xmlDoc.getElementsByTagName("index");
			
			 for (i= 0; i < xml.length; i++ ){
				if(xml[i].getElementsByTagName("type")[0].childNodes[0].nodeValue  == type){
					document.getElementById("img1").src = xml[i].getElementsByTagName("imgFront")[0].childNodes[0].nodeValue;
					document.getElementById("h1Element").innerHTML = xml[i].getElementsByTagName("product")[0].childNodes[0].nodeValue;
					document.getElementById("price").innerHTML = "$AU" + xml[i].getElementsByTagName("price")[0].childNodes[0].nodeValue + ".00";
					document.getElementById("description").innerHTML = xml[i].getElementsByTagName("details")[0].childNodes[0].nodeValue;
					document.getElementById("brand").innerHTML = xml[i].getElementsByTagName("brand")[0].childNodes[0].nodeValue;
					y = xml[i].getElementsByTagName("care");
					for(j = 0; j < y.length; j++){
						if(y[j].getElementsByTagName("material1")[0].childNodes[0].nodeValue  != "placeHolder"){
							document.getElementById("material1").innerHTML = y[j].getElementsByTagName("material1")[0].childNodes[0].nodeValue;
							document.getElementById("material1").hidden = false;	
						}
						if(y[j].getElementsByTagName("material2")[0].childNodes[0].nodeValue != "placeHolder"){
							document.getElementById("material2").innerHTML = y[j].getElementsByTagName("material2")[0].childNodes[0].nodeValue;
							document.getElementById("material2").hidden = false;
						}
						document.getElementById("instruction").innerHTML = y[j].getElementsByTagName("instruction")[0].childNodes[0].nodeValue;
					}
				}
			 }
		}
	</script>