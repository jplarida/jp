<?php
//set_time_limit (180);
//set_include_path('/home/dixeam/public_html/amazone/includes/lib/');
function crawlUrl()	{
}
require_once('../includes/lib/includes.php');
$date 			= 		date('Y-m-d');
$sr_row			=		$sql_obj->QFetchArray("SELECT id,asin,user_id FROM products WHERE is_review = 0 LIMIT 1");

if(!is_array($sr_row))	{
	$sql_obj->Query("UPDATE products SET is_review = 0");
	echo "Update table to 0";
	if(file_exists("amazoncookie.txt"))
		unlink("amazoncookie.txt");
	die();
}

$base	=	"http://www.amazon.com/Spore-PC-Mac/product-reviews/".$sr_row['asin'];


$cookie_file = "amazoncookie.txt";
$curl = curl_init();
curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file);
curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_URL, $base);
curl_setopt($curl, CURLOPT_REFERER, $base);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$str = curl_exec($curl);
curl_close($curl);


// Create a DOM object
$html_base = new simple_html_dom();
// Load HTML from a string
$html_base->load($str);
unlink("amazoncookie.txt");
echo $html_base->plaintext;


$ret = $html_base->find("#histogramTable", 0);

//get all category links
$i 		=	5;

foreach($ret->find('tr') as $element) {
    $customers		=	$element->children(2)->plaintext;
	
	if($sql_obj->RowCount("ratings","WHERE product_id = '".$sr_row['id']."' AND rating = '$i'") > 0)	{
		echo $customers."<br/>Updated";
		$sql_obj->Query("UPDATE ratings SET  customers = '$customers' WHERE product_id = '".$sr_row['id']."' AND rating = '$i'");
	}else {
		$sql_obj->Query("INSERT INTO ratings (product_id, user_id, rating, customers) VALUES ('".$sr_row['id']."', '".$sr_row['user_id']."', '$i', '$customers')");
		echo $customers."<br/>Inserted";
	}
	$i--;

}
$sql_obj->Query("UPDATE products SET is_review = 1 WHERE id = '".$sr_row['id']."'");

$html_base->clear(); 
unset($html_base);
die();


?>