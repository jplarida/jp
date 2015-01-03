<?php 
require_once('includes/lib/includes.php'); 

if(isset($_SESSION['user_id']))	{
	goUrl("feedbacks.php");
}

if(isset($_POST["submit"]))		
{
	
	 $fullname     	=  		mysql_real_escape_string($_POST['fullname']);
	  $email     	=  		mysql_real_escape_string($_POST['email']);
	 $username      =  		trim($_POST['username']);


	
	  $country      =  		mysql_real_escape_string($_POST['country']);
	

	 $password     	=  		trim($_POST['password']);
	
	 $re_password   =  		mysql_real_escape_string($_POST['rpassword']);
	  $files        =       $_FILES['files'];
	  	
      
	                      
			if($_FILES['files']['size'] > 0){
				
					$files        =      ImageUplloadResize("files",200,200,'user-images/');
					
					

	 				$query = mysql_query("SELECT user_name ,email  FROM users WHERE user_name='$username'
					 || email = '$email'");
	      					if(mysql_num_rows($query) > 0 )
 							  {
         					$error = "User name or email already exists please Try again";
		  					}

           					else
		  					{
               					 if ($_POST['password'] != $_POST['rpassword'])
    		    					{
                					$error = "Oops! Password did not match! Try again.";
       		     				 	}
	           			 		  else	{
				

	  
		                 			 $sql_obj->Query("INSERT INTO users(name,email,country,user_name,password,image)
	  VALUES('$fullname', '$email','$country','$username','$password','$files')"); 
	  
	  $last_id		=	$sql_obj->InsertID();
	  
	   $sql_obj->Query("INSERT INTO setting(user_id)
	  VALUES('$last_id')"); 
	  $_SESSION['user_id']   =      	  $last_id;
	
		 	           					}
								 gourl('setting.php');
 
		 
			         }
		        }
	 
	 
	 else {
		
		 $query = mysql_query("SELECT user_name,email FROM users WHERE  
		  user_name='$username' || email = '$email'");
	    if(mysql_num_rows($query) > 0)
 		{
     $error = "Username or email already exists please Try again";
		}

   else
		{
  if ($_POST['password']!= $_POST['rpassword'])
    		{
   $error = "Oops! Password did not match! Try again.";
     		}
	else	{
			

	 $sql_obj->Query("INSERT INTO users(name,email,country,user_name,password,image)
	  VALUES('$fullname', '$email','$country','$username','$password','no-image.jpg')");
	   
	   $last_id		=	$sql_obj->InsertID();
	  
	   $sql_obj->Query("INSERT INTO setting(user_id)
	  VALUES('$last_id')"); 
	  $_SESSION['user_id']   =      	  $last_id; 

goUrl("setting.php");
		 	}
			 
 
	
		}
		 
		 }
}

?>

<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.0.2
Version: 1.5.4
Author: KeenThemes
Website: http://www.keenthemes.com/
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Amazone | Seller Tools</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="MobileOptimized" content="320">
	<!-- BEGIN GLOBAL MANDATORY STYLES -->          
	<link href="<?php echo THEME_BASE; ?>metronic/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo THEME_BASE; ?>metronic/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES --> 
	<link rel="stylesheet" type="text/css" href="<?php echo THEME_BASE; ?>metronic/plugins/select2/select2_metro.css" />
	<!-- END PAGE LEVEL SCRIPTS -->
	<!-- BEGIN THEME STYLES --> 
	<link href="<?php echo THEME_BASE; ?>metronic/css/style-metronic.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo THEME_BASE; ?>metronic/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo THEME_BASE; ?>metronic/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo THEME_BASE; ?>metronic/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo THEME_BASE; ?>metronic/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="<?php echo THEME_BASE; ?>metronic/css/pages/login.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo THEME_BASE; ?>metronic/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- BEGIN BODY -->
<body class="login">
	<!-- BEGIN LOGO -->
	<div class="logo">
		<span style="font-size: 22px;
color: #fff;">Amazone <span style="font-size: 22px;
color: #F00;">Seller</span></span>
	</div>
	<!-- END LOGO -->
    	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		
		<!-- END LOGIN FORM -->        
		<!-- BEGIN FORGOT PASSWORD FORM -->
		
		<!-- END FORGOT PASSWORD FORM -->
		<!-- BEGIN REGISTRATION FORM -->
		<form class="login-form" action="" method="post" enctype="multipart/form-data">
			<h3 >Sign Up</h3>
			<p>Enter your personal details below:</p>
            <?php if(isset($error)): ?>
            <div class="alert alert-danger ">
				<button class="close" data-close="alert"></button>
				<span><?php echo $error; ?></span>
			</div>
            <?php endif; ?>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Full Name</label>
				<div class="input-icon">
					<i class="fa fa-font"></i>
					<input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="fullname" required/>
				</div>
			</div>
			<div class="form-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Email</label>
				<div class="input-icon">
					<i class="fa fa-envelope"></i>
					<input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" required/>
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Country</label>
				<select name="country"  class="select2 form-control">
                
					 <?php 
					$result = mysql_query("SELECT * FROM countries");
					while($cat_row		=		mysql_fetch_array($result))	{
	?>
   				 <option value="<?php echo $cat_row['ccode']; ?>"><?php echo $cat_row['country'];?></option>
    
    <?php } ?>
				</select>
			</div>
			<p>Enter your account details below:</p>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Username</label>
				<div class="input-icon">
					<i class="fa fa-user"></i>
					<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<div class="input-icon">
					<i class="fa fa-lock"></i>
					<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
				<div class="controls">
					<div class="input-icon">
						<i class="fa fa-check"></i>
						<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" required/>
					</div>
				</div>
			</div>
			<div class="form-group">
										<label for="exampleInputFile1">Select Picture</label>
										<input type="file" id="exampleInputFile1" name="files">
										
									</div>
			<div class="form-actions">
				
				<button type="submit" id="register-submit-btn" name="submit" class="btn green pull-right">
				Sign Up <i class="m-icon-swapright m-icon-white"></i>
				</button>        
                    
			</div>
           
                <a style="width:100%;" href="?type=facebook" class="btn blue"><i class="fa fa-facebook"></i>&nbsp;&nbsp;Sign Up Via Facebook</a>
		</form>
		<!-- END REGISTRATION FORM -->
	</div>
        
        <!-- BEGIN COPYRIGHT -->
	<div class="copyright">
		2014 &copy; Amazone Seller Tool. Admin Dashboard Template.
	</div>
	<!-- END COPYRIGHT -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   
	<!--[if lt IE 9]>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/respond.min.js"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/excanvas.min.js"></script> 
	<![endif]-->   
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>	
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/select2/select2.min.js"></script>     
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo THEME_BASE; ?>metronic/scripts/app.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/scripts/login.js" type="text/javascript"></script> 
	<!-- END PAGE LEVEL SCRIPTS --> 
	<script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>