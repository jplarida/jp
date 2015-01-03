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

$base	=	"http://www.amazon.com/product-reviews/".$sr_row['asin'];

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
//unlink("amazoncookie.txt");

//IDS 1- productReviews 2- cm_cr-review_list


if (strpos($html_base,'productReviews') !== false) {
	$j	=	3;
	for($i = 3; $i < 37; $i++)	{
		$obj	=	$html_base->find("#productReviews", 0)->children(0)->children(0)->children($j);
		
		if ( is_object($obj) && method_exists($obj, 'children') ){
			if(trim($obj->children(1)->plaintext) != "")
			
				echo $obj->children(1)->plaintext. "<br/>";
				$str1		=	ltrim($obj->children(1)->plaintext);
				$str2		=	ltrim($obj->children(2)->plaintext);
				//echo $str1[0]. "<br/>";
	}
	$j =	$i + 4;
}
}else	{
	for($i = 1; $i <= 10; $i++)	{
		$obj	=	$html_base->find("#cm_cr-review_list", 0)->children($i);
		if ( is_object($obj) && method_exists($obj, 'children') ){
			if(trim($obj->children(1)->plaintext) != "")	{
				$str1		=	$obj->children(1)->plaintext;
				$str2		=	$obj->children(2)->plaintext;
				$rating		=	substr($str1, 1);
				echo $rating. "<br/>";
			}
		}
	}
}

$html_base->clear(); 
unset($html_base);
die();


?>

