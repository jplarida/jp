<?php
function getSucessMessage($message)	{
	?>
<div class="note note-success">
  <p> <?php echo $message; ?> </p>
</div>
<?php
	
}

function getErrorMessage($message)	{
	?>
<div class="note note-danger">
  <p> <?php echo $message; ?> </p>
</div>
<?php
	
}

function getPlugin()	{
	$page				=	 	basename($_SERVER['PHP_SELF']);
	$array				=		array();
	$array['cs']		=	 	"form-plugin-css.php";
	$array['js']		=	 	"form-plugin-js.php";
	switch ($page) {
		case "feedbacks.php":
			$array['cs']	=	 	"form-plugin-css.php";
			$array['js']	=	 	"form-plugin-js.php";
			break;
		case "performance.php":
			$array['cs']	= 		"performance-plugin-cs.php";
			$array['js']	=	 	"performance-plugin-js.php";
			break;
			
		case "rank-tracker.php":
			$array['cs']	= 		"form-wizard-css.php";
			$array['js']	=	 	"form-plugin-js.php";
			break;
	}
	return $array;
	
}
function activeTab($tab)	{
	if($tab  == $_GET['tab'])	{
		echo "active";
	}
}
function getStatus($status,$id = NULL)	{
	if($status == "1")	{
		echo '<a href="?id='.$id.'&cmd=active&value=0"><span class="label label-sm label-success">Active</span></a>';
	}else {
		echo '<a href="?id='.$id.'&cmd=active&value=1"><span class="label label-sm label-danger">Inactive</span></a>';
	}
}
function getProductDropDown($id = NULL)	{
		global $sql_obj;
		$string			=	"";
		$pro_row		=	$sql_obj->QFetchRowArray("SELECT * FROM products WHERE user_id = '".$_SESSION['user_id']."'");
		if(is_array($pro_row))	{
			foreach($pro_row as $key=>$row)	{
				if($id	!= NULL)	{
					if($id == $row['id'])	{
						$string			.=	'<option selected value="'.$row['id'].'">'.$row['asin']." - ".$row['name'].'</option>';
					}else {
						$string			.=	'<option  value="'.$row['id'].'">'.$row['asin']." - ".$row['name'].'</option>';
					}
				}else {
					$string			.=	'<option  value="'.$row['id'].'">'.$row['asin']." - ".$row['name'].'</option>';
				}
				
			}
		}
		return $string;
}