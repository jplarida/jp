<?php 
require_once('includes/lib/includes.php'); 

if(isset($_POST['download']))	{
	
	global $sql_obj;
	$head		=	array('Title', 'ASIN', 'Cost Per Unit');
	$data 		= 	array();
	$pro_row	=	$sql_obj->QFetchRowArray("SELECT * from products where user_id = '".$_SESSION['user_id']."'");
	if(is_array($pro_row))	{
		foreach($pro_row as $key=>$row)	{
			$data[$key]	=	array($row['name'],$row['asin'],$row['cost_per_unit']);
		}
	}
	
	CSVOutput($head,$data,$_POST['file_name']);
	goUrl("test.php");
}
function getProductUrl($asin)	{
	global	$user_global;
	$asin 			=	trim($asin);
	$rl				=	$user_global['product_adress'];
	$url			=	$user_global['product_adress'].$asin;
	$html 			= 	file_get_html($url);
	foreach($html->find('link') as $element) 	{
		$link			=	$element->href;
		if(strpos($link, "dp/")== true){
			$refine_link	=	explode("/dp/",$link);
			$rl				=	 $refine_link[0].'/dp/';
		}
	}
	return  $rl;	
}
if(isset($_GET['cmd']) && $_GET['cmd'] == "superUrl")	{
	$date 				=   date('Y-m-d H:i:s');
	
	global $sql_obj;	
	$sql_obj->Query("insert into click_details(click_id,date)values('".$_GET['id']."','$date')");
	$row				=	$sql_obj->QFetchArray("SELECT * from super_url WHERE id = '".$_GET['id']."'");
	goUrl($amazone_obj->getSuperUrl($row['target_url'],$row['keywords']));
	die();
}

//DLETE QUERY
if(isset($_GET['cmd']) && $_GET['cmd'] == "active")	{
	
	 $id			=	$_GET['id'];
	 $sql_obj->Query("UPDATE products SET status = '".$_GET['value']."'  WHERE id = '$id'");
	 goUrl("products.php?msg=:) Product is updated sucessfully.");
}
//ACTIVE QUERY
if(isset($_GET['cmd']) && $_GET['cmd'] == "del")	{
	
	 $id			=	$_GET['id'];
	 $sql_obj->Query("DELETE FROM products WHERE id = '$id'");
	 goUrl("products.php?msg=:) Product is deleted sucessfully.");
}





