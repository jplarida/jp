
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    
    <?php
$clicks = 	$sql_obj->RowCount("click_details", "WHERE click_id = '".$row['id']."'" );

?>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Clicks'],
          ['Jan',  <?php echo $clicks; ?>      ],
          ['Feb',  <?php echo $clicks; ?>      ],
          ['March',  <?php echo $clicks; ?>      ],
          ['April',  <?php echo $clicks; ?>      ],
		  ['May',  <?php echo $clicks; ?>      ],
		  ['June',  <?php echo $clicks; ?>      ],
		  ['July',  <?php echo $clicks; ?>      ],
		  ['Aug',  <?php echo $clicks; ?>      ],
		  ['Sep',  <?php echo $clicks; ?>      ],
		  ['Oct',  <?php echo $clicks; ?>      ],
		  ['Nov',  <?php echo $clicks; ?>      ],
		  ['Dec',  <?php echo $clicks; ?>      ]
        ]);

        var options = {
          title: ''
        };

        var chart = new google.visualization.LineChart(document.getElementById('click_chart'));

        chart.draw(data, options);
      }
    </script>
  