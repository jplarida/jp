<?php
class User	{
	private $sql_obj;
	//.........................................FOR REGISTRATION.................................//
	function __construct($sql_obj)	{
		$this->sql_obj	=	$sql_obj;
	}
	function isUsernameExist($username)	{
		$flag	=	($this->sql_obj->RowCount("users","WHERE username = '$username'") > 0)?  '1': '0';
		return $flag;
	}
	function register($data)	{
		$this->sql_obj->Query("INSERT INTO users (username, fullname, email, password,sex,reg_time,last_login) VALUES ( '".$data['username']."', '".$data['firstname']."', '".$data['email']."', '".$data['password']."','".$data['sex']."',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)");
		$last_id	=	$this->sql_obj->InsertID();
		$securty	=	new Security("user_id");
		$securty->setSession($last_id);
	}
	
	//.........................................FOR LOGIN.................................//
	function login($username,$password)	{
		$user_row					= $this->sql_obj->QFetchArray("SELECT id FROM users WHERE username = '$username' AND password = '$password'");	
		if(is_array($user_row))	{
			$securty	=	new Security("user_id");
			$securty->setSession($user_row['id']);
			return '1';
		}else {
			return '0';
		}
	}
	//....................................FOR LOGOUT....................................//
	function logout($cmd)	{
		if($cmd	==	"logout")	{
			$securty	=	new Security("user_id");
			$securty->unsetSession();
		}
	}
	function getUserInfo($col_list,$user_id)	{
		return	$this->sql_obj->QFetchArray("SELECT $col_list FROM users WHERE id = '$user_id'");
	}
	function getHeaderUserImage($user_id)	{
		$user_row	=	$this->getUserInfo("login_type,social_network_image,profile_image",$user_id);
		switch($user_row['login_type'])	{
			case "facebook":
				return $user_row['social_network_image'];
			default:
				return USER_IMAGES."no-user-25.jpg";
		}
	}
	function getProfileNav()	{
		$securty	=	new Security("user_id");
		if($securty->isSession() == false)	{
			return '<a href="javascript:void(0)">
        <li id="register-dropdown-container"><p class="user-info">
			  <div class="register-dropdown" id="register-dropdown">
			  <div class="black_button" onClick="loadPage(\'login\')" style="margin-bottom:10px;">Login</div>
			  <div class="login-button black_button" onClick="loadPage(\'signUp\')">Sign Up</div>
			  </div>
			  </p></li></a>';
		}else {
			$upload_chip	=	'<li id="register-dropdown-container2"> <a href="javascript:void(0)" >
  <p class="notifications">+</p>
  </a>
  <div class="register-dropdown" id="register-dropdown2" style="display: none; margin-right:80px;"><a href="javascript:void(0)"> <a href="javascript:void(0)" onClick="loadPage(\'from-web\')">
    <div class="black_button"  style="margin-bottom:10px;">Upload Chip from Web</div>
    </a> <a href="uploadpic.html">
    <div class="login-button black_button">Upload Chip from PC</div>
    </a> </div>
  <p></p>
</li>';
			$user_pic		=	'<a href="javascript:void(0)">
<li>
  <p class="user-image"><img src="'.$this->getHeaderUserImage($securty->getSessionValue()).'" width="25" height="25"></p>
</li>
</a> ';
			$add_button	=	'<a href="javascript:void(0)" onClick="loadPage(\'add\')"><li><p class="notifications">+</p></li></a>';
			$user_row	=	$this->getUserInfo("fullname",$securty->getSessionValue());
			
			return $upload_chip.$user_pic  .'<li id="register-dropdown-container"><a href="javascript:void(0)">
  <p class="user-info"> </p>
  </a>
  <div class="register-dropdown" id="register-dropdown" style="display: none;"><a href="javascript:void(0)">
    <div class="black_button" onclick="loadPage(\'login\')" style="margin-bottom:10px;">Hello! '.$user_row['fullname'].'</div>
    </a><a href="?cmd=logout">
    <div class="login-button black_button">Logout</div>
    </a> </div>
  <p></p>
</li>';
		}
	}
	/*
	/
	/...................GET THE USER WISHLIST
	/
	*/
	function showWhishList($user_id)	{
		$whishlist_row	=	$this->sql_obj->QFetchRowArray("SELECT id, name FROM user_categories WHERE user_id = '".$user_id."'");
		if(isset($whishlist_row))	{
			foreach($whishlist_row as $key=>$row)	{
				echo '<li><a href="#"> '.$row['name'].' </a> </li>';
			}
		}
	}
	
}
?>





