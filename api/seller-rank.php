<?php 
require_once('../includes/lib/includes.php'); 
if(isset($_POST)) {
	$where			 =		"";
  	$cmd   	    	 =       mysql_real_escape_string($_POST['cmd']);
	$pro_id   	     =       mysql_real_escape_string($_POST['pro_id']);
	$sr_id   	     =       mysql_real_escape_string($_POST['sr_id']);
	
	if($cmd 		==		"edit")	{
		$where		=		"AND id != $sr_id";
	}
	if($sql_obj->RowCount("seller_rank", "WHERE product_id =  '$pro_id' AND user_id = '".$_SESSION['user_id']."' $where" ) > 0){
		
		echo json_encode(array("flag"=>"1"));
	}else{
		echo json_encode(array("flag"=>"0"));
	}
}

?>