<?php
class AES256
{
	var $password;
	var $cryptoKey;
	var $salt;
	
		/* Member functions */
    function setPassword($par){
        $this->password = $par;
    } 
    function getPassword(){
        return $this->password;
    }
    function setCryptoKey($par){
        $this->cryptoKey = $par;
    } 
    function getCryptoKey(){
        return $this->cryptoKey;
    }
	function setSalt($par){
        $this->salt = $par;
    } 
    function getSalt(){
        return $this->salt;
    }
    
	
	function encrypt($par){
		
		//https://gist.github.com/odan/138dbd41a0c5ef43cbf529b03d814d7c   
		
		// I have updated and made it more 
	   //  secure with random inputs.
		$aes256 = new AES256; 
		
		$aes256 = $aes256-> crytoSalt($aes256);

		$method = 'aes-256-cbc';
		  
         $key = password_hash($aes256->getSalt(), PASSWORD_BCRYPT, ['cost' => 12]);

		// IV must be exact 16 chars (128 bit)
		$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

		// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
		$encryp = base64_encode(openssl_encrypt($par, $method, $key, OPENSSL_RAW_DATA, $iv));
		
		$aes256-> setPassword($encryp);
		$aes256-> setCryptoKey($key);
		
		return $aes256;
    }
	  
	function decrypt($aes256){
		
		$method = 'aes-256-cbc';  
		// IV must be exact 16 chars (128 bit)
		$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
		  
		$decrypted = openssl_decrypt(base64_decode($aes256-> getPassword()), $method, $aes256-> getCryptoKey(), OPENSSL_RAW_DATA, $iv);
		
		return $decrypted;
	}
	
	function crytoSalt($aes256){

		$salt  = substr(base_convert(sha1(uniqid(mt_rand())), 16, 24), 0, 6);
		$salt = $salt . substr(base_convert(sha1(uniqid(mt_rand())), 8, 32), 0, 6);
		$salt = md5($salt);
		$aes256->setSalt($salt);
		
		return $aes256;
	}

}
?>