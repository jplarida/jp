<?php
class UserCategory	{
	private $sql_obj;
	function __construct($sql_obj)	{
		$this->sql_obj		=	$sql_obj;
	}
	function addUserCat($value)	{
		$security_obj		=	new Security('user_id');
		$this->sql_obj->Query("INSERT INTO  user_categories (name ,user_id)VALUES ('$value',  '".$security_obj->getSessionValue()."')");
		return $this->sql_obj->InsertID();
	}
	function getCatlist($user_id)	{
		
		$cat_row		=		$this->sql_obj->QFetchRowArray("SELECT id, name FROM user_categories WHERE user_id = '".$user_id."'");
		if(is_array($cat_row))	{
			foreach($cat_row as $key=>$row)	{
				echo '<li onClick="seleectCat('."'".$row['name']."',"."'".$row['id']."'".')" id="'.$row['id'].'">'.$row['name'].'</li>';
			}
		}
	}
}
?>