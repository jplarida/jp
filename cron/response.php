<?php 
//GLOBAL SETTING

require_once('../includes.php'); 

//GET FEEDBACK SETTING
$fb_setting		=	$sql_obj->QFetchArray("SELECT * FROM respond_settings LIMIT 1");

//GET THE FEEDBACK URL 
$fb_row			=	$sql_obj->QFetchArray("SELECT * FROM feedbacks WHERE is_responed = 0 LIMIT 1");

function updateRecord($id)	{
	global $sql_obj;
	$sql_obj->Query("UPDATE feedbacks SET is_responed = 1 WHERE id = '$id'");
}


if($fb_row['rating'] <= 2 && $fb_setting['respond_1_2'] != 0)	{
	
	$amazone_obj->response($fb_row['response_url'],$fb_setting['respond_1_2_message']);
	updateRecord($fb_row['id']);
	die("Response 1 or 2 executed: Current: ". $fb_row['id']);
	
}

if($fb_row['rating'] == 3 && $fb_setting['respond_3'] != 0)	{
	$amazone_obj->response($fb_row['response_url'],$fb_setting['respond_3_message']);
	updateRecord($fb_row['id']);
	die("Response 3 executed: Current: ". $fb_row['id']);
	
}

if($fb_row['rating'] > 3 && $fb_setting['respond_4_5'] != 0)	{
	$amazone_obj->response($fb_row['response_url'],$fb_setting['respond_4_5_message']);
	updateRecord($fb_row['id']);
	die("Response 5 executed: Current: ". $fb_row['id']);
	
}
echo "No one execuate: Current: ". $fb_row['id'];

?>