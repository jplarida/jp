<?php
class Comment	{
	private  $sql_obj;
	function __construct($sql_obj)	{
		$this->sql_obj	=	$sql_obj;
	}
	function getCommentsLink()	{
		require_once('security.php');
		$security		=	new Security("user_id");
		if($security->isSession() == true)	{
			return '';

		}else {
			return ('window.location.href = "index.php"; return;');
		}
	}
	function getComments($news_id)	{
		$comments_row	=	$this->sql_obj->QFetchRowArray("SELECT c.*,u.first_name, u.last_name FROM comments c, users u WHERE c.news_id = '$news_id' AND u.id = c.user_id");
		$html	=	"";
		if(isset($comments_row))	{
			foreach($comments_row as $key=>$row)	{
				$html		.=	'<div class="coment-cont">
    <div class="img-author"><img src="themes/images/twitter_newbird_boxed_whiteonblue.png" width="40" height="40" alt="news" /></div>
    <div class="comm-des"> <span class="red13"> <strong>Michael</strong></span> &nbsp;By : '.$row['first_name'] .' ' .$row['last_name'].'&nbsp;  |  '.ago(strtotime($row['date_time'])).'
      <p class="desc">'.$row['comments'].'</p>
    </div>
  </div>';
			}
		}
		return $html;
	}
	function getSingleComments($id)	{
		$html	=	"";
		$comments_row	=	$this->sql_obj->QFetchArray("SELECT c.*,u.first_name, u.last_name FROM comments c, users u WHERE  u.id = c.user_id AND c.id = '$id'");
		if(is_array($comments_row))	{
			$html		=	'<div class="coment-cont">
		<div class="img-author"><img src="themes/images/twitter_newbird_boxed_whiteonblue.png" width="40" height="40" alt="news" /></div>
		<div class="comm-des"> <span class="red13"> <strong>Michael</strong></span> &nbsp;By : '.$comments_row['first_name'] .' ' .$comments_row['last_name'].'&nbsp;  |  '.ago(strtotime($comments_row['date_time'])).'
		  <p class="desc">'.$comments_row['comments'].'</p>
		</div>
	  </div>';
		}
		return $html;
	}
	function addComments($news_id, $comments)	{
		require_once('security.php');
		$security		=	new Security("user_id");
		$this->sql_obj->Query("INSERT INTO comments (news_id, user_id, comments, date_time) VALUES ( '$news_id', '".$security->getSessionValue()."', '$comments', CURRENT_TIMESTAMP)");
		echo 	$this->getSingleComments($this->sql_obj->InsertID());		
	}
	
}
?>