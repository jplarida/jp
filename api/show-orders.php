<?php
require_once('../includes/lib/includes.php'); 
if(isset($_POST)){
$row		=		$sql_obj->QFetchArray("SELECT * FROM sale_orders WHERE order_id = '".$_POST['order_id']."' LIMIT 1");

	?>
<style type="text/css">
ul.order_detail {
	margin: 0px;
	padding: 0px;
}
ul.order_detail li {
	list-style: none;
	display: inline-block;
	float: left;
}
.right_col
	{
		width:30%;
	}
.right_col .lable {
	line-height: 35px;
}
.left-col	{
	width:68%;
	margin-right:10px;
}
.sub_heading 	{
	background-color: #E8E8E8;
	font-weight: bold;
}
</style>
<ul class="order_detail">
  <li class="left-col">
    <table width="100%" class="table table-bordered table-hover">
      <tbody>
        <tr>
          <td class="sub_heading" colspan="2" align="left"><?php echo $row['product_name']; ?></td>
        </tr>
        <tr>
          <td colspan="2"><strong>Income</strong></td>
        </tr>
        <tr>
          <td >FBA-RET</td>
          <td >$<?php echo $row['sales_price']; ?></td>
        </tr>
        <tr>
          <td >Sales Tax Collected</td>
          <td >$<?php echo $row['sales_tax']; ?></td>
        </tr>
        <?php $income = $row['sales_price'] + $row['sales_tax'] ?>
        <tr>
          <td ><strong>Total</strong></td>
          <td ><strong>$<?php echo $income; ?></strong></td>
        </tr>
      </tbody>
    </table>
    <table width="100%" class="table table-bordered table-hover">
      <tbody >
      
        <td colspan="2" class="sub_heading"><strong>Expenses</strong></td>
      </tr>
      <tr>
        <td >Buy Cost</td>
        <td >$<?php echo $row['buy_cost']; ?></td>
      </tr>
      <tr>
        <td >Commission</td>
        <td >$<?php echo $row['Commission']; ?></td>
      </tr>
      <tr>
        <td >FBA Fees</td>
        <td >$<?php echo $row['fba_fee']; ?></td>
      </tr>
      <tr>
        <td >Sales Tax Service Fee</td>
        <td >$<?php echo $row['sales_tax_service_fee']; ?></td>
      </tr>
      <?php $expenses = $row['buy_cost'] + $row['Commission'] + $row['fba_fee'] + $row['sales_tax_service_fee'] ?>
      <tr>
        <td ><strong>Total</strong></td>
        <td ><strong>$<?php echo $expenses; ?></strong></td>
      </tr>
        </tbody>
      
    </table>
    <table width="100%" class="table table-bordered table-hover">
      <tbody >
      
        <td colspan="2" class="sub_heading"><strong>Net Profit</strong></td>
      </tr>
      <tr>
        <td >Income</td>
        <td >$<?php echo $income; ?></td>
      </tr>
      <tr>
        <td >Expenses</td>
        <td >$<?php echo $expenses; ?></td>
      </tr>
      <?php $Net_Profit = $income + $expenses ?>
      <tr>
        <td ><strong>Total</strong></td>
        <td ><strong>$<?php echo $Net_Profit; ?></strong></td>
      </tr>
        </tbody>
      
    </table>
  </li>
  <li  class="right_col">
    <table width="100%" class="table table-bordered table-hover">
      <tbody>
        <tr>
          <td  align="left" class="lable">Commission</td>
          <td  align="right"><div class="input-icon input-small"> <i class="fa fa-dollar"></i>
              <input type="text" class="form-control" value="<?php echo $row['Commission']; ?>">
            </div></td>
        </tr>
        <tr>
          <td  align="left" class="lable">Variable Closing Fee</td>
          <td  align="right"><div class="input-icon input-small"> <i class="fa fa-dollar"></i>
              <input type="text" class="form-control" value="<?php echo $row['ShippingChargeback']; ?>">
            </div></td>
        </tr>
        <tr>
          <td  align="left" class="lable">Pick & Pack</td>
          <td  align="right"><div class="input-icon input-small"> <i class="fa fa-dollar"></i>
              <input type="text" class="form-control" value="<?php echo $row['FBAPerUnitFulfillmentFee']; ?>">
            </div></td>
        </tr>
        <tr>
          <td  align="left" class="lable">Weight Based</td>
          <td  align="right"><div class="input-icon input-small"> <i class="fa fa-dollar"></i>
              <input type="text" class="form-control" value="<?php echo $row['FBAWeightBasedFee']; ?>">
            </div></td>
        </tr>
        <tr>
          <td  align="left" class="lable">Order Handling</td>
          <td  align="right"><div class="input-icon input-small"> <i class="fa fa-dollar"></i>
              <input type="text" class="form-control" value="<?php echo abs($row['FBAPerOrderFulfillmentFee	']); ?>">
            </div></td>
        </tr>
       <?php $total = $row['ShippingChargeback'] + $row['Commission'] + $row['FBAPerUnitFulfillmentFee'] + $row['FBAWeightBasedFee'] + $row['FBAPerOrderFulfillmentFee'] ?> 
       
        <tr>
          <td  align="left" class="sub_heading"><strong>Total</strong></td>
          <td  align="center" class="sub_heading"><strong>$<?php echo $total; ?></strong></td>
        </tr>
      </tbody>
    </table>
   
    <table width="100%" class="table table-bordered table-hover">
      <tbody>
      <tr>
          <td  align="left" class="sub_heading" colspan="2"><strong>Accounting</strong></td>
         
        </tr>
        <tr>
          <td  align="left" class="lable">Supplier</td>
          <td  align="right"><div class="input-icon input-small"> <i class="fa fa-dollar"></i>
              <input type="text" class="form-control" value="5">
            </div></td>
        </tr>
        <tr>
          <td  align="left" class="lable">Price Per Unit</td>
          <td  align="right"><div class="input-icon input-small"> <i class="fa fa-dollar"></i>
              <input type="text" class="form-control" value="$<?php echo $row['buy_cost']; ?>">
            </div></td>
        </tr>
        <tr>
          <td  align="left">Total Buy Cost</td>
          <td  align="right">$<?php echo $row['buy_cost']; ?></td>
        </tr>
        <tr>
          <td  align="left">Profit</td>
          <td  align="right"><?php  
		  					$profit	=	$row['sales_price'] -
						  				abs($row['FBAPerOrderFulfillmentFee']) -
										abs($row['FBAPerUnitFulfillmentFee']) -
										abs($row['FBAWeightBasedFee']) -
										abs($row['Commission']) -
										abs($row['ShippingChargeback']);
						  $profit_percent	=	round(($profit / $row['sales_price']) * 100 ,2);
						echo $profit_percent;
						  				
						  				
						  
						  
						  ?>%</td>
        </tr>
        <tr>
          <td  align="left">ROI</td>
          <td  align="right"><?php echo $row['sales_price']; ?>%</td>
        </tr>
       
      </tbody>
    </table>
  </li>
</ul>
<br style="clear:both;">

<?php

}
?>
