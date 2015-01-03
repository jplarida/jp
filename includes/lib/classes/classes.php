<?php 
class Celebrity{
	private $sql_obj;
	function __construct($sql_obj) {
		$this->sql_obj	=	$sql_obj;
   } 
   public function getNumOfMovies($id)	{
	   return $this->sql_obj->RowCount("movie_celebrity","WHERE celebrity_id = '$id'");
   }
   public function getHighGrossingMovies($id,$movie_obj)	{
	   //..............................GET ALL MOVIES OF CELEBRITY.....................//
	   $all_movie		=	array();
	   $all_movie		=	$this->sql_obj->QFetchRowArray("SELECT * FROM movie_celebrity WHERE celebrity_id = '$id'"); 
	   //..............................GET THE RATING OF THESE MOVIES..........................//
	   
	   if(is_array($all_movie))	{
		   for($i = 0; $i < count($all_movie); $i++)	{
			   if($i == count($all_movie) - 1)	{
				   $txt	='';
			   }else	{
				   $txt	=	',';
			   }
			    $ids  .=  $all_movie[$i]['movie_id']. $txt;;
		   }
		   $get_movie		=	$this->sql_obj->QFetchRowArray("SELECT id,movie_title,rating FROM movies WHERE id IN ($ids) ORDER BY rating"); 

	   }
	  return $get_movie;
   }
   public function getHigestRatedMovie($ceb_id)	{
	   return 	$this->sql_obj->QFetchArray("SELECT movie_celebrity.movie_id, movie_celebrity.celebrity_id,movies.movie_title,movies.id ,movies.rating FROM movie_celebrity,movies WHERE movie_celebrity.celebrity_id = '$ceb_id' AND movies.id = movie_celebrity.movie_id ORDER BY movies.rating DESC LIMIT 1"); 
   }
   public function getNumImages($id)	{
	  return  $this->sql_obj->RowCount("celebrity_images","WHERE parent_id = $id");
   }
   public function getImages($id,$limit = "")	{
	  return 		$this->sql_obj->QFetchRowArray("SELECT * FROM celebrity_images WHERE parent_id = $id $limit");
   }
}
$celebirity_obj		=		new Celebrity($sql_obj);

////////////////////////////////////////MOVIE CLASS///////////////////////////////////////
class Movie{
	private $sql_obj;
	function __construct($sql_obj) {
		$this->sql_obj	=	$sql_obj;
   } 
   function deleteMovieChild($id)	{
	   //Deelet the movie genres
		mysql_query("DELETE FROM movie_genres WHERE movie_id = $id");
		//Deelet the movie writers
		mysql_query("DELETE FROM movie_writers WHERE movie_id = $id");
		//Deelet the movie directors
		mysql_query("DELETE FROM movie_celebrity WHERE movie_id = $id");
		//For massage handling
   }
   function getDirectorName($dir_id)	{
	   $dir_row			=		$this->sql_obj->QFetchArray("SELECT dir_name,id FROM director WHERE id = '$dir_id'");
	   echo '<a href="?id='.$dir_row['id'].'">' .$dir_row['dir_name'].'</a>';
	   
   }
   function getWritersName($m_id)	{
	   $wir_row		=		$this->sql_obj->QFetchRowArray("SELECT movie_writers.movie_id,movie_writers.wir_id,writers.wir_name,writers.id FROM movie_writers, writers WHERE writers.id = movie_writers.wir_id AND movie_writers.movie_id = '$m_id'");
	   $i 		=		0;
	   if(is_array($wir_row))	{
		   foreach($wir_row as $key=>$row)	{
			   if($i > 0)	{
		   	   		echo ', <a href="?id='.$row['id'].'">'.$row['wir_name'].'</a>';
			   }else {
				   echo '<a href="?id='.$row['id'].'">'.$row['wir_name'].'</a>';
			   }			   
			   $i++;
		   }
	   }
   }
   function getGenreName($m_id)	{
	   $wir_row		=		$this->sql_obj->QFetchRowArray("SELECT movie_genres.movie_id, movie_genres.genre_id,genres.name,genres.id FROM movie_genres, genres WHERE genres.id = movie_genres.genre_id AND movie_genres.movie_id = '$m_id'");
	   $i 		=		0;
	   if(is_array($wir_row))	{
		   foreach($wir_row as $key=>$row)	{
			   if($i > 0)	{
		   	   		echo '| <a href="?id='.$row['id'].'">'.$row['name'].'</a>';
			   }else {
				   echo '<a href="?id='.$row['id'].'">'.$row['name'].'</a>';
			   }			   
			   $i++;
		   }
	   }
   }
   function getCast($m_id)	{
	   $cel_row		=		$this->sql_obj->QFetchRowArray("SELECT movie_celebrity.movie_id,movie_celebrity.celebrity_id,celebrity.name,celebrity.id,celebrity.image FROM movie_celebrity, celebrity WHERE celebrity.id = movie_celebrity.celebrity_id AND movie_celebrity.movie_id = '$m_id'");
	   $i 		=		0;
	   if(is_array($cel_row))	{
		   foreach($cel_row as $key=>$row)	{
			   echo '<div class="cast">
          				<div class="cast-photo"><a href="celebrities_detail.php?id='.$row['id'].'"><img src="images/celebrities/thumb_'.$row['image'].'" width="70" height="70" /></a> 
						</div>
          				<div class="cast-text"><a href="celebrities_detail.php?id='.$row['id'].'"><span class="blue15"><strong>'.$row['name'].'</strong></span></a><br />
            James Bond</div>
        			</div>';
		   }
	   }
   }
   public function getNumImages($id)	{
	  return  $this->sql_obj->RowCount("movie_images","WHERE parent_id = $id");
   }
   
