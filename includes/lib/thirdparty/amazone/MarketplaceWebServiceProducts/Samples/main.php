<?php
class XML2Array {
 
    private static $xml = null;
	private static $encoding = 'UTF-8';
 
    /**
     * Initialize the root XML node [optional]
     * @param $version
     * @param $encoding
     * @param $format_output
     */
    public static function init($version = '1.0', $encoding = 'UTF-8', $format_output = true) {
        self::$xml = new DOMDocument($version, $encoding);
        self::$xml->formatOutput = $format_output;
		self::$encoding = $encoding;
    }
 
    /**
     * Convert an XML to Array
     * @param string $node_name - name of the root node to be converted
     * @param array $arr - aray to be converterd
     * @return DOMDocument
     */
    public static function &createArray($input_xml) {
        $xml = self::getXMLRoot();
		if(is_string($input_xml)) {
			$parsed = $xml->loadXML($input_xml);
			if(!$parsed) {
				throw new Exception('[XML2Array] Error parsing the XML string.');
			}
		} else {
			if(get_class($input_xml) != 'DOMDocument') {
				throw new Exception('[XML2Array] The input XML object should be of type: DOMDocument.');
			}
			$xml = self::$xml = $input_xml;
		}
		$array[$xml->documentElement->tagName] = self::convert($xml->documentElement);
        self::$xml = null;    // clear the xml node in the class for 2nd time use.
        return $array;
    }
 
    /**
     * Convert an Array to XML
     * @param mixed $node - XML as a string or as an object of DOMDocument
     * @return mixed
     */
    private static function &convert($node) {
		$output = array();
 
		switch ($node->nodeType) {
			case XML_CDATA_SECTION_NODE:
				$output['@cdata'] = trim($node->textContent);
				break;
 
			case XML_TEXT_NODE:
				$output = trim($node->textContent);
				break;
 
			case XML_ELEMENT_NODE:
 
				// for each child node, call the covert function recursively
				for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) {
					$child = $node->childNodes->item($i);
					$v = self::convert($child);
					if(isset($child->tagName)) {
						$t = $child->tagName;
 
						// assume more nodes of same kind are coming
						if(!isset($output[$t])) {
							$output[$t] = array();
						}
						$output[$t][] = $v;
					} else {
						//check if it is not an empty text node
						if($v !== '') {
							$output = $v;
						}
					}
				}
 
				if(is_array($output)) {
					// if only one node of its kind, assign it directly instead if array($value);
					foreach ($output as $t => $v) {
						if(is_array($v) && count($v)==1) {
							$output[$t] = $v[0];
						}
					}
					if(empty($output)) {
						//for empty nodes
						$output = '';
					}
				}
 
				// loop through the attributes and collect them
				if($node->attributes->length) {
					$a = array();
					foreach($node->attributes as $attrName => $attrNode) {
						$a[$attrName] = (string) $attrNode->value;
					}
					// if its an leaf node, store the value in @value instead of directly storing it.
					if(!is_array($output)) {
						$output = array('@value' => $output);
					}
					$output['@attributes'] = $a;
				}
				break;
		}
		return $output;
    }
 
    /*
     * Get the root XML node, if there isn't one, create it.
     */
    private static function getXMLRoot(){
        if(empty(self::$xml)) {
            self::init();
        }
        return self::$xml;
    }
}
////////////////////////////////////////////////////////////////////////////////////
require_once('.config.inc.php');
require_once('../../../../includes.php');

$base_url = "https://mws.amazonservices.com/Products/2011-10-01";
$method = "POST";
$host = "mws.amazonservices.com";
$uri = "/Products/2011-10-01";

function amazon_xml($searchTerm) {
	$param = array();
    
$param['AWSAccessKeyId']   = AWS_ACCESS_KEY_ID; 
$param['Action']           = 'GetMyPriceForASIN'; 
$param['SellerId']         = MERCHANT_ID; 
$param['SignatureMethod']  = 'HmacSHA256'; 
$param['SignatureVersion'] = '2'; 
$param['Timestamp']        = gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time());
$param['Version']          = '2011-10-01'; 
$param['MarketplaceId']    = MARKETPLACE_ID; 
//$param['ItemCondition']    = 'new';
$param['ASINList.ASIN.1']  = $searchTerm;
      
		




    // Sort the URL parameters
   foreach ($param as $key => $val) {

    $key = str_replace("%7E", "~", rawurlencode($key));
    $val = str_replace("%7E", "~", rawurlencode($val));

    $url[] = "{$key}={$val}";
}

sort($url);

    // Construct the string to sign
    $arr   = implode('&', $url);

$sign  = 'POST' . "\n";
$sign .= 'mws.amazonservices.com' . "\n";
$sign .= '/Products/2011-10-01' . "\n";
$sign .= $arr;

$signature = hash_hmac("sha256", $sign, AWS_SECRET_ACCESS_KEY, true);
$signature = urlencode(base64_encode($signature));

$link  = "https://mws.amazonservices.com/Products/2011-10-01?";
$link .= $arr . "&Signature=" . $signature;

	/////////////////////////////////////////////////////



		
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)');
    curl_setopt($ch, CURLOPT_URL,$link);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, Array("text/xml"));
	
    $response = curl_exec($ch);
   
	
    $parsed_xml = simplexml_load_string($response);
	////////////
	$array = XML2Array::createArray($response);
    print_r($array);
	die();
	if($searchTerm == $array['GetMyPriceForASINResponse']['GetMyPriceForASINResult']['Product']['Identifiers']['MarketplaceASIN']['ASIN']){
		  //echo $searchTerm. "  " .$array['GetMyPriceForASINResponse']['GetMyPriceForASINResult']['Product']['Offers']['Offer'][0]['BuyingPrice']['ListingPrice']['Amount']."<br />";
		  //$sql_obj->Query("insert into inventory_health(product_details)values('".$acontents[$i]."')") or die(mysql_error());
		 
		if (mysql_query("update inventary_health set sales_price= '".$array['GetMyPriceForASINResponse']['GetMyPriceForASINResult']['Product']['Offers']['Offer'][0]['BuyingPrice']['ListingPrice']['Amount']."'  WHERE asin= '$searchTerm'") or die(mysql_error())){
				echo "Sales Price Updaed Successfully";
		}    
	}
	/*$p = xml_parser_create();
	xml_parse_into_struct($p, $response, $vals, $index);
	xml_parser_free($p);
	print_r($vals);*/

	//$array_stuc= xml_parse_into_struct($parsed_xml); 
    // print_r ($parsed_xml);
	// print_r ($array_stuc);
}
/////////////////////////////////////////////////////

 echo "<pre>";
//amazon_report_api_all_products('21123309003');
 amazon_xml('B00G8S4LXK');
 amazon_xml('B00IRMXW5I');
 amazon_xml('B00JX0DCOE');
 amazon_xml('B00LLLRUSW');
 amazon_xml('B00MKI2ITG');
 amazon_xml('B00OYK3MMA');
 amazon_xml('B00LPW9X32');
 amazon_xml('B00JG8OP1C');
 amazon_xml('B00KI1SZ9Y');
 amazon_xml('B00KY5S81O');
 amazon_xml('B00OM5WVEW');
 amazon_xml('B00NLR13X2');
 amazon_xml('B00JUEVZI8');

?>
