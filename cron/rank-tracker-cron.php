<?php
set_time_limit (180);

set_include_path('/home/dixeam/public_html/amazone/includes/lib/');
require_once('includes.php'); 
//////////////insert data in cron_dails to show on admin sit//////////////
	$sql_obj->Query("INSERT INTO `cron_details` ( `cron_type`, `message`, `date_time`) VALUES ( '1', '', CURRENT_TIMESTAMP)");

if($sql_obj->RowCount("rank_tracker_keywords","WHERE is_ranked = '0'") == 0)	{
	$sql_obj->Query("UPDATE rank_tracker_keywords SET is_ranked = 0");
	echo "Update Toble to 0";
	die();
}
//GETTTING RECORD
$rank_row		=		$sql_obj->QFetchArray("SELECT rt.*,p.asin,rtk.id rtk_id,rtk.keyword  FROM rank_tracker rt, products p, rank_tracker_keywords rtk   
  WHERE rtk.is_ranked = '0' AND p.id = rt.product_id AND rtk.rank_tracker_id = rt.id  
  ORDER BY date_time LIMIT 1");

$date 				= 		date('Y-m-d');
$am_credentils		=		setAmazoneCredentils($rank_row['user_id']);
$pa_obj				=		new ProductAdvertising($am_credentils);
$rank				=		$pa_obj->getProductRankByKeyword(str_replace('+', ' ', $rank_row['keyword']),$rank_row['asin']);



$sql_obj->Query("UPDATE rank_tracker_keywords SET is_ranked = 1 WHERE id = '".$rank_row['rtk_id']."'") or die(mysql_error());





if($rank != 0)	{	
	//Query
	if($sql_obj->RowCount("rank_tracker_detail",
		"WHERE keyword_id = '".$rank_row['rtk_id']."' 
		AND date_time = '$date' 
		AND rank_tracker_id = '".$rank_row['id']."'" )> 0)	{
		//UPDATE QUERY
		$sql_obj->Query("UPDATE rank_tracker_detail SET rank = '$rank' WHERE 
		keyword_id = '".$rank_row['rtk_id']."' 
		AND date_time = '$date' 
		AND rank_tracker_id = '".$rank_row['id']."' ") or die(mysql_error());
		
		echo "UPDATE Keyword ID: ".$rank_row['rtk_id']."<br/>ASIN: ".$rank_row['asin']."<br/>Keyword ".$rank_row['keyword']."<br/>Rank ".$rank;
		
	}else {
		//INSERT QUERY
		$sql_obj->Query("INSERT INTO rank_tracker_detail (rank_tracker_id, date_time, rank, keyword_id) VALUES ('".$rank_row['id']."', '$date', '$rank', '".$rank_row['rtk_id']."')") or die(mysql_error());
		
		echo "INSERT Keyword ID: ".$rank_row['rtk_id']."<br/>ASIN: ".$rank_row['asin']."<br/>Keyword ".$rank_row['keyword']."<br/>Rank ".$rank;
	}

}else {
	echo "UPDATE Keyword ID: ".$rank_row['rtk_id']."<br/>ASIN: ".$rank_row['asin']."<br/>Keyword ".$rank_row['keyword']."<br/>Rank ".$rank;
}



?>