<?php 
require_once('../includes/lib/includes.php'); 
if(isset($_POST)) {
	$where			 =		"";
  	$name   	     =       mysql_real_escape_string($_POST['name']);
	$asin   	     =       mysql_real_escape_string($_POST['pasin']);
	$pro_id   	     =       mysql_real_escape_string($_POST['pro_id']);
	if($pro_id 		!=		0)	{
		$where		=		"AND id != $pro_id";
	}

	
	if($sql_obj->RowCount("products", "WHERE asin =  '$asin' AND user_id = '".$_SESSION['user_id']."' $where" ) > 0){
		echo json_encode(array("flag"=>"1"));
	}else{
		echo json_encode(array("flag"=>"0"));
	}
}

?>