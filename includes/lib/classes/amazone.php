<?php
//////////////////////////////////////////////////////////////
//															//
//															//
//					Amazone Class    						//
//															//
//															//
//															//
//////////////////////////////////////////////////////////////

define("AMAZONE_EMAIL",trim($user_setting['amazone_email']));
define("AMAZONE_PASSWORD",trim($user_setting['amazone_password']));
define("AMAZONE_URL",trim('https://sellercentral.amazon.com/gp/homepage.html'));


class Amazone	{
	var 	$email;
	var 	$password;
	var		$login_url;
	var		$ch;
	function __construct($email, $password, $login_url)	{
		$this->email			=	$email;
		$this->password			=	$password;
		$this->login_url		=	$login_url;
		$this->ch				=	curl_init();
	}
	function amazoneMWS($scrap_url)	{
		
		
		$cookie_file = "amazoncookie.txt";
		
		
		
			
		curl_setopt($this->ch, CURLOPT_URL, $scrap_url);
		if (file_exists($cookie_file) && filesize($cookie_file) > 0) {
			
		} else {
			curl_setopt($this->ch, CURLOPT_URL, $this->login_url);
			
		}
		
		
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, $cookie_file);
		curl_setopt($this->ch, CURLOPT_COOKIEFILE, $cookie_file);
		curl_setopt($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.9.2.13) Gecko/20101206 Ubuntu/10.10 (maverick) Firefox/3.6.13');
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_HEADER, 0);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		
		$page = curl_exec($this->ch);
		
		
		if (file_exists($cookie_file) && filesize($cookie_file) > 0) {
			return trim($page);
		}
		
		
		
		// try to find the actual login form
		if (!preg_match('/<form method="POST" .*?<\/form>/is', $page, $form)) {
			
			//unlink("amazoncookie.txt");
			//goUrl("");
			
		}
		
		$form = $form[0];
		
		// find the action of the login form
		if (!preg_match('/action="([^"]+)"/i', $form, $action)) {
			die('Failed to find login form url');
		}
		
		$url2 = "https://sellercentral.amazon.com/ap/widget"; // this is our new post url
		
		// find all hidden fields which we need to send with our login, this includes security tokens 
		$count = preg_match_all('/<input type="hidden"\s*name="([^"]*)"\s*value="([^"]*)"/i', $form, $hiddenFields);
		
		$postFields = array();
		
		// turn the hidden fields into an array
		for ($i = 0; $i < $count; ++$i) {
			$postFields[$hiddenFields[1][$i]] = $hiddenFields[2][$i];
		}
		
		// add our login values
		
		$postFields['email']    = $this->email;
		$postFields['create']   = 0;
		$postFields['password'] = $this->password;
		
		$post = '';
		
		// convert to string, this won't work as an array, form will not accept multipart/form-data, only application/x-www-form-urlencoded
		foreach ($postFields as $key => $value) {
			$post .= $key . '=' . urlencode($value) . '&';
		}
		
		$post = substr($post, 0, -1);
		
		// set additional curl options using our previous options
		curl_setopt($this->ch, CURLOPT_URL, $url2);
		curl_setopt($this->ch, CURLOPT_REFERER, $this->login_url);
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
		$page = curl_exec($this->ch);
		
		curl_setopt($this->ch, CURLOPT_URL, $scrap_url);
		curl_setopt($this->ch, CURLOPT_REFERER, $url2);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		$page = curl_exec($this->ch);
		
	    return trim($page);
	}
	public function feedFeedbacks($scrap_url)	{
		
		
		
		
		$page	=	$this->amazoneMWS($scrap_url);
		
		
	
		
	
		$html  	= 	str_get_html($page);
		
		$table 	= 	$html->find('table', 4);
		$html  	= 	str_get_html($table);
		$j 		= 	1;
		
		foreach ($html->find('table tbody tr') as $i => $tr) {
			$thtml = str_get_html($tr);        
			if ($i > 1) {
				$ch = 0;
				foreach ($thtml->find('td') as $k => $td) {
					if ($ch == 0) {
						
						
						
						
						$date = $td->plaintext;
					

					}
					if ($ch == 1) {
						
						$rating = str_replace('&nbsp;', '', $td->plaintext);
						
						
					
						
						
					}
					if ($ch == 2) {
						
						$collection = $td->find('a');
						
						
						foreach($td->find('a') as $element) {
                     		$url =    $element->href;
						}
						
						$is_response		=	0;
						$comments = $td->plaintext;
						if(strpos($comments, "Remove Response") == true || strpos($comments, "Response Removed") == true)	{
							$is_response		=	1;
						}
						
						
						$comments = mysql_real_escape_string($comments);
						
					
					}
					
					if ($ch == 3) {
						
						$arrived_time = $td->plaintext;
						
					
						
					}
					
					
					if ($ch == 4) {
						
						$item_described = $td->plaintext;
					
					}
					if ($ch == 5) {
						
						$customer_service = $td->plaintext;
						
						
					}
					if ($ch == 6) {
						$order_id = $td->plaintext;
						
						
					}
					if ($ch == 7) {
						$rater_email = $td->plaintext;
						
					
						
					}
					if ($ch == 8) {
						$rater_role = $td->plaintext;
						
					}
					
				
					
					$ch++;
				}
				
				
				//if ($rating >= '4') {
			mysql_query("INSERT INTO feedbacks ( date, rating, arrived_time, item_described, customer_service, order_id, rater_email, rater_role, comments,response_url,is_responed,user_id) VALUES ('$date', '$rating', '$arrived_time', '$item_described', '$customer_service','$order_id','$rater_email', '$rater_role', '$comments', '$url','$is_response','".$_SESSION['user_id']."')");
			
				
				//}
				
				
			}
			$j++;
		}
		
	}
	public function response($response_url,$response_string)	{
		$msg		=	"";
		
		//echo $response_url."===".$response_string;
		return;
		
		$page		=	$this->amazoneMWS($response_url);
	
		
		//FIDN THE RESPONSE FORM
		if (!preg_match('/<form action.*?<\/form>/is', $page, $form)) {
			$msg	=	 "Unable to load Form";	
		}
		$form = $form[0];
	
		//FIND THE ACTION OF FORM
		if (!preg_match('/action="([^"]+)"/i', $form, $action)) {
			$msg	= 	"Unable to load Form action";
		}
		$action 	= 	$action[1];
	
		//FIND THE HIDDEN FILEDS
		$count = preg_match_all('/<input type="hidden"\s*name="([^"]*)"\s*value="([^"]*)"/i', $form, $hiddenFields);
		
		$postFields = array();
		
		// TURN THE HIDDEN FIELDS INTO ARRAY
		for ($i = 0; $i < $count; ++$i) {
			$postFields[$hiddenFields[1][$i]] = $hiddenFields[2][$i];
		}
		$postFields['comment']    	= $response_string;
		$postFields['submit']   	= "";
		$postFields['ue_back']   	= "1";
		//CREATE STRING TO SUBMIT TO CURL
		$post = '';
		foreach ($postFields as $key => $value) {
			$post .= $key . '=' . urlencode($value) . '&';
		}
		
		$post = substr($post, 0, -1);
		
		
		// set additional curl options using our previous options
		curl_setopt($this->ch, CURLOPT_URL,$action);
		curl_setopt($this->ch, CURLOPT_REFERER, $response_url);
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
		$page = curl_exec($this->ch);
		return $msg;
		
	}
	
	function getSuperUrl($asin,$keyword)	{
		
		$start_string		=    "http://www.amazon.com/dp/";
		$ref_string			=	 "/ref=sr_1_1?id=UTF8&qid=".rand(1000000000,9000000000)."&sr=8-1&keywords=".str_replace(",","+",$keyword);
		return  $start_string.$asin.$ref_string;
	}
	function canonicalUrl($url)	{
		
		$end_pos		=		strpos($url,"/ref");
		return substr($url,0,$end_pos);	
	}
	
	
}
$scrap_url = "https://sellercentral.amazon.com/gp/feedback-manager/view-all-feedback.html/ref=fb_fbmgr_vwallfb?ie=UTF8&dateRange=&descendingOrder=1&sortType=Date";


$amazone_obj		=		new Amazone(AMAZONE_EMAIL, AMAZONE_PASSWORD, AMAZONE_URL);
