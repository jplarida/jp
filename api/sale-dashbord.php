<?php require_once('../includes/lib/includes.php'); 


$paging_obj       =  new Paging(20,$sql_obj);
$limit     =  $paging_obj->getLimit();



  ?>



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
						global $sql_obj;
							 
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