<?php require_once('includes/lib/includes.php'); 



if(isset($_POST['submit'])) {
	
  $amazone_email      		=       mysql_real_escape_string($_POST['amazone_email']);
  $amazone_password   		=       mysql_real_escape_string($_POST['amazone_password']);
  $amazone_server      	  	=       mysql_real_escape_string($_POST['amazone_server']);
  $marketplace_seller_id    =       mysql_real_escape_string($_POST['marketplace_seller_id']);
  $marketplace_id    		=       mysql_real_escape_string($_POST['marketplace_id']);
  
  
  $aws_access_key    		=       mysql_real_escape_string($_POST['aws_access_key']);
  $aws_secret_key    		=       mysql_real_escape_string($_POST['aws_secret_key']);
  
  $sql_obj->Query("update setting set 
 				 	amazone_email 			= 	'$amazone_email',
  					amazone_password 		= 	'$amazone_password',
					amazone_server 			= 	'$amazone_server',
					marketplace_seller_id 	= 	'$marketplace_seller_id',
  					marketplace_id 			= 	'$marketplace_id',
					aws_access_key 			= 	'$aws_access_key',
					aws_secret_key 			= 	'$aws_secret_key'
					where user_id = '".$_SESSION['user_id']."'");
	
  //SUCESS MESSAGE
  $msg =  "Setting is updated sucessfully. :)";

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
        <h3 class="page-title"> Settings </h3>
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
          <li> <a href="#">Settings</a> </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
      <div class="col-md-12">
        <?php if(isset($msg)){ getSucessMessage($msg); }  ?>
        <!-- <div class="tabbable tabbable-custom boxless">
         <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_0" data-toggle="tab">Settings</a></li>
            
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_0">-->
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption"><i class="fa fa-cogs"></i>Settings</div>
            <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
          </div>
          <div class="portlet-body form"> 
            <!-- BEGIN FORM-->
            <?php  $setting	=	$sql_obj->QFetchArray("SELECT * FROM setting where user_id = '".$_SESSION['user_id']."' LIMIT 1");  ?>
            <form action="#" class="form-horizontal" method="post" runat="server">
              <div class="form-body">
                <h4 class="form-section">Amazone Credentials</h4>
                <div class="form-group">
                  <label class="col-md-3 control-label">Email:</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php echo $setting['amazone_email'] ?>"  name="amazone_email" placeholder="Email" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Password</label>
                  <div class="col-md-6">
                    <div class="input-group">
                      <input type="password" class="form-control" placeholder="Password" name="amazone_password" value="<?php echo $setting['amazone_password'] ?>">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label col-md-3">Service Location</label>
                  <div class="col-md-6">
                    <select name="amazone_server"  class="form-control input-large select2me" data-placeholder="Select...">
                      <?php 
					  $server_row		=	$sql_obj->QFetchRowArray("SELECT id,name FROM servers");
					  if(is_array($server_row))	{
						  foreach($server_row as $key=>$row)	{
							  echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
						  }
					  }
					  ?>
                    </select>
                   </div>
                </div>
                <h4 class="form-section">Marketplace WebService Credentials</h4>
                <div class="form-group">
                  <label class="col-md-3 control-label">Seller ID:</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php echo $setting['marketplace_seller_id'] ?>"  name="marketplace_seller_id" placeholder="Marketplace Seller ID" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Marketplace ID:</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php echo $setting['marketplace_id'] ?>"  name="marketplace_id" placeholder="Marketplace ID" >
                  </div>
                </div>
                <div class="form-group">
                  
                                <label class="col-md-3 control-label"></label>
                  <div class="col-md-6">
                   <div class="clearfix margin-top-10">
									<span class="label label-success">NOTE:</span>&nbsp;
									To get the Marketplace WebService Credentials <a target="_blank" href="https://sellercentral.amazon.com/gp/mws/index.html">click here</a>
								</div>
                  </div>
                </div>
                <h4 class="form-section">Amazon WebServices Credentials</h4>
                <div class="form-group">
                  <label class="col-md-3 control-label">AWS AccessKey ID:</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php echo $setting['aws_access_key'] ?>"  name="aws_access_key" placeholder="AWS AccessKey ID" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">AWS Secret Key:</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php echo $setting['aws_secret_key'] ?>"  name="aws_secret_key" placeholder="AWS Secret Key" >
                  </div>
                </div>
                <div class="form-group">
                  
                                <label class="col-md-3 control-label"></label>
                  <div class="col-md-6">
                   <div class="clearfix margin-top-10">
									<span class="label label-success">NOTE:</span>&nbsp;
									To get the Amazon WebServices <a target="_blank" href="http://aws.amazon.com/">click here</a>
								</div>
                  </div>
                </div>
              </div>
              
              <div class="form-actions right">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" name="submit" class="btn blue">Update</button>
                  <button type="button" class="btn default">Cancel</button>
                </div>
              </div>
            </form>
            <!-- END FORM--> 
          </div>
        </div>
        
        <!--  </div>
        </div>
      </div>--> 
      </div>
      <!-- END PAGE CONTENT--> 
    </div>
    <!-- END PAGE --> 
  </div>
</div>
<?php require_once('includes/subpages/footer.php'); ?>
