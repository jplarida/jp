<?php require_once('includes/lib/includes.php'); ?>
<?php 
if(isset($_GET['cmd']) && $_GET['cmd'] == "refresh")	{

	$sql_obj->Query("DELETE FROM feedbacks where user_id = '".$_SESSION['user_id']."'");
	$amazone_obj->feedFeedbacks($scrap_url);
	goUrl("feedbacks.php?msg=Feedbacks are refresh now!");
}




if(isset($_GET['cmd']) && $_GET['cmd'] == "response")	{
	if($amazone_obj->response(urldecode($_GET['val']),$setting['response']) == "")	{
		goUrl("feedbacks.php?msg=Response is submitted sucessfully!");
	}else {
		goUrl("feedbacks.php?msg=:( Un able to submit the response.");
	}
	$sql_obj->Query("UPDATE feedbacks SET is_responed = 1 WHERE response_url = '".urldecode($_GET['val'])."' and user_id = '".$_SESSION['user_id']."'");
}


if(isset($_POST['respond_submit'])){


	$respond_1_2            =     mysql_real_escape_string($_POST['respond_1_2']); 
	$respond_3              =     mysql_real_escape_string($_POST['respond_3']); 
	$respond_4_5            =     mysql_real_escape_string($_POST['respond_4_5']); 
	$respond_1_2_message    =     mysql_real_escape_string($_POST['respond_1_2_message']); 
	$respond_3_message      =     mysql_real_escape_string($_POST['respond_3_message']); 
	$respond_4_5_message    =     mysql_real_escape_string($_POST['respond_4_5_message']);
	
	if($sql_obj->RowCount("respond_settings", "WHERE user_id = '".$_SESSION['user_id']."' " ) == '0')	{
		
		$sql_obj->Query("insert into respond_settings(respond_1_2,respond_1_2_message,respond_3,respond_3_message,respond_4_5,respond_4_5_message,user_id)values('$respond_1_2','$respond_1_2_message','$respond_3','$respond_3_message','$respond_4_5','$respond_4_5_message','".$_SESSION['user_id']."')");
		
		goUrl("feedbacks.php?msg=:( Setting is saved sucessfully.#tab_1");
	}else{
		 
	$sql_obj->Query("update  respond_settings SET respond_1_2  =  '$respond_1_2 ' , respond_1_2_message = '$respond_1_2_message',respond_3 ='$respond_3',respond_3_message='$respond_3_message', respond_4_5 = '$respond_4_5', respond_4_5_message =  '$respond_4_5_message' where user_id = '".$_SESSION['user_id']."' ");
	
	goUrl("feedbacks.php?msg=:( Setting is saved sucessfully.#tab_1");
	}

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
        <h3 class="page-title"> Customer's Feedbacks <small>Feedback Tool</small> </h3>
        <ul class="page-breadcrumb breadcrumb">
          <li class="btn-group">
            <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> <span>Actions</span> <i class="fa fa-angle-down"></i> </button>
             <?php if(isSettings($_SESSION['user_id']) == 1){ ?>
            <ul class="dropdown-menu pull-right" role="menu">
          <li>
         
          <a href="?cmd=refresh&page=feedbacks">Refresh</a></li>
          
              <!--<li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>-->
            </ul>
            <?php } ?>
          </li>
          <li> <i class="fa fa-home"></i> <a href="index.php">Home</a> <i class="fa fa-angle-right"></i> </li>
          <li> <a href="#">Feedbacks</a> </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
      <div class="col-md-12">
        <?php if(isset($_GET['msg'])){ getSucessMessage($_GET['msg']); } 
		
		if(isSettings($_SESSION['user_id']) == 0){
		 ?>
        
        <div class="note note-danger" style="height: 45px; padding-top: 5px;">
								<h4 class="block">Please do gernal setting first! <a href="setting.php">go here</a></h4>
								
							</div>
                            <?php } ?>
        
        <div class="tabbable tabbable-custom boxless">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_0" data-toggle="tab">Feedbacks</a></li>
            <li><a href="#tab_1" data-toggle="tab">Setting</a></li>
            <li><a href="#tab_2" data-toggle="tab">Performance</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_0">
              <div class="portlet box green">
                <div class="portlet-title">
                  <div class="caption"><i class="fa fa-comment-o"></i>Customer's Feedbacks</div>
                  <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                </div>
                <div class="portlet-body flip-scroll">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                      <tr>
                        <th>Date</th>
                        <th>Rating</th>
                        <th>Comments</th>
                        <th>Item as Described</th>
                        <th>Customer Service</th>
                        <th>Order ID</th>
                        <th>Rater Role</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
								 
		 $query 		=	mysql_query("SELECT * from feedbacks where user_id = '".$_SESSION['user_id']."'");	
		 if(mysql_num_rows($query) > 0){	
		 
		  $i						=	1;
  while($row		=	mysql_fetch_array($query))	{

	  ?>
                      <tr class="odd" id="s<?php echo $row['cat_id']; ?>">
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['rating']; ?></td>
                        <td><?php echo $row['comments']; ?></td>
                        <td><?php echo $row['item_described']; ?></td>
                        <td><?php echo $row['customer_service']; ?></td>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['rater_role']; ?></td>
                        <td ><?php if($row['is_responed'] == 1) : ?>
                          <span class="label label-success">Sumitted</span>
                          <?php else: ?>
                          <a href="?cmd=response&page=feedbacks&val=<?php echo urlencode($row['response_url']); ?>" class="btn mini blue">Response</a>
                          <?php endif; ?></td>
                      </tr>
                       <?php }?>
                    </tbody>
                    <?php }else {
						
						 ?>
                         <tr>
                        <th colspan="7"><?php echo "Sorry! Your have not feedback. :("; ?> </th>
                      </tr>
                 <?php } ?>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab_1">
              <div class="portlet box blue">
                <div class="portlet-title">
                  <div class="caption"><i class="fa fa-reorder"></i>Feedback Settings</div>
                  <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
                </div>
                <div class="portlet-body form"> 
                  <!-- BEGIN FORM-->
                  <?php  $query 		=	mysql_query("SELECT * from respond_settings where user_id = '".$_SESSION['user_id']."'");		
		            $row		=	mysql_fetch_array($query) ;
					
					
					function GetChecked($val,$status){
						
						if($val == $status ){
							
							echo "checked";
							
							}
							
								}
					
					?>
                  <form action="#" class="horizontal-form" method="post">
                    <div class="form-body"> <span>
                      <h4 class="form-section">Auto Respond to 1 or 2</h4>
                      <div class="row">
                        <div class="col-md-12 ">
                          <div class="form-group">
                            <label  class="">Activity</label>
                            <div class="radio-list">
                              <label>
                                <input type="radio" name="respond_1_2" <?php GetChecked($row['respond_1_2'],1) ?>  id="optionsRadios1"  value="1" >
                                On </label>
                              <label>
                                <input type="radio"  <?php GetChecked($row['respond_1_2'],0) ?> name="respond_1_2" id="optionsRadios2" value="0" >
                                off </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label >Textarea</label>
                            <textarea class="form-control" rows="3" name="respond_1_2_message"><?php echo $row['respond_1_2_message']  ?></textarea>
                          </div>
                        </div>
                      </div>
                      </span> <span>
                      <h4 class="form-section">Auto Respond to 3</h4>
                      <div class="row">
                        <div class="col-md-12 ">
                          <div class="form-group">
                            <label  class="">Activity</label>
                            <div class="radio-list">
                              <label>
                                <input type="radio" name="respond_3" id="optionsRadios1"  <?php GetChecked($row['respond_3'],1) ?> checked value="1" >
                                On </label>
                              <label>
                                <input type="radio"  <?php GetChecked($row['respond_3'],0) ?> name="respond_3" id="optionsRadios2" value="0" >
                                off </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label >Textarea</label>
                            <textarea class="form-control" rows="3" name="respond_3_message"><?php echo $row['respond_3_message']  ?></textarea>
                          </div>
                        </div>
                      </div>
                      </span> <span>
                      <h4 class="form-section">Auto Respond to 4 or 5</h4>
                      <div class="row">
                        <div class="col-md-12 ">
                          <div class="form-group">
                            <label  class="">Activity</label>
                            <div class="radio-list">
                              <label>
                                <input type="radio" name="respond_4_5"    id="optionsRadios1" checked value="1" >
                                On </label>
                              <label>
                                <input type="radio"  <?php GetChecked($row['respond_4_5'],0) ?> name="respond_4_5"  id="optionsRadios2" value="0" >
                                off </label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label >Textarea</label>
                            <textarea class="form-control" name="respond_4_5_message" rows="3"><?php echo $row['respond_4_5_message']; ?></textarea>
                          </div>
                        </div>
                      </div>
                      </span> </div>
                    <div class="form-actions right">
                      <button type="button" class="btn default">Cancel</button>
                      <button type="submit"  name="respond_submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
                    </div>
                  </form>
                  <!-- END FORM--> 
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab_2">
              <div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-reorder"></i>Feedbacks</div>
							<div class="tools">
								<a href="#portlet-config" data-toggle="modal" class="config"></a>
								<a href="javascript:;" class="reload"></a>
							</div>
						</div>
						<div class="portlet-body">
							<div id="fb_cont" style="min-width: 310px; height: 400px; max-width: 700px; margin: 0 auto"></div>

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
