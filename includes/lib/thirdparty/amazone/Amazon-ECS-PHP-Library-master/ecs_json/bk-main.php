<?php
set_time_limit (180);

require_once('lib/AmazonECS.class.php');
require_once('lib/amazon_api_class.php');


class ProductAdvertising{
	private				$amazonEcs;
	private				$country;
	function __construct()	{
		try	{
			$this->amazonEcs	 = 	new AmazonECS(AWS_API_KEY, AWS_API_SECRET_KEY, COUNTRY, AWS_ASSOCIATE_TAG);
		}catch(Exception $e)	{
			echo $e->getMessage();
			die();
		}
	}
	public function getProductRankByKeyword($keyword,$asin)	{
		
		try	{
			$this->amazonEcs->associateTag(AWS_ASSOCIATE_TAG);
			$rank		=	0;
			for($i = 1; $i <= 5; $i++)	{
				$response = $this->amazonEcs->responseGroup('Small')->page($i)->category('All')->search($keyword);
				//echo "<pre>";
				
				$array	=	$response->Items->Item;
				$j		=	1;
				foreach($array	as $row)	{
					
					$as		=	trim($row->ASIN);
					//echo $as."===".$i."===".$j."<br/>";
					
					if($asin	==	$as)	{
						$rank		=	(($i - 1) * 10 + $j);
						if($rank > 9) {$rank	 =	 $rank - 1;}
					
					}
					$j++;
					
				}
			}
			
			
			return $rank;
		}
		catch(Exception $e)	{
			echo $e->getMessage();
			die();
		}

	}
	public function getRank($string,$asin,$keyword)	{
		$rank	=	false;
		
		if(strpos($string, $asin)== true){
			foreach ($string->find('li') as $i => $node) {

				$array		=	$node->getAllAttributes();
				echo "<pre>"; print_r($array);echo "<br/>";
				die();
				
				if(array_key_exists('data-asin', $array))	{
					if(trim($array['data-asin']) == trim($asin))	{
						$rank_array	=	explode("_",$array['id']);
						$rank		=	$rank_array[1] + 1;
						echo "Keyword is: ".$keyword."<br/>ASIN is: ".$asin."<br/>Rank is: ".$rank;
					}
				}
			}
		}
		return $rank;
	}
	public function getProductRankByKeywordScrap($keyword,$page = 1,$asin)	{
		$url			=		"http://www.amazon.com/s/ref=sr_pg_2?page=".$page."&keywords=".str_replace(" ","+",$keyword)."&ie=UTF8";
		
		$html  			= 		file_get_html($url);
		
		$atfResults	=		$this->getRank($html->find("#atfResults", 0),$asin,$keyword);
		if($atfResults != false)	{
			return $atfResults;
		}
		$btfResults	=		$this->getRank($html->find("#btfResults", 0),$asin,$keyword);
		if($btfResults != false)	{
			return $btfResults;
		}	
	}
	function getSaleRank($asin)	{
		$obj = new AmazonProductAPI();
		try	{
			$result = $obj->getItemByAsin($asin);
			
		}
		catch(Exception $e)		{
			echo $e->getMessage();
			die();
		}
		return  $result->Items->Item->SalesRank;
		
	}
	
}


?>