<?php 
class Register
{
	var $name;
	var $email;
	var $password;
	
	      /* Member functions */
      function setName($par){
         $this->name = $par;
      }
      
      function getName(){
         echo $this->name ."<br/>";
      }
      
      function setEmail($par){
         $this->email = $par;
      }
      
      function getEmail(){
         echo $this->email ." <br/>";
      }
	  
	  function setPassword($par){
         $this->password = $par;
      }
      
      function getPassword(){
         echo $this->password ." <br/>";
      }
}
?>