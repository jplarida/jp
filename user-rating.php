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
        <h3 class="page-title">Rating</h3>
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
          <li> <a href="#">Customer's Rating</a> </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
      <div class="col-md-12">
      
        <div class="tabbable tabbable-custom boxless">
          <div class="col-md-12"> 
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="portlet box blue">
                  <div class="portlet-title">
                    <div class="caption"><i class="fa fa-list-ul"></i>Product's Ratings</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                  </div>
                  <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                      <thead class="flip-content">
                        <tr>
                          <th>Name</th>
                          <th>Avarage Rating</th>
                          <th>Customers</th>
                       
                        </tr>
                      </thead>
                      <tbody>
                        <?php
		function getAverageRating($pid)	{
			global $sql_obj;
			$avg			=	0;
			$sum			=	0;
			$rat_row		=	$sql_obj->QFetchRowArray("SELECT r.* from products p, ratings r where  r.product_id = p.id and p.id = '$pid'");
			if(is_array($rat_row))	{
				foreach($rat_row as $key=>$row)	{
					$avg	+= ($row['customers'] * $row['rating']);
					$sum	+= $row['customers'] ;
				}
			}
			return ($avg / $sum);
		}
		function getRatingCustomers($pid)	{
			global $sql_obj;
			$sum			=	0;
			$rat_row		=	$sql_obj->QFetchRowArray("SELECT r.* from products p, ratings r where  r.product_id = p.id and p.id = '$pid'");
			if(is_array($rat_row))	{
				foreach($rat_row as $key=>$row)	{
					$sum	+= $row['customers'] ;
				}
			}
			return number_format($sum);
		}
		function getCustomersByRating($pid,$rating)	{
			global $sql_obj;
			$sum			=	0;
			if($rating <= 3)	{
				$rat_wh			=	"AND r.rating <= '$rating'";
			}else	{
				$rat_wh			=	"AND r.rating = '$rating'";
			}
			$rat_row		=	$sql_obj->QFetchRowArray("SELECT r.* from products p, ratings r where  r.product_id = p.id and p.id = '$pid' $rat_wh");
			if(is_array($rat_row))	{
				foreach($rat_row as $key=>$row)	{
					$sum	+= $row['customers'] ;
				}
			}
			return ($sum);
			
		}
		 $pro_row 		=	$sql_obj->QFetchRowArray("SELECT p.name,p.id as pid,r.* from products p, ratings r where p.user_id = '".$_SESSION['user_id']."' AND r.product_id = p.id GROUP BY r.product_id");		
		 if(is_array($pro_row)){
		  $i						=	1;
		  foreach($pro_row as $key=>$row)	{
			  if($i > 1)	{
				 $com	=	"," ;
			  }else {
				  $com	=	"" ;
			  }
			  $products	.=	$com."'".$row['name']."'";
			  $rat		=	getCustomersByRating($row['pid'],5);
			  $star5	.=	$com.$rat;
			  $rat		=	getCustomersByRating($row['pid'],4);
			  $star4	.=	$com.$rat;
			  $rat		=	getCustomersByRating($row['pid'],3);
			  $star3	.=	$com.$rat;
			  
			  
	  ?>
                        <tr class="odd" id="s<?php echo $row['id']; ?>">
                          <td><a href="javascript:void(0)">> <strong><?php echo $row['name']; ?></strong></a></td>
                          <td>
						  <?php 
						  $rat	=	round(getAverageRating($row['pid']),2); 
						  if($rat < 3)	{
							  echo $rat;
						  }else	{
							  echo $rat;
						  }
						  
						  ?>
                          </td>
                          <td><?php echo getRatingCustomers($row['pid']); ?></td>
                         
                        </tr>
                        <?php $i++;}?>
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
                <div class="portlet box blue">
                  <div class="portlet-title">
                    <div class="caption"><i class="fa fa-list-ul"></i>Inventory Overall Performance</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                  </div>
                  <div class="portlet-body flip-scroll">
                  
                  
                  <script type="text/javascript">
$(function () {
    $('#review_cont').highcharts({
		colors: ['#014A0D', '#047BAE', '#740A02'],
        chart: {
            type: 'bar'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [<?php echo $products;?>],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Number of Customers',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' Customers'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'horizontal',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: '5 Star',
            data: [<?php echo $star5 ?>]
        }, {
            name: '4 Star',
            data: [<?php echo $star4 ?>]
        }, {
            name: 'Below 3',
            data: [<?php echo $star3 ?>]
        }]
    });
});
		</script>
                    <div id="review_cont" style="min-width: 310px; max-width: 1000px; min-height: 600px; margin: 0 auto"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END PAGE CONTENT-->
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
          <button class="btn green" name="update" type="submit">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>
<?php require_once('includes/subpages/footer.php'); ?>
