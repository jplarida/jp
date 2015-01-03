<?php
$click_row		=	$sql_obj->QFetchRowArray("SELECT rtd.date_time, rtd.rank  FROM rank_tracker_detail rtd WHERE rtd.rank_tracker_id = '74' ORDER BY rtd.date_time");

$dates		=	"";
$values		=	"";

if(is_array($click_row))	{
	foreach($click_row as $key=>$row)	{
		$dates	.= "'".date("M j",strtotime($row['date_time']))."',";
		$values	.= ($row['rank']*1).",";
	}
?>
<script type="text/javascript">
$(function () {
    $('#cont_rank').highcharts({
        title: {
            text: '',
            x: -20 //center
        },
        
        xAxis: {
            //categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
               // 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			categories: [<?php echo $dates; ?>]
        },
        yAxis: {
            title: {
                text: 'Rank (Date wise)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' current'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Rank',
            data: [<?php echo $values; ?>]
        }]
    });
});
		</script>
<?php } ?>