<?php
//Amazon WebServices Credentials
//AWS CREDENTIALS
define('APPLICATION_VERSION', '1');
define('APPLICATION_NAME', 'sellertool');
define('DATE_FORMAT', 'Y-m-d\TH:i:s\Z');

function setAmazoneCredentils($user_id = NULL)	{
	if($user_id == NULL)	{
		return false;
	}
	$amazone_array		=		array();
	global $sql_obj;

	$user_row			=		$sql_obj->QFetchArray("SELECT st.*,sv.country_postfix FROM setting st, servers sv WHERE st.user_id = '$user_id' AND st.amazone_server = sv.id LIMIT 1");
	
	$amazone_array['AWS_API_KEY']			=	$user_row['aws_access_key'];
	$amazone_array['AWS_API_SECRET_KEY']	=	$user_row['aws_secret_key'];
	$amazone_array['AWS_ASSOCIATE_TAG']		=	$user_row['aws_associative_tag'];
	$amazone_array['COUNTRY']				=	$user_row['country_postfix'];
	$amazone_array['MERCHANT_ID']			=	$user_row['marketplace_seller_id'];
	return $amazone_array;	
}

require_once('amazone/Amazon-ECS-PHP-Library-master/ecs_json/main.php');






