<?php require_once("Model/Form.php") ?>
<?php require_once("Model/Card.php") ?>
<?php

    if (isset($_POST['getPostcode'])) {
		session_start();
		echo getPostcode($_POST['getPostcode']);	
    }
	
	if (isset($_POST['validateForm'])) {
		session_start();
		echo validateForm($_POST['validateForm']);	
    }
	
	if (isset($_POST['validateCard'])) {
		session_start();
		echo validateCard($_POST['validateCard']);	
    }
	
	if (isset($_POST['getDetails'])) {
		session_start();
		echo getDetails($_POST['getDetails']);	
    }
	
	if (isset($_POST['getCard'])) {
		session_start();
		echo getCard($_POST['getCard']);	
    }
	
	function getPostcode($postcode){
		// create a new cURL resource
		$ch = curl_init();
		$url = "http://v0.postcodeapi.com.au/suburbs/";
		$url .= $postcode;
		$url .= ".json";

		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);

		// grab URL and pass it to the browser
		curl_exec($ch);

		// close cURL resource, and free up system resources
		curl_close($ch);
		return json_encode($ch);
	}
	
	function validateForm($form){
		
		$invalid = "";
		
		$form = formHtmlEntitiesCheck($form); // run html entities check;
		 
		if(!preg_match('/^[A-Za-z]{2,30}$/', $form["firstName"]) || $form["firstName"] == ""){
			$invalid = "invalid";
			$form["firstName"] = $invalid;
		}
		if(!preg_match('/^[A-Za-z]{2,30}$/', $form["lastName"]) || $form["lastName"] == ""){
			$invalid = "invalid";
			$form["lastName"] = $invalid;
		}
		if(!preg_match('/[A-Za-z0-9\s]+/', $form["address"]) || $form["address"] == ""){
			$invalid = "invalid";
			$form["address"]= $invalid;
		}
		if(!preg_match('/[A-Za-z\s]+/', $form["city"]) || $form["city"] == ""){
			$invalid = "invalid";
			$form["city"] = $invalid;
		}
		if(!preg_match('/[0-9]{4}/', $form["postcode"]) || $form["postcode"] == ""){
			$invalid = "invalid";
			$form["postcode"] = $invalid;
		}
		if(!preg_match('/[A-Za-z]+/', $form["state"]) || $form["state"] == ""){
			$invalid = "invalid";
			$form["state"] = $invalid;
		}
		if(!$form["country"] == "Australia" || $form["country"] == ""){
			$invalid = "invalid";
			$form["country"] = $invalid;
		}
		if($form["area"] == "select"){
			$invalid = "invalid";
			$form["area"] = $invalid;
		}
		if(!preg_match('/[0-9\s]{8,9}$/', $form["phone"]) || $form["phone"] == ""){
			$invalid = "invalid";
			$form["phone"] = $invalid;
		}
		if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $form["email"]) || $form["email"] == ""){
			$invalid = "invalid";  //https://emailregex.com
			$form["email"] = $invalid;
		}
		if($invalid == ""){
			$_SESSION["form"] = $form;
		}

		return json_encode($form);
	}
	
	function validateCard($card){
		
		$invalid = "";
		
		$card = cardHtmlEntitiesCheck($card); // run html entities check
		
		if(!preg_match('/^[A-Za-z\s]{2,30}$/', $card["name"]) || $card["name"] == ""){
			$invalid = "invalid";
			$card["name"]= $invalid;
		}
		if(!preg_match('/[0-9\s]{16,19}/', $card["cardNumber"]) || $card["cardNumber"] == ""){
			$invalid = "invalid";
			$card["cardNumber"] = $invalid;
		}
		if(!preg_match('/^[0-9]{2}$/', $card["expiryMonth"]) || $card["expiryMonth"] == ""){
			$invalid = "invalid";
			$card["expiryMonth"] = $invalid;
		}
		if(!preg_match('/^[0-9]{2}$/', $card["expiryYear"]) || $card["expiryYear"] == ""){
			$invalid = "invalid";
			$card["expiryYear"] = $invalid;
		}
		if(!preg_match('/^[0-9]{3}$/', $card["CVV"]) || $card["CVV"] == ""){
			$invalid = "invalid";
			$card["CVV"] = $invalid;
		}
		if($invalid == ""){
			$_SESSION["card"] = $card;
		}
		return json_encode($card);
	}
	
	function getDetails($email){
		
		require_once("global-connect.inc.php");
		
		$obj = "";
		
		$query ="SELECT * FROM Customer WHERE Email = '". $_COOKIE["user"] ."'";;
			
			$stmt = oci_parse($db, $query);

			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			oci_execute($stmt);
		
			if(oci_fetch_array($stmt)){
				$obj = new Form;
				$obj->email = oci_result($stmt,"EMAIL");
				$obj->firstName= oci_result($stmt,"FIRSTNAME");
				$obj->lastName = oci_result($stmt,"LASTNAME");
				$obj->address = oci_result($stmt,"ADDRESS");
				$obj->city = oci_result($stmt,"CITY");
				$obj->postcode = oci_result($stmt,"POSTCODE");
				$obj->state = oci_result($stmt,"STATE");
				$obj->country = "Australia";
				$obj->area = oci_result($stmt,"AREACODE");
				$obj->phone = oci_result($stmt,"TELEPHONE");
				$obj->company = oci_result($stmt,"COMPANY");
			}
			oci_close($db);

			return json_encode($obj);
	}
	
	function getCard($email){
		
		require_once("global-connect.inc.php");
		
		$obj = "";
		
		$query ="SELECT * FROM CARD WHERE Email = '". $_COOKIE['user'] ."'";
			
		$stmt = oci_parse($db, $query);

		if(!$stmt) {
			echo "An error occurred in parsing the sql string.\n";
			exit;
		}
		oci_execute($stmt);
			
		if(oci_fetch_array($stmt)){
			$obj = new Card;
			$obj->name = oci_result($stmt,"NAME");
			$obj->cardNumber = oci_result($stmt,"CARDNUMBER");
			$obj->expiryMonth = oci_result($stmt,"EXPIRYMONTH");
			$obj->expiryYear = oci_result($stmt,"EXPIRYYEAR");
			$obj->CVV = oci_result($stmt,"CVV");
		}
			
		oci_close($db);
		
		return json_encode($obj);
			
	}
	
	function formHtmlEntitiesCheck($form){ //check for tags and fix the problem
		$form['email'] = htmlspecialchars_decode($form['email'],ENT_QUOTES); //htmlspecialchars_decode  converts HTML entities to characters
		$form['email'] = htmlentities($form['email']); //htmlentities convert all applicable characters to HTML entities
		$form['firstName'] = htmlspecialchars_decode($form['firstName'],ENT_QUOTES);
		$form['firstName'] = htmlentities($form['firstName']); 
		$form['lastName'] = htmlspecialchars_decode($form['lastName'],ENT_QUOTES);
		$form['lastName'] = htmlentities($form['lastName']); 
		$form['address'] = htmlspecialchars_decode($form['address'],ENT_QUOTES);
		$form['address'] = htmlentities($form['address']); 
		$form['city'] = htmlspecialchars_decode($form['city'],ENT_QUOTES);
		$form['city'] = htmlentities($form['city']); 
		$form['postcode'] = htmlspecialchars_decode($form['postcode'],ENT_QUOTES);
		$form['postcode'] = htmlentities($form['postcode']);
		$form['state'] = htmlspecialchars_decode($form['state'],ENT_QUOTES);
		$form['state'] = htmlentities($form['state']);
		$form['country'] = htmlspecialchars_decode($form['country'],ENT_QUOTES);
		$form['country'] = htmlentities($form['country']);
		$form['area'] = htmlspecialchars_decode($form['area'],ENT_QUOTES);		
		$form['area'] = htmlentities($form['area']); 
		$form['phone'] = htmlspecialchars_decode($form['phone'],ENT_QUOTES);
		$form['phone'] = htmlentities($form['phone']); 
		$form['company'] = htmlspecialchars_decode($form['company'],ENT_QUOTES);
		$form['company'] = htmlentities($form['company']); 


		return $form;
	}
	
	function cardHtmlEntitiesCheck($card){ //check for tags and fix the problem
		$card['name'] = htmlspecialchars_decode($card['name'], ENT_QUOTES);
		$card['name'] = htmlentities($card['name']);
		$card['cardNumber'] = htmlspecialchars_decode($card['cardNumber'], ENT_QUOTES);
		$card['cardNumber'] = htmlentities($card['cardNumber']);
		$card['expiryMonth'] = htmlspecialchars_decode($card['expiryMonth'], ENT_QUOTES);
		$card['expiryMonth'] = htmlentities($card['expiryMonth']);
		$card['expiryYear'] = htmlspecialchars_decode($card['expiryYear'], ENT_QUOTES);
		$card['expiryYear'] = htmlentities($card['expiryYear']);
		$card['CVV'] = htmlspecialchars_decode($card['CVV'], ENT_QUOTES);
		$card['CVV'] = htmlentities($card['CVV']);
		
		return $card;

	}
	
?>
