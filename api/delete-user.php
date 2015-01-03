<?php require_once('../includes/lib/includes.php'); 



 if(isset($_POST['val'])){ 

$data = mysql_query("select id from users WHERE id = '".$_POST['val']."'");

if(mysql_num_rows($data)>0){


if (isset($_POST['val'])){
	mysql_query("DELETE from users  WHERE id = '".$_POST['val']."'");
		

}
}
}

?>
