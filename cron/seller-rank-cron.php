<?php

set_time_limit (180);
set_include_path('/home/dixeam/public_html/amazone/includes/lib/');

require_once('includes.php');

//////////////insert data in cron_dails to show on admin sit//////////////
$sql_obj->Query("INSERT INTO `cron_details` ( `cron_type`, `message`, `date_time`) VALUES ( '2', '', CURRENT_TIMESTAMP)");
	 
//UPDATE RECORD
if($sql_obj->RowCount("seller_rank","WHERE is_rank = '0'") == 0)	{
	$sql_obj->Query("UPDATE seller_rank SET is_rank = 0");
	echo "Seller Rank Table Update to 0";
	die();
}


$sr_row		=		$sql_obj->QFetchRowArray("SELECT sr.*,p.asin FROM seller_rank sr, products p WHERE sr.is_rank = '0' AND p.id = sr.product_id LIMIT 5");



$date 			= 		date('Y-m-d');
if(is_array($sr_row))	{
	foreach($sr_row as $key=>$row)	{
		$am_credentils		=		setAmazoneCredentils($row['user_id']);
		$pa_obj				=		new ProductAdvertising($am_credentils);
		$seller_rank		=		$pa_obj->getSaleRank($row['asin']);
		
		
		if($sql_obj->RowCount("seller_rank_detail",
		"WHERE date_time = '$date' AND seller_rank_id = '".$row['id']."'") > 0)	{
			
			$sql_obj->Query("UPDATE seller_rank_detail SET
							seller_rank	=	'$seller_rank' WHERE
							seller_rank_id = '".$row['id']."' AND date_time = 
							'$date'");
		}else {
			$sql_obj->Query("INSERT INTO seller_rank_detail 
						(seller_rank_id, date_time, seller_rank) VALUES 
						('".$row['id']."', '$date', '$seller_rank')");
				
		}
		$sql_obj->Query("UPDATE seller_rank SET is_rank	=	'1' WHERE id = '".$row['id']."'");
		echo "ASIN: ".$row['asin']."<br/>"."Seller Rank: ".$seller_rank."<br>------<br/>";
	
	}
	
}
die();
?>