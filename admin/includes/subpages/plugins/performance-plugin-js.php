<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   
	<!--[if lt IE 9]>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/respond.min.js"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/excanvas.min.js"></script> 
	<![endif]-->   
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script> 
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/flot/jquery.flot.js"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/flot/jquery.flot.resize.js"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/flot/jquery.flot.pie.js"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/flot/jquery.flot.stack.js"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/plugins/flot/jquery.flot.crosshair.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo THEME_BASE; ?>metronic/scripts/app.js"></script>
	<script src="<?php echo THEME_BASE; ?>metronic/scripts/charts.js"></script>      
	<script>
		jQuery(document).ready(function() {       
		   // initiate layout and plugins
		   App.init();
		   Charts.init();
		   Charts.initPieCharts();
		});
	</script>