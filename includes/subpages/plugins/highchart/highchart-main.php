<script src="<?php echo THEME_BASE; ?>charts/Highcharts-4.0.4/js/highcharts.js"></script><script src="<?php echo THEME_BASE; ?>charts/Highcharts-4.0.4/js/modules/exporting.js"></script>
<?php
function getHighChart()	{
	global $sql_obj;
	$page				=	 	basename($_SERVER['PHP_SELF']);
	$hight_chart		=		"";
	switch ($page) {
		case "super-url.php":
			require_once(__DIR__."/super-url-chart.php");
			break;
		case "feedbacks.php":
			require_once(__DIR__."/feedbacks-chart.php");
			break;
		case "rank-tracker.php":
			//require_once(__DIR__."/rank-tracker-chart.php");
			break;
	}

}
getHighChart();
?>