<?php
set_time_limit (180);

require_once('../includes/lib/includes.php');


if($sql_obj->RowCount("rank_tracker_keywords","WHERE is_ranked = '0'") == 0)	{
	$sql_obj->Query("UPDATE rank_tracker_keywords SET is_ranked = 0");
	die();
}
//GETTTING RECORD
$rank_row		=		$sql_obj->QFetchArray("SELECT rt.*,p.asin,rtk.id rtk_id,rtk.keyword  FROM rank_tracker rt, products p, rank_tracker_keywords rtk   
  WHERE rtk.is_ranked = '0' AND p.id = rt.product_id AND rtk.rank_tracker_id = rt.id  ORDER BY date_time LIMIT 1");

$date 			= 		date('Y-m-d H:i:s');
$pa_obj			=		new ProductAdvertising();


$array[1]		=		$pa_obj->getProductRankByKeywordScrap($rank_row['keyword'],1,$rank_row['asin']);
$array[2]		=		$pa_obj->getProductRankByKeywordScrap($rank_row['keyword'],2,$rank_row['asin']);
$array[3]		=		$pa_obj->getProductRankByKeywordScrap($rank_row['keyword'],3,$rank_row['asin']);
$array[4]		=		$pa_obj->getProductRankByKeywordScrap($rank_row['keyword'],4,$rank_row['asin']);
$array[5]		=		$pa_obj->getProductRankByKeywordScrap($rank_row['keyword'],5,$rank_row['asin']);
$array[6]		=		$pa_obj->getProductRankByKeywordScrap($rank_row['keyword'],5,$rank_row['asin']);


$rank			=		0;



for($i = 1; $i <= count($array); $i++)	{
	if($array[$i] != false)	{
		$rank	= $array[$i];
	}
}
echo $rank;
die();
if($rank != 0)	{
	$sql_obj->Query("UPDATE rank_tracker SET rank = '$rank', last_rank_date = '$date',is_ranked = 1 WHERE id = '".$rank_row['id']."'");
	if($rank  != $rank_row['rank'])	{
		$sql_obj->Query("INSERT INTO rank_tracker_detail (rank_tracker_id, date_time, rank) 
					VALUES ('".$rank_row['id']."', '$date', '$rank')");
	}
}


die();
?>