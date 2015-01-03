<?php 


//error_reporting(E_ERROR | E_PARSE);
require_once('config.inc.php');				//INCLUDE THE ALL SITE CONFIGARATION
require_once('classes/mysql.php'); 			//INCLUDE THE MY SQL CLASS CONNECTION
require_once('classes/ImageUpload.php'); 	//AUTHENTICATION CLASS
require_once('functions.php');

require_once('classes/Mobile_Detect.php'); 
require_once('classes/url.php'); 
require_once('classes/simple_html_dom.php'); 
require_once('classes/paging.php');


//THIRD PARTY PLUGINS
require_once('thirdparty/thirdparty.config.inc.php'); 


if(isset($_SESSION['user_id']))	{
	$user_setting	=	$sql_obj->QFetchArray("SELECT * FROM  setting where user_id = '".$_SESSION['user_id']."' LIMIT 1");
	require_once('classes/amazone.php'); 
}
require_once('app/metronic.php'); 

//APP INCLUDES
 
if(isset($_GET['cmd']) && $_GET['cmd'] == 'logout')	{
	unset($_SESSION['user_id']);
	goUrl("index.php");


}
$result 		= 	mysql_query("SELECT * FROM site_setting WHERE id = 1");
$site_settings	= 	mysql_fetch_array($result);


require_once('thirdparty/fblogin/fbconfig.php');

?>
