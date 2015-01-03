<?php require_once('includes/lib/includes.php'); ?>
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
    
    <!-- BEGIN PIE CHART PORTLET-->
    <div class="row">
      <div class="col-md-6">
        <div class="portlet box yellow">
          <div class="portlet-title">
            <div class="caption"><i class="fa fa-reorder"></i>Default</div>
            <div class="tools"> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> </div>
          </div>
          <div class="portlet-body">
            <h4>Default Pie with Legend.</h4>
            <div id="pie_chart" class="chart"></div>
          </div>
        </div>
        <div class="portlet box purple" >
          <div class="portlet-title">
            <div class="caption"><i class="fa fa-reorder"></i>Graph1</div>
            <div class="tools"> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> </div>
          </div>
          <div class="portlet-body">
            <h4>Default Pie without Legend</h4>
            <div id="pie_chart_1" class="chart"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="portlet box blue">
          <div class="portlet-title">
            <div class="caption"><i class="fa fa-reorder"></i>Graph2</div>
            <div class="tools"> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> </div>
          </div>
          <div class="portlet-body">
            <h4>Added a semi-transparent background to the labels and a custom labelFormatter function.</h4>
            <div id="pie_chart_2" class="chart"></div>
          </div>
        </div>
        
      </div>
    </div>
    <!-- END PIE CHART PORTLET--> 
    
  </div>
  <!-- END PAGE --> 
</div>
<?php require_once('includes/subpages/footer.php'); ?>
