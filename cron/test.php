<?php
set_include_path('/home/dixeam/public_html/amazone/includes/lib/');


require_once('includes.php'); 
set_include_path('/home/dixeam/public_html/amazone/includes/lib/thirdparty/amazone/MarketplaceWebService/');
require_once('Samples/reporting.php');


$amazone_array['AWS_API_KEY']			=	'2342JXZHJ4-----------------';
$amazone_array['AWS_API_SECRET_KEY']	=	'-7867-3fIarxTEzt7MCpH6433333336---------';
$amazone_array['MERCHANT_ID']			=	'323678-6A000----';
$amazone_array['MAKETPLACE_ID']			=	'233534e5-VPDKIK-------';


$report_obj		=		new Reporting($amazone_array);

$report_type	=	array();

//......................................FOR SALE DASHBOARD.................//

//....................FOR UPDATE INVENTORY................................//
$report_type[0]	=	'_GET_MERCHANT_LISTINGS_DATA_';
//....................END OF UPDATE INVENTORY................................//


//....................FOR UPDATE INVENTORY HEALTH................................//
$report_type[1]	=	'_GET_FBA_FULFILLMENT_INVENTORY_HEALTH_DATA_';
//....................END OF UPDATE INVENTORY HEALTH................................//

for($i = 0; $i < count($report_type); $i++ )	{
	$report_req		=	$report_obj->invokeRequestReport($report_type[$i]);
	
	//DELETE THE EXISTING REPORTS
	//$sql_obj->Query("DELETE FROM reports WHERE report_type = '".$report_type[$i]."'");
	
	//INSERTING NEW REPORT
	//$sql_obj->Query("INSERT INTO reports (report_type, report_req_id, submitted_date_time, start_date_time, end_date_time, report_id, date_time, user_id, status) VALUES ('".$report_type[$i]."', '".$report_req['request_id']."', '".$report_req['submited_date_time']."', '".$report_req['start_date_time']."', '".$report_req['end_date_time']."', '', CURRENT_TIMESTAMP, '12', '".$report_req['status']."')");
	
	//DISPLAY THE RESULT
	echo "Report_Requested: ".$report_type[$i]."===="."Requested ID: ".$report_req['request_id']."<br/>";
}
?>
