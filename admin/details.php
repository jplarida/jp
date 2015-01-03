<?php 
require_once('../includes/lib/includes.php'); 

//ACTIVE QUERY
if(isset($_GET['id']))
{$id= $_GET['id'];}
if(isset($_GET['cmd']) && $_GET['cmd'] == "active")	{
	
	 $id			=	$_GET['id'];
	 $sql_obj->Query("UPDATE users SET active = '".$_GET['value']."'  WHERE id = '$id'");
	 $msg		=	"User is updated sucessfully.";
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
        <h3 class="page-title">User Details</h3>
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
          <li> <a href="#">User Details</a> </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
      <div class="col-md-12">
        <?php if(isset($_GET['msg'])){ $msg	=	$_GET['msg']; } 
		if(isset($msg)){ getSucessMessage($msg); } 
		if(isset($not)){ getErrorMessage($not); } 
		 ?>
        <div class="tabbable tabbable-custom boxless">
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <div class="portlet box blue">
                <div class="portlet-title">
                  <div class="caption"><i class="fa fa-link"></i>User Products</div>
                  <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                </div>
                <div class="portlet-body flip-scroll">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                    <!--<thead class="flip-content">
                      <tr>
                        <th>Product</th>
                       
                        <th>Added</th>
                        <th>Top Keyword</th>
                        <th>Last Update</th>
                        <th>Action</th>
                      </tr>
                    </thead>-->
                    <tbody>
                    
                    <tr class="odd" >
                      <td><a onClick="showRankDetails('pr_<?php echo $GET['id'] ?>');" href="javascript:void(0)"><strong> Products </strong></a></td>
                     
                      <?php include('includes/subpages/products.php'); ?>
                    </tr>
                     <tr  class="odd" >
                      <td><a onClick="showRankDetails('su_<?php echo $GET['id'] ?>');" href="javascript:void(0)">  <strong> Super URL </strong></a> </td>
                      <?php include('includes/subpages/super_url.php'); ?>
                     </tr>
                     <tr  class="odd" >
                      <td><a onClick="showRankDetails('ra_<?php echo $GET['id'] ?>');" href="javascript:void(0)">  <strong> Rank Tracker  </strong> </a></td>
                      <?php include('includes/subpages/rank_track.php'); ?>
                     </tr>
                     <tr  class="odd" >
                      <td><a onClick="showRankDetails('cu_<?php echo $GET['id'] ?>');" href="javascript:void(0)"> <strong> Canonical URL </strong></a> </td>
                     <?php include('includes/subpages/canonical_url.php'); ?>
                     </tr>
                     <tr  class="odd" >
                      <td><a onClick="showRankDetails('sr_<?php echo $GET['id'] ?>');" href="javascript:void(0)"> <strong> Seller Rank </strong></a> </td>
                      <?php include('includes/subpages/seller_rank.php'); ?>
                     </tr>
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
      
      <!-- END PAGE --> 
    </div>
  </div>
</div>
<div id="form_modal10" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Product</h4>
      </div>
      <form onSubmit="return addProducts();"  class="form-horizontal" role="form" method="post" action="">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-md-4">Product Name:</label>
            <div class="col-md-8">
              <input type="text" required class="form-control" name="name" id="pname"  placeholder="Product Nmae" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4">ASIN:</label>
            <div class="col-md-8">
              <input type="text" required class="form-control" name="asin" id="pasin"  placeholder="ASIN" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4">Status:</label>
            <div class="col-md-8">
              <select name="status" class="form-control" id="pstatus">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
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
          <button class="btn green"  name="submit" type="submit">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php if(isset($_GET['id']) && $_GET['cmd'] == "edit"): 
$pro_row	=	$sql_obj->QFetchArray("SELECT * FROM products WHERE id = '".$_GET['id']."'");
?>
<a href="#form_modale" data-toggle="modal"></a>
<div id="form_modale" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Prodcut</h4>
      </div>
      <form  class="form-horizontal" onSubmit="return addProducts('<?php echo $pro_row['id']; ?>');" role="form" method="post" action="">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-md-4">Product Name:</label>
            <div class="col-md-8">
              <input value="<?php echo $pro_row['name']; ?>" type="text" required class="form-control" name="name" id="epname"  placeholder="Product Nmae" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4">ASIN:</label>
            <div class="col-md-8">
              <input id="epasin" value="<?php echo $pro_row['asin']; ?>" type="text" required class="form-control" name="asin"  placeholder="ASIN" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4">Status:</label>
            <div class="col-md-8">
              <select name="status" class="form-control">
                <option <?php if( $pro_row['asin'] == "1") echo "selected"; ?> value="1">Active</option>
                <option <?php if( $pro_row['asin'] == "0") echo "selected"; ?> value="0">Inactive</option>
              </select>
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
          <button class="btn green" name="update" type="submit">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>
<?php require_once('includes/subpages/footer.php'); ?>
