<?php
    if (isset($_POST['setSession'])) {
		session_start();
		echo setSession($_POST['setSession']);	
    }
	if (isset($_POST['getSession'])) {
		session_start();
		echo getSession($_POST['getSession']);	
    }
	
	
	function setSession($summary){
		$_SESSION["orderSummary"] = $summary;
		return json_encode($summary);
	}
	
	function unsetSession($summary){
		unset($_SESSION["orderSummary"]);
		return json_encode($summary);
	}
	
	function getSession($summary){
		return json_encode($_SESSION["orderSummary"]);
	}
?>