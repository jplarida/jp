<?php

function generateHash($password) {
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
 }
}
function ishaveProduct($user_id)	{
	global $sql_obj;
	return $sql_obj->RowCount("products","WHERE user_id = '$user_id'");
	
}
function isSettings($user_id){
	
		 $sql = mysql_query("select * from setting WHERE amazone_email IS NULL OR amazone_email = '' and amazone_password IS NULL OR amazone_password = '' and user_id = '$user_id'");
	 
	 $result = mysql_num_rows($sql);
	
	 if($result > 0){		 
		 return 0;
	 } else {
		 
		 return 1;
		 }
	
	
	}
function ImageUplloadResize($image ,$width ,$hight,$path) {

	$upload   = new Upload();
	$upload->UploadFile($image,$path,'1');
	$image_path  =   $upload -> file['server_file_name'];
	@$ext = strtolower(end(explode('.', $_FILES[$image]['name'])));
    $image    =  new SimpleImage();
    $image->load($path . '/'.$image_path);
    $image->resize($width,$hight);
    $thum_name   =  $path."/thumb_". $image_path;
    $image->save($thum_name);
    chmod($path. "/thumb_". $image_path.'.'.$ext, 777);
 	return $image_path; 
}

function verify($password, $hashedPassword) {
    return crypt($password, $hashedPassword) == $hashedPassword;
}


function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

function goUrl($path)	{
	echo'<script type="text/javascript">window.location.href ='."'".$path."'".'</script>';
	die();
}

//.......................................FUNCTION Check Follow................................................//
function isFollowed($follow_id)	{
	 
	 $sql = mysql_query("select * from followers WHERE following_id= '$follow_id' and follower_id= '".$_SESSION['user']['user']['id']."'");
	 
	 $result = mysql_num_rows($sql);
	
	 if($result > 0){
		 
		 return 1;
	 } else {
		 
		 return 0;
		 }
 }
 
 function isLike($post_id)	{
	 
	 $sql = mysql_query("select * from likes WHERE post_id= '$post_id' and user_id= '".$_SESSION['user']['user']['id']."'");
	 
	 $result = mysql_num_rows($sql);
	
	 if($result > 0){
		 
		 return 1;
	 } else {
		 
		 return 0;
		 }
 }
 
 function GetFollowingImage($following_id){
		$data= mysql_query("SELECT image from users WHERE id = $following_id");
	  
         $getdata = mysql_fetch_array($data);
		 
		 return $getdata['image'];		  
}

 function GetUserName($user_id){
		$data= mysql_query("SELECT name from users WHERE id = $user_id");
	  
         $getdata = mysql_fetch_array($data);
		 
		 return $getdata['name'];		  
}

 function getUser($user_id){
		$data		= 	mysql_query("SELECT * from users WHERE id = '$user_id'");
        return  mysql_fetch_array($data);  
}

 function GetLikeImage($post_id){
		$data= mysql_query("SELECT image from posts WHERE id = $post_id ");
	  
         $getdata = mysql_fetch_array($data);
		 
		 return $getdata['image'];		  
}

 function GetLikeUrl($post_id){
		$data= mysql_query("SELECT p.url from posts p,likes l WHERE p.id = $post_id ");
	  
         $getdata = mysql_fetch_array($data);
		 
		 return $getdata['url'];		  
}

