<?php
set_time_limit (180);

require_once('../includes/lib/includes.php');

if($sql_obj->RowCount("rank_tracker_keywords","WHERE is_ranked = '0'") == 0)	{
	$sql_obj->Query("UPDATE rank_tracker_keywords SET is_ranked = 0");
	echo "Update Toble to 0";
	die();
}
//GETTTING RECORD
$rank_row		=		$sql_obj->QFetchArray("SELECT rt.*,p.asin,rtk.id rtk_id,rtk.keyword  FROM rank_tracker rt, products p, rank_tracker_keywords rtk   
  WHERE rtk.is_ranked = '0' AND p.id = rt.product_id AND rtk.rank_tracker_id = rt.id  
  ORDER BY date_time LIMIT 1");

$date 			= 		date('Y-m-d');
//$date 			= 		date('Y-m-d', strtotime('-1 day', strtotime($date)));
//die($date);
$pa_obj			=		new ProductAdvertising();



$rank		=		$pa_obj->getProductRankByKeyword(str_replace('+', ' ', $rank_row['keyword']),$rank_row['asin']);


echo "Keyword ID: ".$rank_row['rtk_id']."<br/>ASIN: ".$rank_row['asin']."<br/>Keyword ".$rank_row['keyword']."<br/>Rank ".$rank;


//UPDAT THE TABLES
$sql_obj->Query("UPDATE rank_tracker_keywords SET is_ranked = 1 WHERE id = '".$rank_row['rtk_id']."'") or die(mysql_error());
if($rank != 0)	{
	
	//Query
	$sql_obj->Query("INSERT INTO rank_tracker_detail (rank_tracker_id, date_time, rank, keyword_id) VALUES ('".$rank_row['id']."', '$date', '$rank', '".$rank_row['rtk_id']."')") or die(mysql_error());

}



?>