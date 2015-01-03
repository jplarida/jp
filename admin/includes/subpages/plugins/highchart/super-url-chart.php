<?php
$click_row		=	$sql_obj->QFetchRowArray("SELECT cd.*,COUNT(date) AS clicks FROM click_details cd WHERE cd.click_id ='".$_GET['id']."' GROUP BY  cd.date ORDER BY cd.date");
$dates		=	"";
$values		=	"";

if(is_array($click_row))	{
	foreach($click_row as $key=>$row)	{
		$dates	.= "'".date("M j",strtotime($row['date']))."',";
		$values	.= ($row['clicks']*1).",";
	}
?>
<script type="text/javascript">
$(function () {
    $('#cont_surl').highcharts({
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
                text: 'Values( click per date)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' Clicks'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'User Clicks',
            data: [<?php echo $values; ?>]
        }]
    });
});
		</script>
<?php } ?>