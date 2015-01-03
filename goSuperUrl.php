<?php
require_once('includes/lib/includes.php'); 

if(isset($_GET['cmd']) && $_GET['cmd'] == "superUrl")	{
	
	//GET THE SUPER URL
	$su_row		=	$sql_obj->QFetchArray("SELECT su.*,p.* FROM products p, super_url su WHERE p.id = su.product_id AND su.id = '".$_GET['id']."'");
	
	//GET THE KEYWORD
	$key_row		=	$sql_obj->QFetchArray("SELECT * FROM super_url_detail sud WHERE sud.super_url_id  = '".$_GET['id']."' ORDER BY RAND() LIMIT 1");
	
	$tag			=	"";
	if($su_row['associative_tag'] != "")	{
		$tag			=	"&tag=".$su_row['associative_tag'];
	}
	$mrid			=	"";
	if($su_row['marchent_id'] != "")	{
		$mrid			=	"&m=".$su_row['marchent_id'];
	}
	
	$url			=		$su_row['product_url']."/".$su_row['asin']."/ref=sr_1_12?ie=UTF8&qid=".rand(1000000000,9000000000)."&sr=8-12&keywords=".$key_row['keyword'].$mrid.$tag;

	
	$sql_obj->Query("UPDATE super_url_detail set clicks = clicks+1 WHERE id = '".$key_row['id']."'");
	goUrl($url);
	die();
}
?>