<?php 
require_once('includes/lib/includes.php');
function getDateDifference($date1, $date2, $flag="hours")	{
	$diff 	= abs(strtotime($date2) - strtotime($date1));
	$years 	= floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days 	= floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	if($flag=="years")	{
		return $years;
	}
	if($flag=="months")	{
		return $months;
	}
	if($flag=="days")	{
		return $days;
	}
	if($flag=="hours")	{
		return round((strtotime($date2) - strtotime($date1))/3600, 1);
	}
	

}
function checkToken()	{
	global $sql_obj;
	$msg		=	"";
	if(isset($_GET['resetToken']))	{
		$token_row	=	$sql_obj->QFetchArray("SELECT id,token_time FROM users WHERE resetToken = '".$_GET['resetToken']."' LIMIT 1");
		$hours	=	getDateDifference($token_row['token_time'], date('Y-m-d H:i:s'));
		if(is_array($token_row))	{
			if($hours < 1)	{
				return false;
			}else {
				$msg	=	"It looks like this password reset link can't be used anymore. This probably means that you sent us another password reset request; in that case you'll need to use the newer reset link.";
			}
			
		}else {
				$msg	=	"It looks like this password reset link can't be used anymore. This probably means that you sent us another password reset request; in that case you'll need to use the newer reset link.";
		}
	}
	return $msg;
}

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<title>Reset Password | Seller Tools</title>
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
<link rel="stylesheet" type="text/css" href="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-fileupload/bootstrap-fileupload.css" />

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo"> <span style="font-size: 22px;
color: #fff;">Amazone <span style="font-size: 22px;
color: #F00;">Seller</span></span> </div>
<!-- END LOGO --> 
<!-- BEGIN LOGIN -->
<div class="content" id="login-form-wrapper"> 
  <!-- BEGIN LOGIN FORM -->
  <form class="recover-password-form" action="" method="post"  style="display:block;" onSubmit="retunr passwordReset();">

    <h3 >Reset Password</h3>
    <?php 
	$check	=	checkToken();
	if($check == false): ?>
    <p>Enter your your new password below:</p>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">Password</label>
      <div class="input-icon"> <i class="fa fa-lock"></i>
        <input  class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="New Password" name="password"/>
        
      </div>
    </div>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
      <div class="controls">
        <div class="input-icon"> <i class="fa fa-check"></i>
          <input  class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
          <input type="hidden"  name="resetToken" value="<?php if(isset($_GET['resetToken'])) echo $_GET['resetToken']; ?>"/>
        </div>
      </div>
    </div>
    <div class="form-actions">
      <button type="submit"  name="signup" id="reset-password-btn" class="btn green pull-right"> Update Password <i class="m-icon-swapright m-icon-white"></i> </button>
    </div>
    <?php else: ?>
    <p><?php echo $check;  ?></p>
    <?php endif; ?>
  </form>
  <!-- END LOGIN FORM --> 
  <!-- BEGIN FORGOT PASSWORD FORM --> 
  
  <!-- END FORGOT PASSWORD FORM --> 
  <!-- BEGIN REGISTRATION FORM --> 
  
  <!-- END REGISTRATION FORM --> 
</div>
<!-- END LOGIN --> 
<!-- BEGIN COPYRIGHT -->
<div class="copyright"> <?php echo date("Y"); ?> &copy; Amazone Seller Tool. Admin Dashboard Template. </div>
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
<script src="<?php echo THEME_BASE; ?>metronic/scripts/form-components.js"></script> 
<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script> 

<!-- END PAGE LEVEL SCRIPTS --> 
<script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		  FormComponents.init();
		});
	</script> 
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
<script type="text/javascript">
var SITE_NAME				=	'<?php echo SITE_NAME ?>';
var SITE_URL				=	'<?php echo SITE_URL ?>';
var RANK_SITE_URL			=	'<?php echo RANK_SITE_URL ?>';
var USER_IMAGES				=	'<?php echo USER_IMAGES ?>';
var THEME_BASE				=	'<?php echo THEME_BASE ?>';
var INCLUDE_PATH			=	'<?php echo INCLUDE_PATH ?>';
</script>
<script type="text/javascript">
	function checkEmail(val)	{
		var edom	=	jQuery("#email");
		edom.val("checking...");
		edom.prop('disabled',true);
		$.ajax({
			  type: "POST",
			  cache: false,
			  data: {email: val},
			  url:"api/check-email.php",
			  dataType: "json",
			  success:function(response){
				  edom.val(val);
				  edom.prop('disabled',false);
				  if(response.flag != 0)	{
					 jQuery("#emessgage").html("Oops! This email alreay exist");
					 jQuery("#register-submit-btn").prop('disabled',true);
				  }else {
					  jQuery("#register-submit-btn").prop('disabled',false);
					  jQuery("#emessgage").html("");
				  }
				
			  }
		});
		
	}
function login()	{
	email			=	jQuery("#login_email").val();
	password		=	jQuery("#login_pass").val();
	jQuery("#login-btn").attr('value','Loging...');
	jQuery("#login-btn").prop('disabled',true);
	$.ajax({
		  type: "POST",
		  cache: false,
		  data: {email: email,password:password},
		  url:"api/login.php",
		  dataType: "json",
		  success:function(response){
			  jQuery("#login-btn").attr('value','Login');
			  jQuery("#login-btn").prop('disabled',false);
			  if(response.flag == 0)	{
				  jQuery(".login-form .alert span").html(response.msg);
				  jQuery(".login-form .alert").removeClass("display-hide");
				  shakeDiv("login-form-wrapper");
				 
			  }else {
				  window.location.href = "";
			  }
			
		  }
	});
	return false;
	
}
function shakeDiv(id) {
   var l = 20;  
   for( var i = 0; i < 10; i++ )   
   		jQuery("#"+id).animate( { 'margin-left': "+=" + ( l = -l ) + 'px' }, 75	
		);  
}
function forgotPassowrd()	{
	var edom	=	jQuery(".forgot-email");
	val 		=	edom.val();
	if(val == "")	{
		return;
	}
	jQuery("#forgot-msg").html("");
	edom.val("checking...");
	edom.prop('disabled',true);
	
	$.ajax({
		  type: "POST",
		  cache: false,
		  data: {email: val},
		  url:"api/forgot-passowrd.php",
		  dataType: "json",
		  success:function(response){
			  edom.val(val);
			  edom.prop('disabled',false);
			  if(response.flag == 0)	{
				 shakeDiv("login-form-wrapper");
				 jQuery("#forgot-msg").show();
				 jQuery("#forgot-msg").html(response.msg);
			  }else {
				  jQuery(".forget-form").html('<h3>Eamail Sent</h3><p>We have emailed the password recover email at your provided email adress.<br/>Please check your email.</p>');
			  }
			
		  }
	});
	console.log("forgot pass");
	return false;
}
function passwordReset()	{
	var datastring 	= 	$(".recover-password-form").serialize();
	var edom		=	jQuery("#reset-password-btn");
	
	edom.html("Resetting...");
	$.ajax({
		  type: "GET",
		  cache: false,
		  //data: {email: val},
		  url:"api/reset-passowrd.php?"+datastring,
		  dataType: "json",
		  success:function(response){
			  edom.html("Update Password");
			  console.log(response);
			  if(response.flag == 1)	{
			  	jQuery(".recover-password-form").html(
				'<h3>Reset Password</h3><p>Congratulations! Your password has been successfully changed.<br/>Please click here <a href="'+SITE_URL+'">Login</a> to login your account.<br/><br/>Thanks,<br/>Seller Tool Team</p>'
				);
			  }
		  }
	});
	return false;
}
</script>