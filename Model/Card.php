<?php

class Card
{
	var $name;
	var $cardNumber;
	var $expiryMonth;
	var $expiryYear;
	var $CVV;
	var $orderId;
	
	/* Member functions */
    function setName($par){
        $this->name = $par;
    } 
    function getName(){
        return $this->name;
    }
    function setCardNumber($par){
        $this->cardNumber = $par;
    } 
    function getCardNumber(){
        return $this->cardNumber;
    }
	function setExpiryMonth($par){
        $this->expiryMonth = $par;
    } 
    function getExpiryMonth(){
        return $this->expiryMonth;
    }
	function setExpiryYear($par){
        $this->expiryYear = $par;
    } 
    function getExpiryYear(){
        return $this->expiryYear;
    }
	function setCVV($par){
        $this->CVV = $par;
    } 
    function getCVV(){
        return $this->CVV;
    }
	function setOrderId($par){
        $this->orderId = $par;
    } 
    function getOrderId(){
        return $this->orderId;
    }
}
?>