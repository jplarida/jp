<?php 
require_once('../includes/lib/includes.php'); 
if(isset($_POST)) {
	$val		=		str_replace(" ","+",$_POST['val']);
	$val		=		rtrim(ltrim($val));
	if($sql_obj->RowCount("super_url_detail","WHERE super_url_id='".$_POST['rt_id']."' AND keyword = '".$val."' ") > 0){
	echo json_encode(array("id"=>"0"));
	die();
	}
	
	$sql_obj->Query("INSERT INTO super_url_detail (super_url_id, keyword) VALUES ('".$_POST['rt_id']."', '".$val."')");
	$id		=	$sql_obj->InsertID();
	echo json_encode(array("id"=>$id));
	die();
}

?>