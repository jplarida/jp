	<?php // require_once('db_con.php'); 
	
	
	function GetUserName($id){
	
	$name = mysql_fetch_array(mysql_query("SELECT username from user WHERE id = $id "));
	
	
	 return $name['username'];
	
	
	
	}
	
	
	
	
	
	function generateHash($password) {
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
 }
}


function verify($password, $hashedPassword) {
    return crypt($password, $hashedPassword) == $hashedPassword;
}
	
	
	
	
	
	 function GetName($table1,$id_num){
		$data =  mysql_query("SELECT name from $table1 WHERE id = '".$id_num."' ");
	  
         $getdata = mysql_fetch_array($data);
		 
		 echo $getdata['name'];		  
		  }
		  function GetCurriculamName($id_num){
		$data =  mysql_query("SELECT curriculam from curriculams WHERE id = '".$id_num."' ");
	  
         $getdata = mysql_fetch_array($data);
		 
		 echo $getdata['curriculam'];		  
		  }
		  		  function GetLevelName($id_num){
		$data =  mysql_query("SELECT level from levels WHERE id = '".$id_num."' ");
	  
         $getdata = mysql_fetch_array($data);
		 
		 echo $getdata['level'];		  
		  }
		  function GetSkillName($id_num){
	$date = mysql_query("SELECT skill from skills WHERE id = '".$id_num."' ");
	  
         $getdata = mysql_fetch_array($data);
		 
		 echo $getdata['skill'];		  
		  }
		 function GetNameDiff($table1,$id_num,$checkfor){
		$data =  mysql_query("SELECT $checkfor from $table1 WHERE id = '".$id_num."' ");
	  
         $getdata = mysql_fetch_array($data);
		 
		 echo $getdata[''.$checkfor.''];		  
		  } 
		  function GetCountryName($id_num){
		$data =  mysql_query("SELECT * from countries WHERE ccode = '$id_num'");
	  
         $getdata = mysql_fetch_array($data);
		 
		 echo $getdata['country'];		  
		  }   
		  
		    function GetFolderName($id_num){
		$data =  mysql_query("SELECT folder_name  from enjaz_folder WHERE id = '$id_num'");
	  
         $getdata = mysql_fetch_array($data);
		 
		 echo $getdata['folder_name'];		  
		  }   
		  
		  
		  
		  
		  
	function GetSelectName($table1,$table2,$id){
		
		$html		=	NULL;
		$data 		=	mysql_query("SELECT DISTINCT s.id as sid,s.name as sname,j.$id from $table1 as s , $table2 as  j WHERE s.id = j.$id and j.user_id = '".$_SESSION['admin_id']."'");
		while($getdata = mysql_fetch_array($data))	{
			$html .= '<option value="'.$getdata['sid'].'">'.$getdata['sname'].'</option>';
			
		}
		 
		return $html; 
	} 	  
	
		function GetSelectedNameLevel($table1,$table2,$id){
		
		$html		=	NULL;
		$data 		=	mysql_query("SELECT DISTINCT s.id as sid,s.level as sname,j.$id from $table1 as s , $table2 as  j WHERE s.id = j.$id and j.user_id = '".$_SESSION['admin_id']."'");
		while($getdata = mysql_fetch_array($data))	{
			$html .= '<option value="'.$getdata['sid'].'">'.$getdata['sname'].'</option>';
			
		}
		 
		return $html; 
	} 	  
	  function GetSelectedNameCurriculam($table1,$table2,$id){
		
		$html		=	NULL;
		$data 		=	mysql_query("SELECT DISTINCT s.id as sid,s.curriculam as sname,j.$id from $table1 as s , $table2 as  j WHERE s.id = j.$id and j.user_id = '".$_SESSION['admin_id']."'");
		while($getdata = mysql_fetch_array($data))	{
			$html .= '<option value="'.$getdata['sid'].'">'.$getdata['sname'].'</option>';
			
		}
		 
		return $html; 
	} 	  
	
	 function GetSelectedNameCountry($table1,$table2,$id){
		
		$html		=	NULL;
		$data 		=	mysql_query("SELECT DISTINCT s.ccode as sid,s.country as sname,j.$id from $table1 as s , $table2 as  j WHERE s.ccode = j.$id and j.user_id = '".$_SESSION['admin_id']."'");
		while($getdata = mysql_fetch_array($data))	{
			$html .= '<option value="'.$getdata['sid'].'">'.$getdata['sname'].'</option>';
			
		}
		 
		return $html; 
	} 	  
	  	 function GetSelectedNameGroup(){
		
		$html		=	NULL;
		$data 		=	mysql_query("SELECT id,name from admin_group WHERE admin_id = '".$_SESSION['admin_id']."'");
		while($getdata = mysql_fetch_array($data))	{
			$html .= '<option value="'.$getdata['id'].'">'.$getdata['name'].'</option>';
			
		}
		 
		return $html; 
	} 
