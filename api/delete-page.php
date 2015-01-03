<?php require_once('../includes/lib/includes.php'); 





if (isset($_POST['val'])){
	
	mysql_query("DELETE from pages  WHERE id = '".$_POST['val']."'");
	
		$query=mysql_query("select data from pages where  id = '".$_POST['val']."' ");
		$query2 			=  mysql_fetch_array($query );
	
	
		unlink("../pages/".$query2['data']);

}


?>
