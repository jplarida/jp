<?php

require 'src/facebook.php';  // Include facebook SDK file
if(isset($_GET['code']) || @$_GET['type'] == 'facebook'){
//require 'functions.php';  // Include functions
$facebook = new Facebook(array(
  'appId'  => '397625080395605',   // Facebook App ID 
  'secret' => '7ebc34f2a3f95898573b43c19cf7f4ac',  // Facebook App Secret
  'cookie' => true,	
));
$user = $facebook->getUser();

if ($user) {
  try {
    $user_profile = $facebook->api('/me');
	
  	    $fbid = $user_profile['id'];
		                 // To Get Facebook ID
 	    $fbuname = $user_profile['username'];  // To Get Facebook Username
 	    $fbfullname = $user_profile['name']; // To Get Facebook full name
	    $femail = $user_profile['email'];    // To Get Facebook email ID
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;           
	    $_SESSION['USERNAME'] = $fbuname;
            $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
		
		if($sql_obj->RowCount("users","WHERE email = '$femail'") == '0'){
		
		$sql_obj->Query("insert into users(name,email,fb_id,image,login_type)values('$fbfullname','$femail','$fbid','no-image.jpg','1')");
		
		 $_SESSION['user_id'] =  $sql_obj->InsertID();
		}else{
		$sql_obj->Query("update users set name='$fbfullname',email='$femail',fb_id='$fbid',image='no-image.jpg' where email = '$femail'");
		$user_row	=	$sql_obj->QFetchArray("SELECT id FROM users WHERE email = '$femail' ");
		$_SESSION['user_id'] =  $user_row['id'];
  }
    //       checkuser($fbid,$fbuname,$fbfullname,$femail);    // To update local DB
  } catch (FacebookApiException $e) {
    error_log($e);
   $user = null;
  }
}
if ($user) {
	header("Location: http://dixeam.com/amazone/products.php");
} else {
 $loginUrl = $facebook->getLoginUrl(array(
		'scope'		=> 'email', // Permissions to request from the user
		));
 header("Location: ".$loginUrl);
}
}
?>
