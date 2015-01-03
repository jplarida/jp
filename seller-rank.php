<?php 
require_once('includes/lib/includes.php'); 

if(isset($_GET['cmd']) && $_GET['cmd'] == "del")	{
	$id			=	$_GET['id'];
	$sql_obj->Query("DELETE FROM super_url WHERE id = '$id'");
	$sql_obj->Query("DELETE FROM click_details WHERE click_id = '$id'");
	$sql_obj->Query("DELETE FROM super_url_detail WHERE super_url_id = '$id'");
	
	$msg				=		"Super URL deleted sucessfully."; 
}




if(isset($_POST['submit'])) {
	
	$date 			 =   	 date('Y-m-d');
  	$keywords   	 =       mysql_real_escape_string($_POST['keywords']);
  	$product_id		 =       mysql_real_escape_string($_POST['product_id']);
    
	$marchent_id	 =       mysql_real_escape_string($_POST['marchent_id']);
	$tag	     	 =       mysql_real_escape_string($_POST['tag']);
	$note	     	 =       mysql_real_escape_string($_POST['note']);
	
	$key_array		 =		explode(",",$keywords);
	
	
	
		$sql_obj->Query("INSERT INTO seller_rank (
						user_id, date_time, product_id,note) VALUES 
						('".$_SESSION['user_id']."', '$date', 
						'$product_id',  '$note')");
		$msg				=		"Seller rank is sucessfully.";
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
        <h3 class="page-title"> Best Seller Rank </h3>
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
          <li> <a href="#">Seller Rank</a> </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
      <div class="col-md-12"> <a style="margin-bottom:10px;"  class="btn green" href="#form_modal100" data-toggle="modal"> <i class="fa fa-plus"></i> Add Seller Rank </a>
        
        <?php if(isset($_GET['msg'])){ $msg = $_GET['msg']; } 
		if(isset($msg)){ getSucessMessage($msg); } 
		if(isset($not)){ getErrorMessage($not); } 
		 ?>
        <div class="tabbable tabbable-custom boxless">
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <div class="portlet box blue">
                <div class="portlet-title">
                  <div class="caption"><i class="fa fa-link"></i>Seller Rank Listing</div>
                  <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                </div>
                <div class="portlet-body flip-scroll">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                      <tr>
                        <th>Product</th>
                        <th>Note</th>
                        <th>Last Rank</th>
                        <th>Added Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
								 
								 function getLastSellerRank($id)	{
									 global $sql_obj;
									 $row	=	$sql_obj->QFetchArray("SELECT seller_rank FROM seller_rank_detail WHERE seller_rank_id = '$id' ORDER BY date_time DESC LIMIT 1");
									 return $row['seller_rank'];
								 }
		 $query 		=	mysql_query("SELECT sr.*,p.asin ,p.name as pname FROM seller_rank sr, products p WHERE sr.user_id = '".$_SESSION['user_id']."' AND sr.product_id = p.id ");		
		 if(mysql_num_rows($query) > 0){
		  $i						=	1;
  while($row		=	mysql_fetch_array($query))	{

	  ?>
                      <tr class="odd" id="s<?php echo $row['id']; ?>">
                        <td><a href="#form_modal<?php echo $row['id']; ?>"  data-toggle="modal" >> <strong><?php echo $row['pname']; ?></strong></a></td>
                       <td><?php echo $row['note']; ?></td>
                       <td style="color:#900; "><a href="http://www.amazon.com/gp/product/B00EEOGIWC/<?php echo $row['asin']; ?>" target="_blank"><?php echo getLastSellerRank($row['id']); ?></a></td>
                       
                       <td><?php echo $row['date_time']; ?></td>
        
                   
                        <td>
                     
                                <a onClick="deleteRecord('s<?php echo $row['id']; ?>','<?php echo $row['id']; ?>','seller_rank','<td colspan=4>Seller rank is deleted sucessfully</td>');" href="javascript:void(0);" ><span class="label label-sm label-info">Delete</span></a>
                                
                       </td>
                      </tr>
                      <?php include('includes/subpages/seller-rank-chart.php'); ?>

                      <?php }?>
                    </tbody>
                    <?php }else {
						
						 ?>
                    <tr>
                      <th colspan="7"><?php echo "Sorry! Your have not any record. :("; ?> </th>
                    </tr>
                    <?php } ?>
                    <tr>
                      
                    </tr>
                  </table>
                </div>
              </div>
              <br style="clear:both">
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
<div id="form_modal100" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Seller Rank</h4>
              </div>
              <form onSubmit="return addSellerRank('add','0');"  class="form-horizontal" role="form" method="post" action="">
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
                    <label class="control-label col-md-4">Note:</label>
                    <div class="col-md-8"> 
                      <textarea   class="form-control" name="note"  placeholder="Note"></textarea>
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
<?php if(isset($_GET['id']) && $_GET['cmd'] == "edit"): 
$su_row		=	$sql_obj->QFetchArray("SELECT * FROM super_url WHERE id = '".$_GET['id']."'");
?>
<a href="#form_modale" data-toggle="modal"></a>
<div id="form_modale" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Super Url</h4>
              </div>
              <form onSubmit="return addSuperUrl('edit','<?php echo $su_row['id']?>');"  class="form-horizontal" role="form" method="post" action="">
              <div class="modal-body">
                <div class="form-group">
                        <label class="control-label col-md-4">Destination Product</label>
                        <div class="col-md-8">
                          <select  class="form-control" data-placeholder="Select..." name="product_id" id="eproduct_id">
     
                            <?php echo getProductDropDown($su_row['product_id']); ?>
                          </select>
                        </div>
                      </div>
                    
                  <div class="form-group">
                    <label class="control-label col-md-4">Keywords</label>
                    <div class="col-md-8">
                      <input required type="hidden" id="select2_sample_modal_5" class="form-control select2" value="<?php echo getSuperUrlKeyword($su_row['id']); ?>" name="keywords">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-4">Marchant ID:</label>
                    <div class="col-md-8"> 
                      <input  type="text" class="form-control" name="marchent_id" value="<?php echo $su_row['marchent_id']; ?>"  placeholder="Marchant ID">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Associative Tag:</label>
                    <div class="col-md-8"> 
                      <input type="text"  class="form-control" name="tag"  placeholder="Associative Tag" value="<?php echo $su_row['associative_tag']; ?>"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-4">Note:</label>
                    <div class="col-md-8"> 
                      <textarea required  class="form-control" name="note"  placeholder="Note"><?php echo $su_row['note']; ?></textarea>
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
                <button class="btn green" name="update" type="submit">Update</button>
              </div>
             </form>
            </div>
          </div>
        </div>
<?php endif; ?>

<?php require_once('includes/subpages/footer.php'); ?>
