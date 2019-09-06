<?php
class Contact
{
	var $firstName;
	var $lastName;
	var $email;
	var $subject;
	var $message;
	
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
	function setEmail($par){
        $this->email = $par;
    } 
    function getEmail(){
        return $this->email;
    }
	function setSubject($par){
        $this->subject = $par;
    } 
    function getSubject(){
        return $this->subject;
    }
	function setMessage($par){
        $this->message = $par;
    } 
    function getMessage(){
        return $this->message;
    }
}
?>