if(isset($_POST['submit'])) {
	
  	$name   	     =       mysql_real_escape_string($_POST['name']);
	$asin   	     =       mysql_real_escape_string($_POST['asin']);
	$status   	     =       mysql_real_escape_string($_POST['status']);
	$cost_per_unit   =       mysql_real_escape_string($_POST['cost_per_unit']);
	$date	 		 = 		 date('Y-m-d H:i:s');
	global	$user_global;
	$refine_link	 =		 $user_global['product_adress'];
	

	
	//QUERY OF INSERTION
	$sql_obj->Query("insert into 	
		  			products(name,asin,status,user_id,product_url,cost_per_unit)
					values('$name','$asin','$status','".$_SESSION['user_id']."','$refine_link','$cost_per_unit')
					")or die(mysql_error());
	$insert_id		= 		$sql_obj->InsertID();
	if(isset($_POST['seller_rank']))	{
		$sql_obj->Query("INSERT INTO seller_rank (
						user_id, date_time, product_id,note) VALUES 
						('".$_SESSION['user_id']."', '$date', 
						'$insert_id',  '')");
	}
	if(isset($_POST['rank_tracker']))	{
		$sql_obj->Query("insert into  	
					rank_tracker(user_id,product_id,date_time)
					values(
					'".$_SESSION['user_id']."','$insert_id','$date')");
	}
			
				
					
	//REDIRECT
	$_GET['msg']	=	"Product is added sucessfully.";  

}
if(isset($_POST['update'])) {
	
  	$name   	     =       mysql_real_escape_string($_POST['name']);
	$asin   	     =       mysql_real_escape_string($_POST['asin']);
	$status   	     =       mysql_real_escape_string($_POST['status']);
	$cost_per_unit   =       mysql_real_escape_string($_POST['cost_per_unit']);
	

	
	//QUERY OF INSERTION
	$sql_obj->Query("UPDATE products SET
					name = '$name',
					asin = '$asin',
					status = '$status',
					cost_per_unit = '$cost_per_unit'
					WHERE id = '".$_GET['id']."'
					") or die(mysql_error());
	//REDIRECT
	goUrl(	"products.php?msg=Product is updated sucessfully.");  
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
        <h3 class="page-title">Products</h3>
        <ul class="page-breadcrumb breadcrumb">
          <li class="btn-group">
            <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> <span>Actions</span> <i class="fa fa-angle-down"></i> </button>
            <ul class="dropdown-menu pull-right" role="menu">
              <li><a href=""><i class="fa fa-refresh"></i> Refresh</a></li>
              <li><a href="#form_modal4" data-toggle="modal"><i class="fa fa-table"></i> Export</a></li>
              <li><a href="#"><i class="fa fa-download"></i> Import</a></li>
              <!--<li class="divider"></li>
              <li><a href="#">Separated link</a></li>-->
            </ul>
          </li>
          <li> <i class="fa fa-home"></i> <a href="index.php">Home</a> <i class="fa fa-angle-right"></i> </li>
          <li> <a href="#">Products</a> </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
      <div class="col-md-12">
        <?php if(isset($_GET['msg'])){ getSucessMessage($_GET['msg']); } 
		if(isset($msg)){ getSucessMessage($msg); } 
		if(isset($not)){ getErrorMessage($not); } 
		 ?>
        <div class="tabbable tabbable-custom boxless">
          <div class="col-md-12"> <a style="margin-bottom:10px;"  class="btn green" href="#form_modal10" data-toggle="modal"> <i class="fa fa-plus"></i> Add Product</a>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="portlet box blue">
                  <div class="portlet-title">
                    <div class="caption"><i class="fa fa-list-ul"></i>Product Listing</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                  </div>
                  <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                      <thead class="flip-content">
                        <tr>
                          <th>SN</th>
                          <th>Name</th>
                          <th>ASIN</th>
                          <th>SKU</th>
                          <th>Cost Per Unit</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
								 
		 $query 		=	mysql_query("SELECT * from products where user_id = '".$_SESSION['user_id']."'");		
		 if(mysql_num_rows($query) > 0){
		  $i						=	1;
  while($row		=	mysql_fetch_array($query))	{

	  ?>
                        <tr class="odd" id="s<?php echo $row['id']; ?>">
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['asin']; ?></td>
                          <td><?php echo $row['sku']; ?></td>
                          <td><?php echo $row['cost_per_unit']; ?></td>
                          <td><?php getStatus($row['status'],$row['id']); ?></td>
                          <td><!--<a onClick="deleteRecord('s<?php echo $row['id']; ?>','<?php echo $row['id']; ?>','products','<td colspan=4>Product is deleted sucessfully</td>');" href="javascript:void(0);" ><span class="label label-sm label-info">Delete</span></a>--> <a href="?cmd=edit&id=<?php echo $row['id']; ?>#form_modale" ><span class="label label-sm label-info">Edit</span></a></td>
                        </tr>
                        <?php }?>
                      </tbody>
                      <?php }else {
						
						 ?>
                      <tr>
                        <th colspan="7"><?php echo "Sorry! Your have no record :("; ?> </th>
                      </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END PAGE CONTENT--> 
        <!--<div class="portlet box light-grey">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-globe"></i>Managed Table</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								<a href="#portlet-config" data-toggle="modal" class="config"></a>
								<a href="javascript:;" class="reload"></a>
								<a href="javascript:;" class="remove"></a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="btn-group">
									<button id="sample_editable_1_new" class="btn green">
									Add New <i class="fa fa-plus"></i>
									</button>
								</div>
								<div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-right">
										<li><a href="#">Print</a></li>
										<li><a href="#">Save as PDF</a></li>
										<li><a href="#">Export to Excel</a></li>
									</ul>
								</div>
							</div>
							<table class="table table-striped table-bordered table-hover" id="sample_1">
								<thead>
									<tr>
										<th class="table-checkbox"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
										<th>Username</th>
										<th >Email</th>
										<th >Points</th>
										<th >Joined</th>
										<th >&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									<tr class="odd gradeX">
										<td><input type="checkbox" class="checkboxes" value="1" /></td>
										<td>shuxer</td>
										<td ><a href="mailto:shuxer@gmail.com">shuxer@gmail.com</a></td>
										<td >120</td>
										<td class="center">12 Jan 2012</td>
										<td ><span class="label label-sm label-success">Approved</span></td>
									</tr>
									
									
								</tbody>
							</table>
						</div>
					</div>--> 
      </div>
      <!-- END PAGE --> 
    </div>
  </div>
</div>
<div id="form_modal4" class="modal fade"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Download File</h4>
      </div>
      <form action="" class="form-horizontal" method="post">
      <div class="modal-body">
        
          <div class="form-group">
            <label class="control-label col-md-4">File Name*</label>
            <div class="col-md-8">
              
                <input type="text" name="file_name" class="form-control" value="Inventory-<?php echo date('Y-m-d'); ?>.csv"  placeholder="Enter text">
            
            </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true" data-dismiss="modal">Close</button>
        <input value="Download"  type="submit" class="btn green btn-primary" name="download" >
      </div>
      </form>
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
      <form onSubmit="return addProducts('add','0');"  class="form-horizontal" role="form" method="post" action="">
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
            <label class="control-label col-md-4">Cost Per Unit:</label>
            <div class="col-md-8">
              <input id="epasin" value="<?php echo $pro_row['cost_per_unit']; ?>" type="number" required class="form-control" name="cost_per_unit"  placeholder="e.g 4" />
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
            <label  class="col-md-4 control-label">Tools</label>
            <div class="col-md-8">
              <div class="checkbox-list">
                <label class="checkbox-inline">
                  <input type="checkbox" id="inlineCheckbox21" name="seller_rank">
                  Seller Rank </label>
                <label class="checkbox-inline">
                  <input type="checkbox" id="inlineCheckbox22" name="rank_tracker">
                  Rank Tracker </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4"></label>
            <div class="col-md-8"> <span id="edit-errorr" class="alert-danger" style="background:none;"></span> </div>
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
      <form  class="form-horizontal" onSubmit="return addProducts('edit','<?php echo $pro_row['id']; ?>');" role="form" method="post" action="">
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
            <label class="control-label col-md-4">Cost Per Unit:</label>
            <div class="col-md-8">
              <input id="epasin" value="<?php echo $pro_row['cost_per_unit']; ?>" type="number" required class="form-control" name="cost_per_unit"  placeholder="e.g 4" />
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
            <div class="col-md-8"> <span id="errorr" class="alert-danger" style="background:none;"></span> </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
          <button class="btn green" data-dismiss="modal" name="update" type="submit">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>
<?php require_once('includes/subpages/footer.php'); ?>