   public function getImages($id,$limit = NULL)	{
	   if($limit != NULL)	{
		   $limit	= "LIMIT ". $limit;
	   }
	  $images_array		=	$this->sql_obj->QFetchRowArray("SELECT * FROM movie_images WHERE parent_id = '$id' $limit");
	  if(is_array($images_array))	{
		  foreach($images_array as $key=>$value){
			  $image_path		=	'images/movies/'. $value['image_video'];
				echo '<div class="small-photo-movie"><a href="picture.php?pid='.$value['id'].'&mid='.$id.'"><img src="'.$image_path.'" width="70" height="70" /></a></div>';
		  }
	  }
   }
   //...........................GET WATCH LIST HEADING................................//
   function getWatchListHeading($mov_id)	{
	   $user_id			=		$_SESSION['user_id'];
	   $count			=		$this->sql_obj->RowCount("watch_list","WHERE movie_id = '$mov_id' AND user_id = '$user_id'");
	   if($count > 0) 	{
		   echo '<span class="white12"><a href="javascript:void(0)" onclick="addToList('."'".$mov_id."'".');"><strong id="add-to-list" title="delete">Delete From List</strong></a></span>';
	   		
	   }else {
		   echo '<span class="white12"><a href="javascript:void(0)" onclick="addToList('."'".$mov_id."'".');" ><strong id="add-to-list" title="add">Add to List</strong></a></span>';
	   }
   }
   //...........................GET CELEBRITIES................................//
   function getCelebrities($m_id, $sep = NULL)	{
	   $cel_row		=		$this->sql_obj->QFetchRowArray("SELECT movie_celebrity.movie_id,movie_celebrity.celebrity_id,celebrity.name,celebrity.id,celebrity.image FROM movie_celebrity, celebrity WHERE celebrity.id = movie_celebrity.celebrity_id AND movie_celebrity.movie_id = '$m_id'");
	   $i 		=		0;
	   if(is_array($cel_row))	{
		   foreach($cel_row as $key=>$row)	{
			   echo $row['name']. ',';
		   }
	   }
	   
   } 
   function isRated($m_id,$user_id)	{
	   $is_rated			=		$this->sql_obj->RowCount("movie_rating","WHERE movie_id = '$m_id' AND user_id = '$user_id'");
	   if($is_rated > 0)	{
		   return 1;
	   }else {
		   return 0;
	   }
   }
   //...........................SHOW RATING................................//
   function getRating($m_id,$avg= NULL)	{
	   
	   	$rating				=		mysql_query("SELECT AVG(rating) AS average FROM movie_rating WHERE movie_id = '$m_id'");
		$rating_row			=		mysql_fetch_array($rating);
		if($rating_row['average'] == 0)	{
			echo "--";
			return;
		}
		if($avg != NULL)	{
			echo ((round($rating_row['average'],1) / 10) * 100) . "%";
	   }else {
		  echo round($rating_row['average'],1);
		  
	   }   
   }
   function returnRating($m_id,$avg= NULL)	{
	   
	   	$rating				=		mysql_query("SELECT AVG(rating) AS average FROM movie_rating WHERE movie_id = '$m_id'");
		$rating_row			=		mysql_fetch_array($rating);
		if($rating_row['average'] == 0)	{
			return 0;
		}
		if($avg != NULL)	{
			return ((round($rating_row['average'],1) / 10) * 100) . "%";
	   }else {
		  return round($rating_row['average'],1);
		  
	   }   
   }
   //............................GET NUM OF RATED USERS.......................//
   function getNumOfRatedUsers($m_id)	{
	   echo  $this->sql_obj->RowCount("movie_rating","WHERE movie_id = '$m_id'");
   }
	 
}
$movie_obj		=		new Movie($sql_obj);

function getNumberLinks()
	  {
		  $links = '';

		  for($i = 1; $i <= $this->totalPages; $i++)
		  {
			  $links .= '<a href="' . $this->url . '?'  . $this->pageIndexVar . '=' . $i .'">' . $i . '</a> ';
		  }

		  return $links;
	  }
	  ?>