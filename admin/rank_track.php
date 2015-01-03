<?php 
require_once('../includes/lib/includes.php');  

if(isset($_GET['id']))
{$id= $_GET['id'];}
 
if(isset($_GET['cmd']) && $_GET['cmd'] == "del")	{
	$id			=	$_GET['id'];
	$sql_obj->Query("DELETE FROM rank_tracker WHERE id = '$id'");
	$sql_obj->Query("DELETE FROM rank_tracker_keywords WHERE rank_tracker_id = '$id'");
	$msg	=	"Rank Tracker is deleted sucessfully :)";
}
if(isset($_GET['cmd']) && $_GET['cmd'] == "keydel")	{
	$id			=	$_GET['id'];
	$sql_obj->Query("DELETE FROM rank_tracker_keywords WHERE id = '$id'");
	$msg	=	"Keyword is deleted sucessfully :)";
}
if(isset($_POST['submit'])) {
	
  	$keywords   	 =       mysql_real_escape_string(str_replace(" ","+",$_POST['keywords']));
  	$product_id		 =       mysql_real_escape_string($_POST['product_id']);	
	$key_array		 =		 explode(",",$keywords);
	$date 			 = 		date('Y-m-d H:i:s');
	
	
			
	$sql_obj->Query("insert into  	
					rank_tracker(user_id,product_id,date_time)
					values(
					'".$_SESSION['user_id']."','$product_id','$date')");
	$last_id		=		$sql_obj->InsertID();
	
	//INSERT KEYWORD
	 for($i	=	0; $i<count($key_array); $i++)	{
		$sql_obj->Query("INSERT INTO rank_tracker_keywords (rank_tracker_id, keyword) VALUES ('$last_id', '".$key_array[$i]."')");
	 }

	$msg				=		"Rank Tracker is added sucessfully.";
	 
 
}

if(isset($_POST['add_keyword'])) {
	
  	$keywords   	 =       mysql_real_escape_string(str_replace(" ","+",$_POST['keywords']));
	$key_array		 =		 explode(",",$keywords);

	 for($i	=	0; $i<count($key_array); $i++)	{
		 
		 $count	=	$sql_obj->RowCount("rank_tracker_keywords","WHERE keyword = '".$key_array[$i]."' AND rank_tracker_id = '".$_GET['id']."'");
		
		 if($count == 0)	{
			 
			$sql_obj->Query("INSERT INTO rank_tracker_keywords (rank_tracker_id, keyword) VALUES ('".$_GET['id']."', '".$key_array[$i]."')");
		 }
	 }
	goUrl("rank-tracker.php?msg=Keyword is added sucessfully.");

	 
 
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
        <h3 class="page-title">Rank Tracker</h3>
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
          <li> <a href="#">Rank Tracker</a> </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
      <div class="col-md-12"> 
        
        <?php if(isset($_GET['msg'])){ $msg	=	($_GET['msg']); } 
		if(isset($msg)){ getSucessMessage($msg); } 
		if(isset($not)){ getErrorMessage($not); } 
		 ?>
         
        <div class="tabbable tabbable-custom boxless">
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <div class="portlet box blue">
                <div class="portlet-title">
                  <div class="caption"><i class="fa fa-link"></i>Rank Listing</div>
                  <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                </div>
                <div class="portlet-body flip-scroll">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                      <tr>
                        <th>Product</th>
                       
                        <th>Added</th>
                       <!-- <th>Top Keyword</th>
                        <th>Last Update</th>-->
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
								 
		 $rank_row 		=	$sql_obj->QFetchRowArray("SELECT rt.* FROM rank_tracker rt
          WHERE rt.user_id = $id ");		
		 if(is_array($rank_row)){
			 foreach($rank_row as $key=>$row)	{

	  ?>
                      <tr  class="odd" id="s<?php echo $row['id']; ?>">
                      <td><a onClick="showRankDetails('ra_<?php echo $row['id'] ?>');" href="javascript:void(0)"><strong>> <?php echo getProductName($row['product_id']);  ?></strong></a></td>
                      
                        
                        <td><?php echo ago(strtotime($row['date_time'])); ?></td>
                      </tr>
                      <?php include('includes/subpages/rank_tracker_detail.php'); ?>
                      
                      
                      <?php }?>
                    </tbody>
                    <?php }else {
						
						 ?>
                    <tr>
                      <th colspan="7"><?php echo "Sorry! No record found. :("; ?> </th>
                    </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div>
            <?php  if(isset($_GET['id'])){ ?>
            <div class="tab-pane" id="tab_2">
              <div class="portlet box purple">
                <div class="portlet-title">
                  <div class="caption"><i class="fa fa-reorder"></i>Clicks</div>
                  <div class="tools"> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> </div>
                </div>
                <div class="portlet-body">
                  <div id="cont_surl" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
              </div>
            </div><br style="clear:both;" /><br/><br/><br/>
            <?php } ?>
          </div><br style="clear:both;" /><br/><br/><br/>
        </div>
        <br style="clear:both;" /><br/><br/><br/>
      </div>
       <br style="clear:both;" /><br/><br/><br/>
      <!-- END PAGE CONTENT--> 
    </div>
    
    
    
    <!-- END PAGE --> 
  </div>
</div>
<?php require_once('includes/subpages/footer.php'); ?>
<div id="form_modala01" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Rank Tracker</h4>
              </div>
                 <form  class="form-horizontal" onSubmit="return addRankTracker('add','0');" role="form" method="post" action="">
                    <div class="modal-body">
                      <div class="form-group">
                        <label class="control-label col-md-4">Destination Product</label>
                        <div class="col-md-6">
                          <select  class="form-control input-large select2me" data-placeholder="Select..." name="product_id" id="product_id">
                           
                            <?php echo getProductDropDown(); ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                    <label class="control-label col-md-4">Keywords</label>
                    <div class="col-md-8">
                      <input required type="hidden" id="select2_sample5" class="form-control select2" value="ipad, headphone" name="keywords">
                    </div>
                  </div>
                  <div class="form-group">
            <label class="control-label col-md-4"></label>
            <div class="col-md-8">
             <span id="errorr" class="alert-danger" style="background:none;"></span>
            </div>
          </div>
                    </div>
                    <div class="modal-footer">
                <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn green" name="submit" type="submit">Save changes</button>
              </div>
                  </form>
              
              
            </div>
          </div>
        </div>
<?php if(isset($_GET['id']) && $_GET['cmd'] == "addkey"):  ?>
<a href="#form_modale" data-toggle="modal"></a>
<div id="form_modale" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add More Keyword</h4>
              </div>
              <form onSubmit="return addRankTracker('edit','<?php echo $rt_row['id']?>');"  class="form-horizontal" role="form" method="post" action="">
              <div class="modal-body">
                
                    
                  <div class="form-group">
                    <label class="control-label col-md-4">Keywords</label>
                    <div class="col-md-8">
                      <input required type="hidden" id="select2_sample_modal_5" class="form-control select2" value="" name="keywords">
                    </div>
                  </div>
                  
                  
                  
                  
                  <div class="form-group">
            <label class="control-label col-md-4"></label>
            <div class="col-md-8">
             <span id="edit-errorr" class="alert-danger" style="background:none;"></span>
            </div>
          </div>
                
              </div>
              <div class="modal-footer">
                <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn green" name="add_keyword" type="submit">Add Keyword</button>
              </div>
             </form>
            </div>
          </div>
        </div>
<?php endif; ?>
