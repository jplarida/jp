<!-- BEGIN CORE PLUGINS -->   	
<!--[if lt IE 9]>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/respond.min.js"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/excanvas.min.js"></script> 
	<![endif]-->   
	
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>      
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
       <script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/fuelux/js/spinner.min.js"></script>
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/ckeditor/ckeditor.js"></script>  
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
	
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/clockface/js/clockface.js"></script>
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-daterangepicker/daterangepicker.js"></script> 
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>  
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script> 
      
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-multi-select/js/jquery.quicksearch.js"></script>   
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript" ></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript" ></script>
    
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript" ></script>
    
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript" ></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript" ></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript" ></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript" ></script>
    
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-validation/dist/additional-methods.min.js"></script>
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    
    
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/select2/select2.min.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
    
    <!-- BEGIN PAGE LEVEL PLUGINS -->
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?php echo THEME_BASE; ?>metronic/plugins/data-tables/DT_bootstrap.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
    
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo THEME_BASE; ?>metronic/scripts/app.js"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/scripts/form-samples.js"></script> 
    <script src="<?php echo THEME_BASE; ?>metronic/scripts/form-components.js"></script> 
    <script src="<?php echo THEME_BASE; ?>metronic/scripts/table-managed.js"></script>   
	<!-- END PAGE LEVEL SCRIPTS -->
    
    
    
	<script>
		jQuery(document).ready(function() {    
		   // initiate layout and plugins
		   App.init();
		   FormSamples.init();
		   FormComponents.init();
		   TableManaged.init();
		});
		
	</script>
	<!-- END JAVASCRIPTS -->   
    <script src="<?php echo THEME_BASE; ?>js/functions.js" type="text/javascript"></script>