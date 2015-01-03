<?php  require_once('../includes/lib/includes.php'); ?>


<?php


if (isset($_POST)) {
	
	
	
	$date 				=   date('Y-m-d H:i:s');
	

		
$sql_obj->Query("insert into click_details(click_id,date)values('".$_POST['id']."','$date')");

	
	
		
}
?>