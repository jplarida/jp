<?php
$click_row		=	$sql_obj->QFetchRowArray("SELECT rtd.date_time, rtd.rank  FROM rank_tracker_detail rtd 
  WHERE rtd.rank_tracker_id = '".$row['id']."' AND rtd.keyword_id = '".$krow['id']."' GROUP BY rtd.date_time ORDER BY rtd.date_time ");

$dates		=	"";
$values		=	"";

if(is_array($click_row))	{
	foreach($click_row as $key=>$rows)	{
		$dates	.= "'".date("M j",strtotime($rows['date_time']))."',";
		$values	.= ($rows['rank']*1).",";
	}
?>

<div id="form_modal<?php echo $krow['id']; ?>" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true"> 
  <script type="text/javascript">
$(function () {
    $('#cont_rank_<?php echo $krow['id']; ?>').highcharts({
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><?php echo ucfirst(str_replace("+"," ",$krow['keyword'])); ?></h4>
      </div>
      <div id="cont_rank_<?php echo $krow['id']; ?>" style="min-width: 570px; height: 400px; margin: 0 auto"></div>
    </div>
  </div>
</div>
<?php } ?>
