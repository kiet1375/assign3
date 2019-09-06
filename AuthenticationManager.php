<?php 
	include_once("Model/AES256.php");
	
    if (isset($_POST['login'])) {
		session_start();
		echo login($_POST['login']);	
    }
	
	if (isset($_POST['logoff'])) {
		session_start();
		echo logoff($_POST['logoff']);	
    }
	
	if (isset($_POST['register'])) {
		session_start();
		echo register($_POST['register']);	
    }
	
	function login($login){
		
		$aes256 = '';
		
		if($login["email"] =="" || $login["email"] =="*REQUIRED" || $login["password"] =="" || 
		   $login["password"] =="*REQUIRED"){
			return json_encode("nulls");
		}
		
		$login = htmlEntitiesCheck($login); //ASSIGNMENT 3 SECURITY CHECK
		
		require_once("global-connect.inc.php");
		
		$query ="SELECT * FROM UserAccount WHERE Email = '". $login['email'] ."'"; //HTML PASSED FOR XXS ATTACK 
		$stmt = oci_parse($db, $query);
		
	
		if(!$stmt) {
			echo "An error occurred in parsing the sql string.\n";
			exit;
			return false;
		}
		
		oci_execute($stmt);
		while(oci_fetch_array($stmt)) {
			$aes256 = new AES256;
			$aes256->setPassword(oci_result($stmt,"PASSWORD"));
			$aes256-> setCryptoKey(oci_result($stmt,"CRYPTOKEY"));		
		}
		// Close the connection
		oci_close($db);	
		
		if($aes256 != ""){
			if($aes256 -> decrypt($aes256) == $login["password"]){
				setcookie("user", $login['email'], time()+7200);
				return json_encode("success");	
			}
			else{
				return json_encode("passFAIL");
			}
		}
		else{
			return json_encode("no account exist");
		}
		
	}
	
	function logoff(){
		setcookie("user", "", time() - 7200);
		return json_encode("success");
	}
	
	function register($register){
		if($register["email"] =="" || $register["email"] =="*REQUIRED" || $register["password"] =="" || 
		   $register["password"] =="*REQUIRED"){
			return json_encode("nulls");
		}
		$count = 0;
		require_once("global-connect.inc.php");
		
		$query ="SELECT * FROM UserAccount WHERE Email = '".$register['email']."'";
		
		$stmt = oci_parse($db, $query);
		
	
		if(!$stmt) {
			echo "An error occurred in parsing the sql string.\n";
			exit;
		}
		
		oci_execute($stmt);
		while(oci_fetch_array($stmt)) {
			$count++;
		}
			
		if($count == 0){
			$aes256 = new AES256;
			$aes256 = $aes256-> encrypt($register['password']);
			$query ="INSERT INTO UserAccount VALUES ('". $register['email'] ."', '" . $aes256-> getPassword() . "', '" . $aes256->getCryptoKey() ."' , '". $aes256-> getSalt() . "')";
			$stmt = oci_parse($db, $query);
			if(!$stmt) {
				echo "An error occurred in parsing the sql string.\n";
				exit;
			}
			oci_execute($stmt);
			oci_close($db);
			return json_encode("success");
		}
		else{
			return json_encode("exist");
		}
	}
	
	function htmlEntitiesCheck($input){
		
		$input['email'] = htmlspecialchars_decode($input['email'],ENT_QUOTES);
		$input['email'] = htmlentities($input['email']);
		$input['password'] = htmlspecialchars_decode($input['password'], ENT_QUOTES);
		$input['password'] = htmlentities($input['password']);

		
		return $input;
	}
	
	function validateLogin($login){
		if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $form["email"]) || $form["email"] == ""){
			$login["email"] = false;   //https://emailregex.com
			return false;
		}
		
		if(!preg_match('/^[.*] {1, 256}$/', $login["password"]) || $login["password"] == ""){
			$login["password"] = false;
		}
		
		return true;
		
	}
?>