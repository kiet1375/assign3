<?php

class Form
{
	var $firstName;
	var $lastName;
	var $address;
	var $company;
	var $city;
	var $postcode;
	var $state;
	var $country;
	var $phone;
	var $area;
	var $email;
	
	/* Member functions */
    function setFirstName($par){
        $this->firstName = $par;
    } 
    function getFirstName(){
        return $this->firstName;
    }
    function setLastName($par){
        $this->lastName = $par;
    } 
    function getLastName(){
        return $this->lastName;
    }
	function setAddress($par){
        $this->address = $par;
    } 
    function getAddress(){
        return $this->address;
    }
	function setCompany($par){
        $this->company = $par;
    } 
    function getCompany(){
        return $this->company;
    }
	function setCity($par){
        $this->city = $par;
    } 
    function getCity(){
        return $this->city;
    }
	function setPostcode($par){
        $this->postcode = $par;
    } 
    function getPostcode(){
        return $this->postcode;
    }
	function setState($par){
        $this->state = $par;
    } 
    function getState(){
        return $this->state;
    }
	function setCountry($par){
        $this->country = $par;
    } 
    function getCountry(){
        return $this->country;
    }
	function setArea($par){
        $this->area = $par;
    } 
    function getArea(){
        return $area->type;
    }
	function setPhone($par){
        $this->phone = $par;
    } 
    function getPhone(){
        return $phone->type;
    }
	function setEmail($par){
        $this->email = $par;
    } 
    function getEmail(){
        return $this->email;
    }
}
?>