<?php
class Url	{
	function getGenralurl($url)	{
		$curreent_url 	=		NULL;

		if(substr($url,0,7) == 'http://')	{		
			$url			=		substr($url,7);		//adress like www.dixeam.com/?a=12&b=20
		}
		
		for($i = 0; $i < strlen($url) && ($url[$i] != "/" && $url[$i] != "?")  ; $i++)	{
			$curreent_url	.=	$url[$i];
		}
		return "http://" . $curreent_url;
	}
 	function curPageURL() {
		 $pageURL = 'http';
		 if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL;
	} 
	function getCurrentPageName()	{
		$currentFile = $_SERVER["PHP_SELF"];
		$parts = Explode('/', $currentFile);
		return $parts[count($parts) - 1];
	}
	function remove_querystring_var($url, $key) {
		if(!isset($_GET['p']) && count($_GET)  != 0 )	{
			$url = preg_replace('/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . "&"); 
			$url = substr($url, 0, -1); 
			return $url."&p="; 
		}
	  if(isset($_GET['p']) && count($_GET)==1)	{
		  $url_array		=	explode($url,"?");
		  $url				=	$url_array[0];
		  return $url."p=";
	  }else {
		  $url_array		=	explode($url,"?");
		  $url				=	$url_array[0];
		  return $url."p=";
	  }
	 
	  
	}
	function GetPrePage($cond,$page,$post)	{
		$page   = $page - 1;
		$position 		= 	strrpos($this->curPageURL(), "&page=");
		if($position > 0)	{
			$url			=	$this->remove_querystring_var($this->curPageURL(),"pageUrl");
			$current_url	= 	substr($url, 0, $position).'&page='.$page;
		}else {
			$url			=	$this->remove_querystring_var($this->curPageURL(),"pageUrl");
			$current_url	=	$url.'&page='.$page;
		}
		$this->remove_querystring_var("$current_url","pageUrl");
		return $current_url;
		
	}
	function GetNextPage($cond,$page,$post)	{
		  $page++;
		  $position 		= 	strrpos($this->curPageURL(), "&page=");
		  if($position > 0)	{
			  $url			=	$this->remove_querystring_var($this->curPageURL(),"pageUrl");
			  $current_url	= substr($url, 0, $position).'&page='.$page;
		  }else {
			  $url			=	$this->remove_querystring_var($this->curPageURL(),"pageUrl");
			  $current_url	=	$url.'&page='.$page;
		  }
		  return $current_url;
	}
	function PageUrl($page)	{

		if(substr($this->curPageURL(),-4,4) == '.php'  )	{
			return $this->curPageURL() . "?pageUrl=" . $page;	
		}	else if(substr($this->curPageURL(),-4,4) == '.com')	{
			return $this->curPageURL() . "?pageUrl=" . $page;
		}	else if(substr($this->curPageURL(),-5,5) == '.com/')	{// edit by mush .. please change this logic
			return $this->curPageURL() . "?pageUrl=" . $page;
		}	else {
			$position 				= 	strrpos($this->curPageURL(), "pageUrl=");
			if($position > 0)	{
				return substr($this->curPageURL(), 0, $position).'pageUrl='.$page;		
			}else {
				return $this->curPageURL().'&pageUrl='.$page;
			}
		}
	}
	function getGenralurlWthoutPrefix($url)	{
		$curreent_url 	=		NULL;
		$string_lenght	=		strlen($url);
		
		if(substr($url,0,7) == 'http://')	{		
			$url			=		substr($url,7);		//adress like www.dixeam.com/?a=12&b=20
		}
		if(substr($url,0,4) == 'www.')	{		
			$url			=		substr($url,4);		//adress like www.dixeam.com/?a=12&b=20
		}
	
		for($i = 0; $i < strlen($url) && ($url[$i] != "/" && $url[$i] != "?")  ; $i++)	{
			$curreent_url	.=	$url[$i];
		}
		return $curreent_url;
	}
}
$url_obj	=		new Url();
?>