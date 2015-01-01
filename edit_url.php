<?php require_once('includes/lib/includes.php'); 

 $query 		=	mysql_query("SELECT * from super_url where id = '".$_GET['uid']."' and user_id = '".$_SESSION['user_id']."'");		
  $query2		=	mysql_fetch_array($query);

if(isset($_POST['submit'])) {
	
	$date 				=   date('Y-m-d H:i:s');
  $keywords   	     =       mysql_real_escape_string($_POST['keywords']);
  $url			 	 =       mysql_real_escape_string($_POST['url']);
   $name		     =       mysql_real_escape_string($_POST['name']);
    $redirect	     =       mysql_real_escape_string($_POST['redirect']);

  $sql_obj->Query("update super_url set 
  name = '$name',
  keywords = '$keywords',
  redirect = '$redirect', 
  target_url = '$url', date_time = '$date' where id = '".$_GET['uid']."' and user_id = '".$_SESSION['user_id']."'
  ");
 
  goUrl("super-url.php?msg=:) Super URL Edit sucessfully.#tab_1");

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
        <h3 class="page-title">Edit Super URL  </h3>
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
          <li> <a href="#">Edit Super URL</a> </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
      <div class="col-md-12">
        <?php if(isset($_GET['msg'])){ getSucessMessage($_GET['msg']); }  ?>
        <div class="tabbable tabbable-custom boxless">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_0" data-toggle="tab">Edit Super URL</a></li>
        
            
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_0">
              <div class="portlet box green">
                <div class="portlet-title">
                  <div class="caption"><i class="fa fa-link"></i>Edit Super URL</div>
                  <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                </div>
                
                
                <div class="portlet-body flip-scroll">
                
                <div class="col-md-12">
                <div class="portlet-body form"> 
                      <!-- BEGIN FORM-->
                      <?php // $setting	=	$sql_obj->QFetchArray("SELECT * FROM setting LIMIT 1");  ?>
                      
                      <form action="" class="horizontal-form" method="post" runat="server">
								<div class="form-body">
                                
                                  <!-- <h3 class="form-section">Amazone Super URL</h3>-->
                                  
                                  <div class="form-group">
                      
                                    
										<label for="exampleInputEmail1">Name</label>
										<input  name="name" value="<?php echo $query2['name'] ?>"  placeholder="Name" class="form-control" id="name" />
									
									</div>
                                  
									<div class="form-group">
                      
                                   <label for="exampleInputEmail1">Keywords</label>
										<input name="keywords"  value="<?php echo $query2['keywords'] ?>"  placeholder="Keywords" class="form-control" id="keywords" />
									
									</div>
                                    
                                    
                                    <div class="form-group">
                      
                                   
										<label for="exampleInputEmail1">Redirect</label>
								  <?php echo SITE_URL; ?><input  value="<?php echo $query2['redirect'] ?>" name="redirect" type="text" class="form-control input-small" placeholder="Redirect">
									
									</div>
                                    
                                    
                                    
                                    <div class="form-group">
                      
                                    
										<label for="exampleInputEmail1">Destination URL</label>
										<input value="<?php echo $query2['target_url'] ?>"  name="url"  placeholder="Destination URL" class="form-control" id="url" />
									
									</div>
                                    
                                    		
								</div>
								
                                
                          <div class="row-fluid">
                           
                        
                            
                            
                          </div>
                          
                        <div class="form-actions">
									<button type="submit" name="submit" class="btn blue">Submit</button>
									<button type="button" class="btn default">Cancel</button>                              
								</div>        
							</form>
                      
                      
                      
                      
                      
                      
                      <!-- END FORM--> 
                    </div>
                    
                
                
                
                
                
                  
                </div>
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
<script type="text/javascript">



</script>