<?php
$rating1_2		=	$sql_obj->RowCount("feedbacks","WHERE rating < 3 and user_id = '".$_SESSION['user_id']."'");
$rating3		=	$sql_obj->RowCount("feedbacks","WHERE rating = 3 and user_id = '".$_SESSION['user_id']."'");
$rating4_5		=	$sql_obj->RowCount("feedbacks","WHERE rating > 3 and user_id = '".$_SESSION['user_id']."'");
?>
<script type="text/javascript">
$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#fb_cont').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Feedback',
                data: [
                    ['Rating 1-2',   <?php echo $rating1_2; ?>],
                    ['Rating 3',       <?php echo $rating3; ?>],
                    ['Rating 4-5',    <?php echo $rating4_5; ?>],
                   
                    
                ]
            }]
        });
    });

});
</script>