<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php
$rating1_2		=	$sql_obj->RowCount("feedbacks","WHERE rating < 3 and user_id = '".$_SESSION['user_id']."'");
$rating3		=	$sql_obj->RowCount("feedbacks","WHERE rating = 3 and user_id = '".$_SESSION['user_id']."'");
$rating4_4		=	$sql_obj->RowCount("feedbacks","WHERE rating > 3 and user_id = '".$_SESSION['user_id']."'");
?>
<script type="text/javascript">

google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {

  var data = google.visualization.arrayToDataTable([
	['Perfromance', 'Feedback Percustomer'],
	['Feedback 1 and 2',     <?php echo $rating1_2; ?>],
	['Feedabck 3',      <?php echo $rating3; ?>],
	['Feedback 4 and 5',  <?php echo $rating4_4; ?>]
  ]);

  var options = {
	title: ""
  };

  var chart = new google.visualization.PieChart(document.getElementById('feedback_performance'));

  chart.draw(data, options);
}
</script>


 <?php
 //...............................................................//
 //																  //
 //																  //
 //						SUPER URL CHART							  //
 //																  //
 //																  //
 //...............................................................//
 

 
if(isset($_GET['id'])){
	//INTILITAION
	$string	=	"";
	$month		=	array(1=>"",2=>"Last 2 days",3=>"Last 3 days",4=>"Last 4 days",5=>"Last 5 days",6=>"Last 6 days",7=>"Last 7 days");
	
	//QUERY TO GET RECORD
	$clicks = 	$sql_obj->QFetchRowArray(" SELECT COUNT(*) AS clicks,date
				FROM click_details
				WHERE click_id = '20' AND  DATEDIFF(NOW(), date) <= 7 GROUP BY date");
	if(is_array($clicks))		{
		foreach($clicks as $key=>$row)	{
			$string	.=	"['".$row['date']."',  ".$row['clicks']."],";
		
		}
	}
?>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Clicks'],
		  <?php echo $string ?>
        ]);

        var options = {
          title: ''
        };

        var chart = new google.visualization.LineChart(document.getElementById('click_chart'));

        chart.draw(data, options);
      }
    </script>
    <?php } ?>