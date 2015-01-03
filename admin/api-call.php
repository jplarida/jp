<?php 
require_once('../includes/lib/includes.php'); 
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
    <?php require_once('includes/subpages/theme-style.php'); ?>
    
    <!-- END BEGIN STYLE CUSTOMIZER --> 
    <!-- BEGIN PAGE HEADER-->
    <div class="row">
      <div class="col-md-12"> 
        
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">Manage Amazone API API</h3>
        <ul class="page-breadcrumb breadcrumb">
          <li> <i class="fa fa-home"></i> <a href="index.php">Home</a> <i class="fa fa-angle-right"></i> </li>
          <li> <a href="#">Amazone API</a> </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
      <div class="tabbable tabbable-custom boxless">
        <div class="col-md-12">
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <div class="portlet box blue">
                <div class="portlet-title">
                  <div class="caption"><i class="fa fa-list-ul"></i>API Calls</div>
                  <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                </div>
                <div class="portlet-body flip-scroll">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                      <tr>
                        <th>API Call</th>
                        <th>Today</th>
                        <th>Weekly Avg</th>
                        <th>Monthly Avg</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="odd">
                        <td>Keyword Rank</td>
                        <td>
						<?php 
						$today_krc =  $sql_obj->RowCount("cron_details", "WHERE cron_type = 1 AND date_time > CURDATE()");
						echo $today_krc;  
						?>
                        </td>
                        <td>
						<?php 
						$total_krc  = $sql_obj->RowCount("cron_details", "WHERE cron_type = 1") ;
						$total_krc7	=	 ceil($total_krc / 7);
						echo $total_krc7;
				  		?>
                  		</td>
                        <td>
						<?php 
						$total_krc30	= ceil($total_krc / 30);
						echo $total_krc30;
						?>
                        </td>
                        <td><?php echo $total_krc;  ?></td>
                      </tr>
                      <tr class="odd">
                        <td>Seller Rank</td>
                        <td>
						<?php $today_sr =	$sql_obj->RowCount("cron_details", "WHERE cron_type = 2 AND date_time > CURDATE()");echo $today_sr;  
						?>
                        </td>
                        <td>
						<?php 
						$total_sr  = $sql_obj->RowCount("cron_details", "WHERE cron_type = 2") ;
						$total_sr7	= ceil($total_sr / 7);
						echo $total_sr7;
				  		?>
                 		</td>
                        <td>
						<?php 
						$total_sr30	= ceil($total_sr / 30);  
						echo $total_sr30;
						?>
                        </td>
                        <td><?php echo $total_sr;  ?></td>
                      </tr>
                      <tr class="active">
                        <td><strong>Grand Total</strong></td>
                        <td><?php echo  $today_krc  + $today_sr;  ?></td>
                        <td><?php echo $total_krc7 + $total_sr7; ?></td>
                        <td> <?php echo $total_krc30 + $total_sr30; ?></td>
                        <td><?php echo $today_krc + $today_sr; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END PAGE --> 
  </div>
</div>
</div>
<?php require_once('includes/subpages/footer.php'); ?>
