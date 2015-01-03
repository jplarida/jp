<?php require_once('includes/lib/includes.php'); 


/////////////////////GEt all settings///////////////////////////////////////
$results = mysql_fetch_array(mysql_query("SELECT * from respond_settings"));

/////////////////////////////Get all 1 and 2 responds////////////////////////

if($results['respond_1_2'] == 1)
{
//	echo  $results['respond_1_2_message'];
	
	
	//$all_response_1_2    =   mysql_query("SELECT response_url from feedbacks  WHERE rating  in (1,2)");

	$all_response_1_2    =   mysql_query("SELECT id, response_url from feedbacks  WHERE id = '3173'");
	
	
	while($get_all_response_1_2   =   mysql_fetch_array($all_response_1_2)){
		
		
               //  echo  $get_all_response_1_2['response_url'];
	
	if($amazone_obj->response(urldecode($get_all_response_1_2['response_url']),$results['respond_1_2_message']) == "")
	{	
	
	
	    
		//goUrl("feedbacks.php?msg=Response is submitted sucessfully!");
	echo "success";
  $sql_obj->Query("UPDATE feedbacks SET is_responed = 1 WHERE response_url = '".urldecode($get_all_response_1_2['response_url'])."'");	
	die();
	     
	}
																           }
	
	
	
	}

if($results['respond_3'] == 1){
	
	

	$all_response_3    =   mysql_query("SELECT response_url from feedbacks  WHERE rating  in (3)");
	
	
	while($get_all_response_3   =   mysql_fetch_array($all_response_3)){
		
		
          //        echo  $get_all_response_1_2['response_url'];
	
	//if($amazone_obj->response(urldecode($get_all_response_3['response_url']),$results['respond_3_message']) == "")
		{
		//goUrl("feedbacks.php?msg=Response is submitted sucessfully!");
	 $sql_obj->Query("UPDATE feedbacks SET is_responed = 1 WHERE response_url = '".urldecode($get_all_response_3['response_url'])."'");	
	echo "success";
	die();
	   }	
	                                                             	}        
	                            }





if($results['respond_4_5'] == 1)
{
	

	$all_response_4_5    =   mysql_query("SELECT response_url from feedbacks  WHERE rating  in (4,5)");
	
	
	while($get_all_response_4_5   =   mysql_fetch_array($all_response_4_5)){
		
		
          //        echo  $get_all_response_1_2['response_url'];
	
	//if($amazone_obj->response(urldecode($get_all_response_4_5['response_url']),$results['respond_4_5_message']) == "")
										{	
		//goUrl("feedbacks.php?msg=Response is submitted sucessfully!");
		 $sql_obj->Query("UPDATE feedbacks SET is_responed = 1 WHERE response_url = '".urldecode($get_all_response_4_5['response_url'])."'");	
	echo "success";
	die();
                                    	}
	                                           
	
	
		
																	  	}
	
  }



 ?>