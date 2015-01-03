<?php require_once('../includes/lib/includes.php'); 



if(isset($_POST['submit'])) {
	
  $s_status    			=       mysql_real_escape_string($_POST['s_status']);
  $p_status   			=       mysql_real_escape_string($_POST['p_status']);
  $fb_status      	  	=       mysql_real_escape_string($_POST['fb_status']);
  $s_url_status    		=       mysql_real_escape_string($_POST['s_url_status']);
  $rt_status    		=       mysql_real_escape_string($_POST['rt_status']);
  $c_url_status    		=       mysql_real_escape_string($_POST['c_url_status']);
  $sr_status    		=       mysql_real_escape_string($_POST['sr_status']);
  $down_message    		=       mysql_real_escape_string($_POST['down_message']);

  
  $sql_obj->Query("update site_setting set 
 				 	active 			= 	$s_status,
					feed_back 		= 	$fb_status,
					super_url 		= 	$s_url_status,
					rank_track 		= 	$rt_status,
					canoni_url 		= 	$c_url_status,
					down_message	=	'$down_message',
					seller_rank 	= 	$sr_status
					WHERE id = 1");
  
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
            <?php  $setting	=	$sql_obj->QFetchArray("SELECT * FROM site_setting  LIMIT 1");  ?>
            <form action="#" class="form-horizontal" method="post" runat="server">
              <div class="form-body">
                <h4 class="form-section">Global Setting</h4>
                <div class="form-group">
                  <label class="col-md-3 control-label">Site Name:</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" value="<?php echo $setting['site_name'] ?>"  name="amazone_email" placeholder="Email" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Site Status:</label>
                  <div class="col-md-6">
                    <select name="s_status" class="form-control">
                      <option  value="1">Live</option>
                      <option 
                      <?php if($setting['active'] == "0") echo "selected"; ?>
                      value="0">Down</option>
                    </select>
                  </div>
                  </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Site Down Message:</label>
                  <div class="col-md-6">
                    
					<textarea class="form-control" name="down_message" rows="3"><?php echo $setting['down_message'] ?></textarea>
					
                  </div>
                  </div>
                <h4 class="form-section">Site Products:</h4>
                
                  <div class="form-group">
                  <label class="col-md-3 control-label">Feedbacks:</label>
                  <div class="col-md-6">
                    <select name="fb_status" class="form-control">
                      <option value="1">Enable</option>
                      <option
                      <?php if($setting['feed_back'] == "0") echo "selected"; ?>
                      value="0">Disable</option>
                    </select>
                  </div>
                  </div>
                  <div class="form-group">
                  <label class="col-md-3 control-label">Super URL:</label>
                  <div class="col-md-6">
                    <select name="s_url_status" class="form-control">
                      <option value="1">Enable</option>
                      <option
                      <?php if($setting['super_url'] == "0") echo "selected"; ?>
                      value="0">Disable</option>
                    </select>
                  </div>
                  </div>
                  <div class="form-group">
                  <label class="col-md-3 control-label">Rank Tracker:</label>
                  <div class="col-md-6">
                    <select name="rt_status" class="form-control">
                      <option value="1">Enable</option>
                      <option
                      <?php if($setting['rank_track'] == "0") echo "selected"; ?>
                      value="0">Disable</option>
                    </select>
                  </div>
                  </div>
                  <div class="form-group">
                  <label class="col-md-3 control-label">Canonical URL:</label>
                  <div class="col-md-6">
                    <select name="c_url_status"class="form-control">
                      <option value="1">Enable</option>
                      <option
                      <?php if($setting['canoni_url'] == "0") echo "selected"; ?>
                      value="0">Disable</option>
                    </select>
                  </div>
                  </div>
                  <div class="form-group">
                  <label class="col-md-3 control-label">Seller Rank:</label>
                  <div class="col-md-6">
                    <select name="sr_status" class="form-control">
                      <option value="1">Enable</option>
                      <option
                      <?php if($setting['seller_rank'] == "0") echo "selected"; ?>
                      value="0">Disable</option>
                    </select>
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
