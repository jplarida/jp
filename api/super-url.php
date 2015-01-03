<?php 
require_once('../includes/lib/includes.php'); 
if(isset($_POST)) {
	$where			 =		"";
  	$cmd   	    	 =       mysql_real_escape_string($_POST['cmd']);
	$pro_id   	     =       mysql_real_escape_string($_POST['pro_id']);
	$su_id   	     =       mysql_real_escape_string($_POST['su_id']);
	
	if($cmd 		==		"edit")	{
		$where		=		"AND id != $su_id";
	}
	if($sql_obj->RowCount("super_url", "WHERE product_id =  '$pro_id' AND user_id = $su_id $where" ) > 0){
		
		echo json_encode(array("flag"=>"1"));
	}else{
		echo json_encode(array("flag"=>"0"));
	}
}

?>