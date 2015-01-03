<?php 
require_once('../includes/lib/includes.php'); 
if(isset($_POST)) {
	$table		=		$_POST['table'];
	$id			=		$_POST['id'];
	$sql_obj->Query("DELETE FROM $table WHERE id = '$id'");
	if($table == "products")	{
		$sql_obj->Query("DELETE FROM super_url WHERE product_id = '$id'");
		$sql_obj->Query("DELETE FROM seller_rank WHERE product_id = '$id'");
		$sql_obj->Query("DELETE FROM rank_tracker WHERE product_id = '$id'");
		$sql_obj->Query("DELETE FROM canonical_url WHERE product_id = '$id'");
	}
}

?>