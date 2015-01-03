<?php 
//GLOBAL SETTING
require_once('../includes.php'); 
$sql_obj->Query("DELETE FROM feedbacks");
$amazone_obj->feedFeedbacks($scrap_url);

?>