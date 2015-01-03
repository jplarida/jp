<?php
class Post	{
	private $sql_obj;
	//.........................................FOR REGISTRATION.................................//
	function __construct($sql_obj)	{
		$this->sql_obj	=	$sql_obj;
	}
	function postObject()	{
		if(isset($_POST['image']))	{
			$upload_obj							=	 new Upload();
			$upload_obj->max_file_size 			= 	1500000;  
			$upload_obj->allowed_file_types 	= 	'jpg,gif,bmp,png,jpeg';  
			$error 								= 	$upload_obj->UploadFile('image', CHIPPT_IMAGES, 1);
			$file_name 							= 	$upload_obj -> file['server_file_name'];
			
			//........................MAKE THUMB FOR WOOKMARK LAYOUT...................//
			$image = new SimpleImage();
			list($width, $height, $type, $attr) = getimagesize(CHIPPT_IMAGES.$file_name);
			$wook_height						=	round($height/$width*200);
			$image->makeThumbs(235,$wook_height,$file_name,CHIPPT_IMAGES);
			$this->sql_obj->Query("INSERT INTO posts( title, image, post_width, post_height) VALUES ('".$_POST['title']."', '$file_name', '$width', '$height');");	
		}
	}
	function addChipptStep1($cat_id,$image_name)	{
		$this->sql_obj->Query("INSERT INTO posts( image, post_width, post_height) VALUES ('".$_POST['title']."', '$file_name', '$width', '$height');");	
		
	}
	function scrappImages($url)	{
		$url				=		(substr($url,0,7) == "http://")?$url:"http://".$url;
		//$html 				= 		file_get_html($url);
		$thumb_array		=		array();
		$i					=		0;
		//.....................MAKE URL OBJECT TO GET DOMAIN URL....................//
		$url_obj			=		new Url();
		$site_url			=		"http://".$url_obj->getDomainAdress($url).'/';
		unset($url_obj);
	
		$image_obj		=	new SimpleImage();
		$html			=	$image_obj->getHtmlFromUrl($url);
		unset($image_obj);
		
		$dom = new DOMDocument();
		$dom->loadHtml($html);
		foreach ($dom->getElementsByTagName('img') as $img) {
			$image_path				=		$img->getAttribute('src');
			if(substr($image_path,0,7) == "http://")	{
				$thumb_array[$i]	=		$image_path	;
				$i++;
			}else	{
				$thumb_array[$i]	=		$site_url.$image_path.$e->src;
				$i++;
			}
		}
		
		$imgs	=	new Security('scrapp_imgs');
		$imgs->setSession($thumb_array);
	}
	function showFrstImage()	{
		$imgs			=	new Security('scrapp_imgs');
		$img_arry		=	$imgs->getSessionValue();
		echo $img_arry[0];
		
	}
	function makeJavaScriptArray()	{
		$imgs			=	new Security('scrapp_imgs');
		$img_arry		=	$imgs->getSessionValue();
		return $img_arry;
		
	}
	function totalImages()	{
		$imgs			=	new Security('scrapp_imgs');
		$img_arry		=	$imgs->getSessionValue();
		return count($img_arry);
		
	}
	function postChipptByUrl($data)	{
		require_once('security.php');
		$url_obj		=		new Url();
		$site_url		=		$url_obj->getDomainAdress($data['current_url']);
		$image_obj		=		new SimpleImage();
		$fileParts  	= 		pathinfo($data['current_url']);
		$file_name		=		md5(time().rand()).".".$fileParts['extension'];
		
		//.......................COPY THE SELECTED IMAGE..................//
		copy($data['current_url'],"../../../".CHIPPT_IMAGES.$file_name);
		
		//.......................LOAD IMAGE FOR HEIGHT AND WIDHT..................//
		$image_obj->load("../../../".CHIPPT_IMAGES.$file_name);
		
		//....................................RRUN QUERY...............................//
		$this->sql_obj->Query("INSERT INTO posts (title, image, image_width, image_height, url, image_url,ucat_id,price) 
		VALUES ('".$data['why_upload']."', '".$file_name."', '".$image_obj->getWidth()."', '".$image_obj->getHeight()."', '".$site_url."', '".$data['current_url']."','".$data['cat_id']."','".$data['price']."')");
		
		//.......................UNSET THE ARRAY OF SCRAPP IMAGES NOW NO NEED..................//
		$security_obj 	=	new Security("scrapp_imgs");
		//$security_obj->unsetSession();
		return $this->sql_obj->InsertID();
	}
	function getPost($post_id)	{
		$post_row	=	$this->sql_obj->QFetchArray("SELECT * FROM posts WHERE id = '".$post_id."'");
		return $post_row;
	}
}
?>