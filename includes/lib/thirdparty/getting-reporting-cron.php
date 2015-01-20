<?php
require_once('../includes.php');
require_once('amazone/MarketplaceWebService/Samples/reporting.php');


$amazone_array['AWS_API_KEY']			=	'AKIAJXZHJ4W775V6BPLQ';
$amazone_array['AWS_API_SECRET_KEY']	=	'y+23fIarxTEzt7MCpHhebL1Uw3Ig3MgMFW/Bj5+e';
$amazone_array['MERCHANT_ID']			=	'A196A8GC0YNHR';
$amazone_array['MAKETPLACE_ID']			=	'ATVPDKIKX0DER';


$report_obj			=		new Reporting($amazone_array);

$report_type		=		array();
$report_type[0]		=		'_GET_FLAT_FILE_PAYMENT_SETTLEMENT_DATA_';
$report_type[1]		=		'_GET_AMAZON_FULFILLED_SHIPMENTS_DATA_';

for($i = 0; $i < count($report_type); $i++ )	{
	$report_req		=	$report_obj->invokeGetReportList($report_type[$i]);
	echo $report_req."<br/>";
	//$sql_obj->Query("INSERT INTO reports 
	//(report_type, report_date, report_id, date_time, report_req_id) 
	//VALUES ('".$report_type[$i]."', '', '', CURRENT_TIMESTAMP, '$report_req')");
}
//invokeGetReportList($service, $request);
//invokeRequestReport($service, $request);
?>