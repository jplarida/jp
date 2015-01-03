<?php require_once('includes/lib/includes.php'); ?>
<?php 
/*if(isset($_GET['cmd']) && $_GET['cmd'] == "refresh")	{

	$sql_obj->Query("DELETE FROM feedbacks where user_id = '".$_SESSION['user_id']."'");
	$amazone_obj->feedFeedbacks($scrap_url);
	goUrl("feedbacks.php?msg=Feedbacks are refresh now!");
}*/




/*if(isset($_GET['cmd']) && $_GET['cmd'] == "response")	{
	if($amazone_obj->response(urldecode($_GET['val']),$setting['response']) == "")	{
		goUrl("feedbacks.php?msg=Response is submitted sucessfully!");
	}else {
		goUrl("feedbacks.php?msg=:( Un able to submit the response.");
	}
	$sql_obj->Query("UPDATE feedbacks SET is_responed = 1 WHERE response_url = '".urldecode($_GET['val'])."' and user_id = '".$_SESSION['user_id']."'");
}*/


/*if(isset($_POST['respond_submit'])){


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

}*/




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
        <h3 class="page-title"> Inventory Health <!--<small>In Tool</small>--> </h3>
        <ul class="page-breadcrumb breadcrumb">
          <li class="btn-group">
            <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> <span>Actions</span> <i class="fa fa-angle-down"></i> </button>
             <?php if(isSettings($_SESSION['user_id']) == 1){ ?>
            <ul class="dropdown-menu pull-right" role="menu">
          <li>
         
          <a href="?cmd=refresh&page=Inventory_health">Refresh</a></li>
          
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
      <div class="col-md-12">
        <?php /*if(isset($_GET['msg'])){ getSucessMessage($_GET['msg']); } 
		
		if(isSettings($_SESSION['user_id']) == 0){*/
		 ?>
        
       <!-- <div class="note note-danger" style="height: 45px; padding-top: 5px;">
								<h4 class="block">Please do gernal setting first! <a href="setting.php">go here</a></h4>
								
							</div>-->
                            <?php // } ?>
        
        <div class="tabbable tabbable-custom boxless">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_0" data-toggle="tab">Inventory Health</a></li>
            <!--<li><a href="#tab_1" data-toggle="tab">Setting</a></li>
            <li><a href="#tab_2" data-toggle="tab">Performance</a></li>-->
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_0">
              <div class="portlet box green">
                <div class="portlet-title">
                  <div class="caption"><i class="fa fa-comment-o"></i>Inventory Health</div>
                  <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                </div>
                <div class="portlet-body flip-scroll">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                      <tr>
                        <th>Product Name</th>
                        <th>MSKU</th>
                        <th>Total Sellable Quantity</th>
                        <th>Sales Price</th>
                        <th>Cost Per Unit</th>
                        <th>Total Cost</th>
                        <th>Units Shipped Last 30 days</th>
                        <th>Days Till Empty</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					  $sellable_total = 0;
					  $total_product_items =0;
					  $total_sales_price=0;
					  $total_cost_per_unit = 0;
								 
		 $query 		=	mysql_query("SELECT * from inventary_health where user_id = '".$_SESSION['user_id']."' and sales_price!=0");	
		 if(mysql_num_rows($query) > 0){	
		 
		  $i						=	1;
  while($row		=	mysql_fetch_array($query))	{

	  ?>
                      <tr class="odd" id="s<?php echo $row['cat_id']; ?>">
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['sku']; ?></td>
                        <td><?php echo $row['afn_fulfillable_quantity']; ?></td>
                        <td><?php echo "$".$row['sales_price']; ?></td>
                        <td><?php echo $cost_per_unit ?></td>
                        <td><?php echo "$".$row['sales_price']*$row['afn_fulfillable_quantity']; ?></td>
                        <td><?php //echo $row['afn_inbound_shipped_quantity']; ?></td>
                        <td ><?php // $row['afn_inbound_shipped_quantity'];  ?>
                          <!--<span class="label label-success">Sumitted</span>-->
                          <?php //else: ?>
                          <!--<a href="?cmd=response&page=feedbacks&val=<?php echo urlencode($row['response_url']); ?>" class="btn mini blue">Response</a>-->
                          <?php //endif; ?></td>
                      </tr>
                       <?php
					   global $sellable_total;
					   $total_product_items++;
					   $total_cost_per_unit += $cost_per_unit;
					   $total_sales_price += $row['sales_price'];
				 $sellable_total += $row['afn_fulfillable_quantity'];
					    }// end of while
						?>
                    </tbody>
                    <?php 
					
					}else {
						
						 ?>
                         <tr>
                        <th colspan="7"><?php echo "Sorry! Your have not feedback. :("; ?> </th>
                      </tr>
                 <?php 
				 
				 } ?>
                  </table>
                  <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                      <tr>
                        <th>Total In Stock Item</th>
                        <th>Total SKU</th>
                        <th>Total Inventory value</th>
                        <th>Total Sales Value</th>
                        </tr>
                    </thead>
                    <tbody>
               
                      <tr class="odd" id="s<?php echo $row['cat_id']; ?>">
                        <td ><?php echo $sellable_total ?></td>
                        <td><?php echo $total_product_items; ?></td>
                        <td ><?php //echo $total_cost_per_unit*$sellable_total; ?></td>
                        <td><?php echo "$".$total_sales_price*$sellable_total; ?></td>
                       </tr>  
                    </tbody>
    				</table>
                </div>
              </div>
            </div>
            
           
            <div class="tab-pane" id="tab_2">
              
          </div>
        </div>
      </div>
    </div>
    <!-- END PAGE CONTENT--> 
  </div>
  <!-- END PAGE --> 
</div>
<?php require_once('includes/subpages/footer.php'); ?>
