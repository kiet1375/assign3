<?php

class Item
{
	var $type;
	var $imgFront;
	var $imgRear;
	var $productName;
	var $brand;
	var $price;
	var $details;
	var $qty;
	var $id;
	
	/* Member functions */
    function setTypeName($par){
        $this->type = $par;
    } 
    function getTypeName(){
        return $this->type;
    }
	function setImgFront($par){
        $this->imgFront = $par;
    } 
    function getImgFront(){
        return $this->imgFront;
    }
	function setImgRear($par){
        $this->imgRear = $par;
    } 
    function getImgRear(){
        return $this->imgRear;
    }
	function setProductName($par){
        $this->productName = $par;
    } 
    function getProductName(){
        return $this->productName;
    }
	function setBrand($par){
        $this->brand = $par;
    } 
    function getBrand(){
        return $this->brand;
    }
	function setPrice($par){
        $this->price = $par;
    } 
    function getPrice(){
        return $this->price;
    }
	function setDetails($par){
        $this->details = $par;
    } 
    function getDetails(){
        return $this->details;
    }
	function setId($par){
        $this->id = $par;
    } 
    function getId(){
        return $this->id;
    }
	function setQty($par){
        $this->qty = $par;
    } 
    function getQty(){
        return $this->qty;
    }
}
?>