<style> <!-- rotator effect came from https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_loader -->
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 60px;
  height: 60px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<?php

session_start();
if(isset($_SESSION['digit'])){
	if($_POST['captcha'] == $_SESSION['digit']){
		require_once("global-connect.inc.php");
		require_once("Model/Contact.php");
		$itID = 0;
		print("succuss");
		echo "<div class='loader' width='50' height='50'></div>";
		
		if($_POST['firstName'] == ""){
			echo "*required first name<br>";
		}
		if($_POST['lastName'] == ""){
			echo "*required last name<br>";
		}
		if($_POST['email'] == ""){
			echo "*required email<br>";
		}
		if($_POST['subject'] == ""){
			echo "*required subject<br>";
		}
		if($_POST['message'] == ""){
			echo "*required message<br>";
		}
		else{
			$contact = htmlEntitiesCheck();
			
			$query = "SELECT max(ID) FROM Contact";
			
			$stmt = oci_parse($db, $query);
			
			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			oci_execute($stmt);
			
			if(oci_fetch_array($stmt)){

				$itID = oci_result($stmt,1);
			}
			$itID++;
			
			$query = "INSERT INTO Contact VALUES ('" . $itID . "' , '" . $contact->getFirstName(). "', '" . $contact->getLastName() . "' , '" . $contact->getEmail() . "', '" . $contact->getSubject() . "' , '" . $contact->getMessage() ."')";
			$stmt = oci_parse($db, $query);
			
			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			oci_execute($stmt);
			oci_close($db);
			//echo $contact-> getLast(). "<br>";
		}
		
			
		//header( "refresh:5;url=contact.php" );
	}
	else{
		header("Location: contact.php?redirect");
	}
}

function htmlEntitiesCheck(){
		$contact = new Contact;
		$contact->setFirstName(htmlspecialchars_decode($_POST['firstName'],ENT_QUOTES));
		$contact->setFirstName(htmlentities($contact-> getFirstName()));
		$contact->setLastName(htmlspecialchars_decode($_POST['lastName'],ENT_QUOTES));
		$contact->setLastName(htmlentities($contact-> getLastName()));
		$contact->setEmail(htmlspecialchars_decode($_POST['email'],ENT_QUOTES));
		$contact->setEmail(htmlentities($contact-> getEmail()));
		$contact->setSubject(htmlspecialchars_decode($_POST['subject'],ENT_QUOTES));
		$contact->setSubject(htmlentities($contact-> getSubject()));
		$contact->setMessage(htmlspecialchars_decode($_POST['message'],ENT_QUOTES));
		$contact->setMessage(htmlentities($contact-> getMessage()));	
		
		return $contact;
}

?>