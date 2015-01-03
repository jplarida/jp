<?php


    include("amazon_api_class.php");

    $obj = new AmazonProductAPI();
    
    try
    {
        $result = $obj->getItemByAsin("B007ENOFCK");
		
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
	echo $result->Items->Item->SalesRank;
    

?>