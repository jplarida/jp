<?php require_once('includes/lib/includes.php'); 

if(isset($_POST['submit'])) {
	$fullname     	=  		mysql_real_escape_string($_POST['name']);
	$email     		=  		mysql_real_escape_string($_POST['email']);
	$username      	=  		mysql_real_escape_string(trim($_POST['user_name']));
	$country      	=  		mysql_real_escape_string($_POST['country']);
	$password     	=  		mysql_real_escape_string(trim($_POST['password']));
	
	if($_FILES['files']['size'] > 0){
		$files        =      ImageUplloadResize("files",200,200,'user-images/');
		$sql_obj->Query("UPDATE users SET name = '$fullname', email = '$email', user_name = '$username', password = '$password',country='$country', image= '$files' WHERE id = '".$_SESSION['user_id']."'");
	}else {
		$sql_obj->Query("UPDATE users SET name = '$fullname', email = '$email', user_name = '$username', password = '$password',country='$country' WHERE id = '".$_SESSION['user_id']."'");
	}
	$msg	=		":( Profile is updated sucessfully!";
}

?>
<?php require_once('includes/subpages/header.php'); ?>
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar navbar-collapse collapse"> 
  <!-- BEGIN SIDEBAR MENU -->
  <?php require_once('includes/subpages/sidebar.php'); ?>
  
  <!-- END SIDEBAR MENU --> 
</div>
<!-- END SIDEBAR --> 
<!-- BEGIN PAGE -->
<div class="page-content"> 
  <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
  <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body"> Widget settings form goes here </div>
        <div class="modal-footer">
          <button type="button" class="btn blue">Save changes</button>
          <button type="button" class="btn default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
  <!-- /.modal --> 
  <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM--> 
  <!-- BEGIN STYLE CUSTOMIZER -->
  <?php require_once('includes/subpages/theme-style.php'); ?>
  
  <!-- END BEGIN STYLE CUSTOMIZER --> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row">
    <div class="col-md-12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title">Manage Profile</h3>
      <ul class="page-breadcrumb breadcrumb">
        <!--<li class="btn-group">
            <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> <span>Actions</span> <i class="fa fa-angle-down"></i> </button>
            <ul class="dropdown-menu pull-right" role="menu">
              <li><a href="?cmd=refresh&page=feedbacks">Refresh</a></li>
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </li>-->
        <li> <i class="fa fa-home"></i> <a href="index.php">Home</a> <i class="fa fa-angle-right"></i> </li>
        <li> <a href="#">Profile Setting</a> </li>
      </ul>
      <!-- END PAGE TITLE & BREADCRUMB--> 
    </div>
  </div>
  <?php if(isset($msg)){ getSucessMessage($msg); }  ?>
 
  <!-- END PAGE HEADER--> 
  <!-- BEGIN PAGE CONTENT-->
  <div class="row">
    <div class="col-md-12">
      <?php if(isset($_GET['msg'])){ getSucessMessage($_GET['msg']); }  ?>
      <div class="tabbable tabbable-custom boxless"> 
        <!--<ul class="nav nav-tabs">
            <li class="active"><a href="#tab_0" data-toggle="tab">Change Admin Password</a></li>
            
          </ul>-->
        <div class="tab-content">
          <div class="tab-pane active" id="tab_0">
            <div class="portlet box green">
              <div class="portlet-title">
                <div class="caption"><i class="fa fa-reorder"></i>Manage Your Profile Information</div>
                <div class="tools"> <a href="javascript:;" class="collapse"></a> 
                  <!--<a href="#portlet-config" data-toggle="modal" class="config"></a>
											<a href="javascript:;" class="reload"></a>
											<a href="javascript:;" class="remove"></a>--> 
                </div>
              </div>
              <div class="portlet-body form">
                <?php 
			 $user_row	=	 $sql_obj->QFetchArray("SELECT * FROM users WHERE id = '".$_SESSION['user_id']."'");
			  ?>
                <!-- BEGIN FORM-->
                <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
                  <div class="form-body">
                    <div class="form-group">
                      <label class="col-md-3 control-label">Fullname</label>
                      <div class="col-md-4">
                        <div class="input-icon"> <i class="fa fa-user"></i>
                          <input value="<?php echo $user_row['name'];?>" type="text" class="form-control" name="name" >
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Email</label>
                      <div class="col-md-4">
                        <div class="input-icon"> <i class="fa fa-envelope-o"></i>
                          <input value="<?php echo $user_row['email'];?>" type="text" class="form-control" name="email" >
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3">Country</label>
                      <div class="col-md-4">
                        <select  class="form-control input-large select2me" data-placeholder="Select..." name="country">
                          <?php 
					$result = mysql_query("SELECT * FROM countries");
					while($cat_row		=		mysql_fetch_array($result))	{
						
	?>
                          <option <?php if($cat_row['ccode'] == $user_row['country']) echo "selected"; ?>  value="<?php echo $cat_row['ccode']; ?>"><?php echo $cat_row['country'];?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-md-3 control-label">Username</label>
                      <div class="col-md-4">
                        <div class="input-icon"> <i class="fa fa-user"></i>
                          <input readonly value="<?php echo $user_row['user_name'];?>" type="text" class="form-control" name="user_name" >
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Password</label>
                      <div class="col-md-4">
                        <div class="input-icon"> <i class="fa fa-key"></i>
                          <input  value="<?php echo $user_row['password'];?>" type="password" class="form-control" name="password" >
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Image</label>
                      <div class="col-md-4">
                        <div class="input-icon"> 
                         <input type="file" id="exampleInputFile1" name="files">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-actions fluid">
                    <div class="col-md-offset-3 col-md-9">
                      <button type="submit" name="submit" class="btn blue">Submit</button>
                    </div>
                  </div>
                </form>
                <!-- END FORM--> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END PAGE CONTENT--> 
  </div>
  <!-- END PAGE --> 
</div>
<?php require_once('includes/subpages/footer.php'); ?>
