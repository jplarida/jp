<?php 
require_once('includes/lib/includes.php'); 

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
        <h3 class="page-title"> Inventory Health </h3>
        <ul class="page-breadcrumb breadcrumb">
          <li class="btn-group">
            <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> <span>Actions</span> <i class="fa fa-angle-down"></i> </button>
             <?php if(isSettings($_SESSION['user_id']) == 1){ ?>
            <ul class="dropdown-menu pull-right" role="menu">
          <li>
         
          <a href="#">Refresh</a></li>
          
              <!--<li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>-->
            </ul>
            <?php } ?>
          </li>
          <li> <i class="fa fa-home"></i> <a href="index.php">Home</a> <i class="fa fa-angle-right"></i> </li>
          <li> <a href="#">Inventory Health</a> </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
      <div class="col-md-12"><!-- <a style="margin-bottom:10px;"  class="btn green" href="#form_modal10" data-toggle="modal"> <i class="fa fa-plus"></i> Add Inventory Health </a>-->
        <?php if(isset($_GET['msg'])){ $msg = $_GET['msg']; } 
		if(isset($msg)){ getSucessMessage($msg); } 
		if(isset($not)){ getErrorMessage($not); } 
		 ?>
        <div class="tabbable tabbable-custom boxless">
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <div class="portlet box blue">
                <div class="portlet-title">
                  <div class="caption"><i class="fa fa-link"></i>Inventory Health Listing</div>
                  <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                </div>
                <div class="portlet-body flip-scroll">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                      <tr>
                      <th >SN</th>
                        <th >Product Name</th>
                        <th >MSKU</th>
                        <th class="numeric">Total Sellable Quantity</th>
                        <th class="numeric">Sales Price</th>
                        <th class="numeric">Cost Per Unit</th>
                        <th class="numeric">Total Cost</th>
                        <th class="numeric">Unit Shipped Last 30 Days</th>
                        <th class="numeric">Days Till Empty</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
						$total_sa_q		=	0;
						$total_record	=	0;	
						$tiv			=	0;	 
						$total_cost		=	0;
		 $query 		=	mysql_query("SELECT ih.*,p.name,p.cost_per_unit FROM inventory_health ih, products p WHERE ih.asin = p.asin");	
		//$query 		=	mysql_query("SELECT * FROM inventory_health ih");		
		 if(mysql_num_rows($query) > 0){
		  $i						=	1;
  while($row		=	mysql_fetch_array($query))	{

	  ?>
                      <tr class="odd" >
                      <td><?php echo $i++; ?></td>
                        <td><?php $arr= explode("-",$row['name']);echo $arr[0]; ?></td>
                        <td><?php echo $row['sku']; ?></td>
                        <td><?php 
						echo $row['sellable_quantity'];
						$total_sa_q	+=	$row['sellable_quantity']; 
						$total_record++;
						$tiv	+=	$row['sellable_quantity'] * $row['sales_price'];
						?></td>
                        <td>$<?php echo $row['sales_price']; ?></td>
                        <td>$<?php echo $row['cost_per_unit']; ?></td>
                        <td><?php 
						$cost	=	($row['sellable_quantity'] * $row['cost_per_unit']);
						$total_cost	+= $cost;
						echo number_format( $cost);
						?></td>
                        <td><?php echo $row['units_shipped_last_30_days']; ?></td>
                        <td><?php 
						$val	=	(($row['units_shipped_last_30_days'] / 30)
						); 
						 echo floor($row['sellable_quantity'] / $val);
						?></td>
                      </tr>
                      
                      <?php }?>
                    </tbody>
                    <?php }else {
						
						 ?>
                    <tr>
                      <th colspan="7"><?php echo "Sorry! Your have not record. :("; ?> </th>
                    </tr>
                    <?php } ?>
                    <tr> 
                    </tr>
                  </table>
                   <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                      <tr>
                        <th >Total Instock Item</th>
                        <th >Total SKU</th>
                        <th >Total Inventory Value</th>
                        <th >Total Sales Value</th>
                        
                      </tr>
                      <tr class="odd" >
                        <td><?php echo $total_sa_q; ?></td>
                        <td><?php echo $total_record; ?></td>
                        <td><?php echo number_format($total_cost); ?></td>
                        <td><?php echo number_format($tiv);?></td>
                    </thead>
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
            </div>
            <br style="clear:both;" />
            <br/>
            <br/>
            <br/>
            <?php } ?>
          </div>
          <br style="clear:both;" />
          <br/>
          <br/>
          <br/>
        </div>
        <br style="clear:both;" />
        <br/>
        <br/>
        <br/>
      </div>
      <br style="clear:both;" />
      <br/>
      <br/>
      <br/>
      <!-- END PAGE CONTENT--> 
    </div>
    <!-- END PAGE --> 
  </div>
</div>
<div id="form_modal10" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Inventory health</h4>
      </div>
      <form onSubmit="return addInventoryHealth('add','0');"  class="form-horizontal" role="form" method="post" action="">
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
            <label class="control-label col-md-4">Cost Per Unit:</label>
            <div class="col-md-8">
              <input required type="text" class="form-control" name="cost_per_unit"  placeholder="exp. 15">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4"></label>
            <div class="col-md-8"> <span id="errorr" class="alert-danger" style="background:none;"></span> </div>
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
            <label class="control-label col-md-4">Cost Per Unit:</label>
            <div class="col-md-8">
              <input  type="text" class="form-control" name="marchent_id" value="<?php echo $su_row['c']; ?>"  placeholder="Marchant ID">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4">Associative Tag:</label>
            <div class="col-md-8">
              <input type="text"  class="form-control" name="tag"  placeholder="Associative Tag" value="<?php echo $su_row['associative_tag']; ?>">
              </textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4">Note:</label>
            <div class="col-md-8">
              <textarea   class="form-control" name="note"  placeholder="Note"><?php echo $su_row['note']; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4"></label>
            <div class="col-md-8"> <span id="edit-errorr" class="alert-danger" style="background:none;"></span> </div>
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
