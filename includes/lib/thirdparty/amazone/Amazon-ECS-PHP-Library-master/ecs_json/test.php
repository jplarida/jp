<?php require_once('lib/AmazonECS.class.php'); ?>
<?php


define('AWS_API_KEY', 'AKIAJMFFUE3L7S5QII7Q');
define('AWS_API_SECRET_KEY', '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');
define('AWS_ASSOCIATE_TAG', 'test05-12');


try
{
$amazonEcs = new AmazonECS(AWS_API_KEY, AWS_API_SECRET_KEY, 'COM', AWS_ASSOCIATE_TAG);

// for the new version of the wsdl its required to provide a associate Tag
// @see https://affiliate-program.amazon.com/gp/advertising/api/detail/api-changes.html?ie=UTF8&pf_rd_t=501&ref_=amb_link_83957571_2&pf_rd_m=ATVPDKIKX0DER&pf_rd_p=&pf_rd_s=assoc-center-1&pf_rd_r=&pf_rd_i=assoc-api-detail-2-v2
// you can set it with the setter function or as the fourth paramameter of ther constructor above
$amazonEcs->associateTag(AWS_ASSOCIATE_TAG);

//search-alias=aps
    // searching again
	//$response = $amazonEcs->responseGroup('Images')->lookup('B00G2X1VIY');
	for($i = 1; $i <= 1; $i++)	{
  	 	$response = $amazonEcs->responseGroup('Small')->page($i)->category('All')->search('natural+testosterone+booster');
		echo "<pre>";
		//print_r($response);
		
		$array	=	$response->Items->Item;
		$j		=	1;
		foreach($array	as $row)	{
			//echo ($row->ASIN)."<br/>";
			$rank		=	(($i - 1) * 10 + $j);
			if($rank > 9) {$rank	 =	 $rank - 1;}
			echo $row->ASIN."===".$i."===".$j."===Page: ".$rank."<br/>";
			$j++;
		}
	}
}
catch(Exception $e)
{
echo $e->getMessage();
}




?>