function ago($timestamp){
    //type cast, current time, difference in timestamps
    $timestamp      = (int) $timestamp;
    $current_time   = time();
    $diff           = $current_time - $timestamp;
    
    //intervals in seconds
    $intervals      = array (
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
    );
    
    //now we just find the difference
    if ($diff == 0)
    {
        return 'just now';
    }    

    if ($diff < 60)
    {
        return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
    }        

    if ($diff >= 60 && $diff < $intervals['hour'])
    {
        $diff = floor($diff/$intervals['minute']);
        return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
    }        

    if ($diff >= $intervals['hour'] && $diff < $intervals['day'])
    {
        $diff = floor($diff/$intervals['hour']);
        return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
    }    

    if ($diff >= $intervals['day'] && $diff < $intervals['week'])
    {
        $diff = floor($diff/$intervals['day']);
        return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
    }    

    if ($diff >= $intervals['week'] && $diff < $intervals['month'])
    {
        $diff = floor($diff/$intervals['week']);
        return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
    }    

    if ($diff >= $intervals['month'] && $diff < $intervals['year'])
    {
        $diff = floor($diff/$intervals['month']);
        return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
    }    

    if ($diff >= $intervals['year'])
    {
        $diff = floor($diff/$intervals['year']);
        return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
    }
}
function getUserImageUrl($image_url, $login_type)	{
	if($login_type == "0")	{
		return SITE_URL."images/user-images/".$image_url;
	}else {
		return $image_url;
	}
}
function getProductASIN($id)	{
	global $sql_obj;
	$pro_row		=		$sql_obj->QFetchArray("SELECT asin FROM products WHERE id = '$id'");
	return  $pro_row['asin'];
}
function getProductName($id)	{
	global $sql_obj;
	$pro_row		=		$sql_obj->QFetchArray("SELECT name FROM products WHERE id = '$id'");
	return  $pro_row['name'];
}
function sessionCheck()	{
	$pages		=	 array(
							"feedbacks",
							"super-url",
							"products",
							"rank-tracker",
							"seller-rank",
							"profile-setting",
							"setting",
							"canonical-url"
							
						);
	$page				=	 	basename($_SERVER['PHP_SELF']);	
	
	for($i = 0; $i < count($pages); $i++)	{
		if($pages[$i].".php" == $page && !isset($_SESSION['user_id']))	{
			goUrl("index.php");
		}
	}
}
sessionCheck();
function getUserSetting()	{
	
	global	$sql_obj;
	$setting	=	$sql_obj->QFetchArray("SELECT st.*,s.* FROM servers s, users u, setting st WHERE u.id = '".$_SESSION['user_id']."' AND s.id = st.amazone_server");
	return $setting;
}
if(isset($_SESSION['user_id']))	{
	$user_global				=	getUserSetting();
}
function googleUrlShort($longUrl)	{

	// Get API key from : http://code.google.com/apis/console/
	$apiKey = 'AIzaSyDgRdNrKGH-ltrq9gYhMRcK0tsnrzNi5ss';
	
	$postData = array('longUrl' => $longUrl, 'key' => $apiKey);
	$jsonData = json_encode($postData);
	
	$curlObj = curl_init();
	
	curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
	curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curlObj, CURLOPT_HEADER, 0);
	curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
	curl_setopt($curlObj, CURLOPT_POST, 1);
	curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
	
	$response = curl_exec($curlObj);
	
	// Change the response json string to object
	$json = json_decode($response);
	
	curl_close($curlObj);
	
	
	return $json->id;
}
function getHigestRank($keyword_id)	{
	
	global $sql_obj;
	$row		=	$sql_obj->QFetchArray("SELECT rank FROM rank_tracker_detail rtd WHERE rtd.keyword_id = '$keyword_id' ORDER BY rtd.rank ASC LIMIT 1");
	if(is_array($row))	{
		return $row['rank'];
	}else {
		return 0;
	}
}
function getCurrentRank($keyword_id)	{
	
	global $sql_obj;
	$row		=	$sql_obj->QFetchArray("SELECT rtd.rank FROM rank_tracker_detail rtd WHERE rtd.keyword_id = '$keyword_id' ORDER BY rtd.date_time DESC LIMIT 1");
	if(is_array($row))	{
		return $row['rank'];
	}else {
		return 0;
	}
}
function getLastUpdateDate($keyword_id)	{
	global $sql_obj;
	$row		=	$sql_obj->QFetchArray("SELECT date_time FROM rank_tracker_detail rtd WHERE rtd.keyword_id = '$keyword_id' ORDER BY rtd.date_time DESC");
	if(is_array($row))	{
		return $row['date_time'];
	}
}
 function getSuperUrlKeyword($id)	{
	global $sql_obj;
	
	$key_row		=	$sql_obj->QFetchRowArray("SELECT * FROM super_url_detail WHERE super_url_id = '$id'");
	$string		=	"";
	$i			=	0;
	if(is_array($key_row))	{
		foreach($key_row as $key=>$row)	{
			if($i	==	0)	{
				$com	=	"";
			}else {
				$com	=	",";
			}
			$string	.=	$com.$row['keyword'];
			$i++;
			
		}
	}
	return $string;
   
}
function getRankTrackerKeyword($id)	{
	global $sql_obj;
	
	$key_row		=	$sql_obj->QFetchRowArray("SELECT * FROM rank_tracker_keywords WHERE rank_tracker_id = '$id'");
	$string		=	"";
	$i			=	0;
	if(is_array($key_row))	{
		foreach($key_row as $key=>$row)	{
			if($i	==	0)	{
				$com	=	"";
			}else {
				$com	=	",";
			}
			$string	.=	$com.(str_replace("+"," ",$row['keyword']));
			$i++;
			
		}
	}
	return $string;
   
}
function removeRTKeyword($key_array,$id)	{
	global $sql_obj;
	$rt_row	=	$sql_obj->QFetchRowArray("SELECT * FROM rank_tracker_keywords WHERE rank_tracker_id = '$id'");
	
	
	if(is_array($rt_row))	{
		foreach($rt_row as $key=>$row)		{
			if(!in_array($row['keyword'], $key_array))	{
				//echo "not exist ".$row['keyword']."<br/>";
				$sql_obj->Query("DELETE FROM rank_tracker_keywords WHERE id = '".$row['id']."'");
			}
		}
	}
}
function removeSUKeyword($key_array,$id)	{
	global $sql_obj;
	$rt_row	=	$sql_obj->QFetchRowArray("SELECT * FROM super_url_detail WHERE super_url_id = '$id'");
	
	
	if(is_array($rt_row))	{
		foreach($rt_row as $key=>$row)		{
			if(!in_array($row['keyword'], $key_array))	{
				//echo "not exist ".$row['keyword']."<br/>";
				$sql_obj->Query("DELETE FROM super_url_detail WHERE id = '".$row['id']."'");
			}
		}
	}
}
function CSVOutput($head,$values,$file_name)	{
	//DATA LIKE
/*	$head	=	array('heading1', 'heading2', 'heading3', 'heading4');
	$data 	= 	array(array('Column 1', 'Column 2', 'Column 3', 'Column 4'),
				array('Column 11', 'Column 22', 'Column 31', 'Column 41'),
				array('Column 12', 'Column 22', 'Column 32', 'Column 42'));*/
	
	
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename='.$file_name.'.csv');
		
	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');
	
	// output the column headings
	///$output = str_replace("\n", "", $output);
	fputcsv($output, $head);
	foreach($values as &$val)	{
		fputcsv($output, $val);
	}
}
?>

