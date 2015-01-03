<?php
class Security	{
	private $session_title;
	function __construct($session_title)	{
		$this->session_title		=	$session_title;
	}
	function setSession($value)	{
		$_SESSION[$this->session_title]	=	$value;
	}
	function isSession()	{
		$flag		=	(isset($_SESSION[$this->session_title]))? true : false;
		return $flag;
	}
	function getSessionValue()	{
		return $_SESSION[$this->session_title];
	}
	function unsetSession()	{
		session_unset($this->session_title);
	}
	function encript($text)	{
			return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
	}

	function decrypt($text)    {
			return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
	}
}


?>
