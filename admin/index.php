<?php 
require_once('../includes/lib/includes.php');
if(isset($_POST['login']))	{
	$username		=		$_POST['username'];
	$password		=		$_POST['password'];
	
	//$hash_pass		=		generateHash(trim($password));
	$user_row		=		mysql_query("SELECT * FROM admin WHERE username = '$username' and password = '$password'");
	$row			=		mysql_fetch_array($user_row);
	if(mysql_num_rows($user_row) != '0')	{
		$_SESSION['admin_id']		=		$user_row['id'];
		goUrl("users.php");
	}else {
		$msg	=		"Username or Password is invalid!";
	}
	
}
?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Amazone | Seller Tools | Admin</title>
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
	<link href="<?php echo THEME_BASE; ?>metronic/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo THEME_BASE; ?>metronic/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
	<!-- BEGIN LOGO -->
	<div class="logo">
		<span style="font-size: 22px;
color: #fff;">Amazone <span style="font-size: 22px;
color: #F00;">Seller</span></span>
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<form class="login-form" action="" method="post">
			<h3 class="form-title">Login to your account</h3>
			<div class="alert alert-danger display-hide">
				<button class="close" data-close="alert"></button>
				<span>Enter any username and password.</span>
			</div>
            <?php if(isset($msg)): ?>
            <div class="alert alert-danger display-hide">
				<button class="close" data-close="alert"></button>
				<span><?php echo $msg; ?></span>
			</div>
            <?php endif; ?>
			<div class="form-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Username</label>
				<div class="input-icon">
					<i class="fa fa-user"></i>
					<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<div class="input-icon">
					<i class="fa fa-lock"></i>
					<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
				</div>
			</div>
			<div class="form-actions">
				<label class="checkbox">
				<input type="checkbox" name="remember" value="1"/> Remember me
				</label>
				<button type="submit" name="login" class="btn blue pull-right">
				Login <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
			
			
		</form>
		<!-- END LOGIN FORM -->        
		
		
	</div>
	<!-- END LOGIN -->
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
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/select2/select2.min.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo THEME_BASE; ?>metronic/scripts/app.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/scripts/login-soft.js" type="text/javascript"></script>      
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