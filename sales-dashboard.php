<?php 
require_once('includes/lib/includes.php'); 
$paging_obj       =  new Paging(20,$sql_obj);
$limit     =  $paging_obj->getLimit();
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
        <h3 class="page-title">Sales Dashboard</h3>
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
          <li>
          <?php if(isset($_GET['p'])){ ?>
           <a  onClick="goBack(<?php echo $_GET['p'] ?>)">Sales Dashboard</a> </li>
           <?php }else{ ?>
           <a onClick="goBack('1')">Sales Dashboard</a> </li>
           <?php } ?>
        
          <li> <span id="oid"></span> </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    
    <div id="sdash">
    <div class="row" >
      <div class="col-md-12">
        <div class="tabbable tabbable-custom boxless">
          <div class="col-md-12"> 
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="portlet box blue">
                  <div class="portlet-title">
                    <div class="caption"><i class="fa fa-list-ul"></i>Sales Dashboard</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                  </div>
                  <div class="portlet-body flip-scroll">
                  <div id="order-details" >
                  
                    <table class="table table-bordered table-striped table-condensed flip-content">
                      <thead class="flip-content">
                        <tr>
                          <th width="74">Date</th>		
                          <th width="44">Order Detial</th>  
                          <th width="62">Sale Price</th>
                          <th width="66">Net Profit</th>
                          <th width="57">Profit %</th>
                          <th width="50">ROI %</th>
                          <th width="50">ROI %</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
							 
		$orders 		=	$sql_obj->QFetchRowArray("SELECT * from sale_orders   $limit");
		 //$orders 		=	$sql_obj->QFetchRowArray("SELECT * from sale_orders ORDER BY Commission DESC $limit");
		 if(is_array($orders))	{
			 foreach($orders as $key=>$row)	{
  
	  ?>
      					
                        <tr class="odd" id="s<?php echo $row['id']; ?>">
                          <td><?php echo date("d M, Y", strtotime($row['transaction_date'])); ?></td>
                          <td><?php echo '<a  onClick="orderDetail('."'".$row['order_id']."'".')">'.$row['order_id'].'</a><br/>'.$row['product_name']; ?></td>
                          <td>$<?php echo round($row['sales_price'], 2); ?></td>
                           <td><?php  
						  $profit	=	$row['sales_price'] -
						  				abs($row['FBAPerOrderFulfillmentFee']) -
										abs($row['FBAPerUnitFulfillmentFee']) -
										abs($row['FBAWeightBasedFee']) -
										abs($row['Commission']) -
										abs($row['ShippingChargeback']);
						echo $profit;
						  				
						  				
						  
						  
						  ?></td>
                          <td>
						  <?php  
						  $profit_percent	=	round(($profit / $row['sales_price']) * 100 ,2);
						echo $profit_percent;
						  				
						  				
						  
						  
						  ?>%</td>
                          <td><?php echo $row['sales_tax']; ?></td>
                          <td><?php echo $row['sales_price']; ?></td>
                          
                         
                        </tr>
                        <?php } ?>
                      </tbody>
                      <?php }else {
						
						 ?>
                      <tr>
                        <th colspan="17"><?php echo "Sorry! Your have no record :("; ?> </th>
                      </tr>
                      <?php } ?>
                    </table>
                    </div>
                  </div>
                </div>
                <?php
				/////////////////
				
				
				 echo $paging_obj->showPaging(20,"sale_orders","","paging","next");
				
				?>
              </div>
            </div>
          </div>
        </div>
      
      </div>
      <!-- END PAGE --> 
    </div>
    </div>
  </div>
</div>

<?php require_once('includes/subpages/footer.php'); ?>
