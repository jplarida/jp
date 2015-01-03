<?php
 
/*
* File: SimpleImage.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details:
* http://www.gnu.org/licenses/gpl.html
*
*/
 
class SimpleImage {
 
   var $image;
   var $image_type;
 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      
 
}
?>
<?php


/** 
 * U p l o a d 
 * Upload file to a custom directory & 
 * Validate file size, type 
 * 
 *
 * @author Adrian Vicovan <adi@dreamaker.ro>
 * @version 1.0
 * @since 1.0
 * @access public
 * @package file_upload
 * 
 */
		
class Upload {

	/**
     * Maximum file size
     * @var integer
     * @access public
     */
	var $max_file_size = 1572864; //1,5 Mb

	/**
     * Allowed file types
     * @var integer
     * @access public
     */
	var $allowed_file_types = 'jpg,jpeg,png,doc,txt,gif,rtf,pdf,xls,rar,tar,zip,tgz,gz';

	/**
     * Array with uploaded params: client_file_name, server_file_name, server_file_dir, file_size, file_date
     * @var integer
     * @access public
     */
	var $file;
					
	/**  
 	 * The constructor for the 'Upload' class 
	 *
	 * @access public
	 */
	 function Upload(){
	 	// initiate uploaded file details
	 	$this -> file['client_file_name'] 	= '';   // client file name
	 	$this -> file['server_file_name'] 	= '';	// server file name
	 	$this -> file['server_file_dir'] 	= '';	// server file name + path (starting form root dir)
	 	$this -> file['file_size'] 			= '';	// file size 
	 	$this -> file['file_date'] 			= '';	// upload date & time
	 }
	 function ImageUplloadResize($image ,$width ,$hight,$path) {

		$upload   = new Upload();
		$upload->UploadFile($image,$path,'1');
		
		$image_path  =   $upload -> file['server_file_name'];
		@$ext = strtolower(end(explode('.', $_FILES[$image]['name'])));
		$image    =  new SimpleImage();
		$image->load($path . '/'.$image_path);
		$image->resize($width,$hight);
		$thum_name   =  $path."/thumb_". $image_path;
		$image->save($thum_name);
		@chmod($path. "/thumb_". $image_path.'.'.$ext, 777);
		return $image_path; 
	}
    /**
     * D i r
	 * Scope 1: Verify if $dir exists
	 * Scope 2: Create a directory to the specified path (& chmod to 777)
     *
     * @return full server path
     * @param string $dir  Directory
     * @access public
     */
	function Dir($dir){
	    // get full path on server
		//$dir = preg_replace("/(.*)(\/)$/","\\1", $dir);
		//$dir = $_SERVER['DOCUMENT_ROOT'] . '' . $dir;
		
		// if $dir doesn't exists create a new directory to that location
		if(!is_dir($dir)){
			@mkdir($dir, 0777);
			@chmod($dir, 0777);
		}
		
		// return full server path
		return $dir;
	} 

	
	/**
	 * U p l o a d F i l e
	 * Uploads all files from $_FILES (files from form) to $dir on server
	 * 
	 * @return error message
	 * @param string $file_var  The name of the FILE Field from your form
	 * @param string $dir  Directory where to place the uploaded files
	 * @param boolean $uniq  If is set to 1 then each file will receive a unique name (and keep the extension)
	 * @access public
	 */ 	
	function UploadFile($file_var, $dir, $uniq = 0){
		$dir2 = $dir;
	    $dir = $this -> Dir($dir); 
		
		// verify if a file by that name has been uploaded
	    if(!is_array($_FILES[$file_var])) 
			return 'Error: Inexistent file field "' . $file_var . '" in your form ...';
			
		$file = $_FILES[$file_var];
		
		// verify if filename exists
	    if(empty($file['name'])) 
			return 'Error: Inexistent filename...';
		
		// verify if file has been uploaded on server
		if(!is_uploaded_file($file['tmp_name'])) 
			return 'Error: Could not write on server in the tmp directory...';
					
		//validate file SIZE			
		if ($file['size'] > $this -> max_file_size) 
			return 'Error: The maximum uploaded file size allowed is ' . $this -> max_file_size . '. (your file size is ' . $file['size'] . ')';
					
		// file extension (filetype)
		$ext = strtolower(end(explode('.', $file['name'])));

		// validate file TYPE
		if(!in_array($ext, explode(',', $this -> allowed_file_types)))
			return 'Error: File type not allowed (only: ' . $this -> allowed_file_types . ')...';
			
		// file NAME
		$filename = basename($file['name']);
		if($uniq) $filename = $this -> Uniq() . '.' . $ext;
		
	//	echo $dir . '/' . $filename;
		// move file to specified location
		if(!@move_uploaded_file($file['tmp_name'], $dir . '/' . $filename)) 
			return 'Error: File could not be uploaded on specific location on server...';
			
		// update uploaded file details
	 	$this -> file['client_file_name'] 	= $file['name'];     	// client file name
	 	$this -> file['server_file_name'] 	= $filename;			// server file name
	 	$this -> file['server_file_dir'] 	= $dir2;				// server file name + path (starting form root dir)
	 	$this -> file['file_size'] 			= $file['size'];		// file size 
	 	$this -> file['file_date'] 			= date("Y-m-d H:i:s");	// upload date & time
		
		// return no errors
		return 0;
	}


 	/**
	 * U n i q
  	 * Return a unique code based on curent unix time in microsec plus a random 6 digit number
	 *
	 * @return integer 
	 * @access public
	 */
	function Uniq(){
		$time=microtime();
		$time=explode(" ",$time);
		return str_replace('.', '', $time[1] + $time[0]) . rand(100000, 999999);
	}


    /**
     * D e l e t e
	 * Deletes the specified file from server
     *
     * @return boolean
     * @param string $dir  Directory
     * @param string $file  Filename
     * @access  public
     */
	function Delete($dir, $file){
	    $dir = $this -> Dir($dir);
		$file = $dir . '/' . $file;
		
		if( (file_exists($file)) && (@unlink($file)) ) return 1;
		return 0;
	}

	
    /**
     * R e n a m e
	 * Rename $file on server with $newname
	 *
     * @param $dir  Directory for file on server
	 * @param $file  Current file on server
	 * @param $newname  New file name
     * @access  public
     */
	function Rename($dir, $file, $newname){
	    $dir = $this -> Dir($dir);
		if(rename($dir . '/' . $file, $dir . '/' . $newname)) return 1;
	    return 0;
	}


} //end class

?>