// for taking complete html of selet boxes....	
   function   GetHtml($check){
	   $html = NULL;
	   
   switch ($check){
   
   CASE   'semesters': 
   
   	  $data 		=	mysql_query("SELECT * from semesters");
		while($getdata = mysql_fetch_array($data))	{
			$html .= '<option value="'.$getdata['id'].'">'.$getdata['name'].'</option>';
			
		       }

        		return $html;  
    
      CASE   'countries': 
   
   	  $data 		=	mysql_query("SELECT * from countries");
		while($getdata = mysql_fetch_array($data))	{
			$html .= '<option value="'.$getdata['ccode'].'">'.$getdata['country'].'</option>';
			
		       }
	 
		return $html;  
    	    
	   
	      CASE   'levels': 
   
   	  $data 		=	mysql_query("SELECT * from levels");
		while($getdata = mysql_fetch_array($data))	{
			$html .= '<option value="'.$getdata['id'].'">'.$getdata['level'].'</option>';
			
		       }
	 
		return $html;			   
				   
				   
                              

	//	      CASE   'levels': 
   
  // 	  $data 		=	mysql_query("SELECT * from ");
	///	while($getdata = mysql_fetch_array($data))	{
		//	$html .= '<option value="'.$getdata['id'].'">'.$getdata['name'].'</option>';
			
	//	       }
	 
		//return $html;			   
				   
				      CASE   'curriculams': 
   
   	  $data 		=	mysql_query("SELECT * from curriculams");
		while($getdata = mysql_fetch_array($data))	{
			$html .= '<option value="'.$getdata['id'].'">'.$getdata['curriculam'].'</option>';
			
		       }
	 
		return $html;			   
                              
                                    
				      CASE   'lessons': 
   
   	  $data 		=	mysql_query("SELECT * from lessons");
		while($getdata = mysql_fetch_array($data))	{
			$html .= '<option value="'.$getdata['id'].'">'.$getdata['name'].'</option>';
			
		}
	 
		return $html;	
		
		 CASE   'behaviours': 
   
   	  $data 		=	mysql_query("SELECT * from behaviours WHERE user_id = '".$_SESSION['admin_id']."'");
		while($getdata = mysql_fetch_array($data))	{
			$html .= '<option value="'.$getdata['id'].'">'.$getdata['name'].'</option>';
			
		}
	 
		return $html;								
	    
                       }
					   
					   
					   
   } 
   
   
     function EditSelected($id,$id2,$id3=1){
      
       if(isset($id) && $id == $id2){
       return $select  =  'selected="selected"';
       
        }   
        else if($id3 == $id2){
         
       return  $select  =  'selected="selected"';
         }
          else {
           return $select  = NULL;
		  
           }
  
                    }
   
   
    
     function EditSingleSelected($id1,$id2){
      
    if($id1 == $id2){
         
       return  $select  =  'selected="selected"';
         }
          else {
           return $select  = NULL;
		  
           }
  
          
          }
		   function SecurityCheckForid($id,$table,$link,$optionalid = NULL){
	 
	 if($optionalid == NULL) {
	 
	 
	 $check = mysql_query("SELECT id from $table WHERE id = $id AND user_id = '".$_SESSION['admin_id']."'");
	 }
	 
	 else {
        
		$check = mysql_query("SELECT id from $table WHERE id = $id AND $optionalid = '".$_SESSION['admin_id']."'");		 
		 
		 
		 }
      if(mysql_fetch_row($check)==0){
	 
               gourl("$link");	 
	 
	 
                                  } 
	  
	                                                    }
   
    function   GetJobPlanName($id,$type){
		  
		  switch ($type){
			  case jobs:
		      
			  $name = (mysql_fetch_array(mysql_query("SELECT job_name from job_lessons WHERE id = $id")));
		      return $name['job_name'];
		       break;
			     case plans:
		      
			  $name = mysql_fetch_array(mysql_query("SELECT plan_name from plan_lessons WHERE id = $id"));
		      echo $name['plan_name'];
		       break; 
 		  }
		  
		  }
	
		
     function GetUserType($id){
	
	$type  = (mysql_fetch_array(mysql_query("SELECT user_type from user where id = '$id'")));
	
   return 	$type['user_type'];
	}  
	
	  function GetAnyName($id,$colum,$table){
		  
		  $name = (mysql_fetch_array(mysql_query("SELECT $colum from $table WHERE id = $id")));
		  return $name[''.$colum.''];
		  
		  
		  
		  }
        
        
  	?>      