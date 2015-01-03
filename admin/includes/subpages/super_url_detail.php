 <?php 
 $sud_row		=	$sql_obj->QFetchRowArray("SELECT * FROM super_url_detail sud WHERE sud.super_url_id = '".$row['id']."'");
 $sum_row		=	$sql_obj->QFetchArray("SELECT SUM(sud.clicks) AS tsum FROM super_url_detail sud WHERE sud.super_url_id = '".$row['id']."'");
 
 if(is_array($sud_row))	{
 ?>
<th colspan="7" id="su_<?php echo $row['id']; ?>" style="display:none;"> <div class="portlet box green">
    <div class="portlet-title">
      <div class="caption">Detial Keyword</div>
    </div>
    <div class="portlet-body flip-scroll">
      <table class="table table-bordered table-striped table-condensed flip-content">
        <thead class="flip-content">
          <tr>
            <th class="numeric">Keyword</th>
            <th class="numeric">Total Clicks</th>
            <th class="numeric">Percentage</th>
          </tr>
        </thead>
        <tbody>
       <?php foreach($sud_row as $key=>$row)	{ ?>
          <tr>
            <td class="numeric"><?php echo $row['keyword']; ?></td>
            <td class="numeric"><?php echo $row['clicks']; ?></td>
            <td class="numeric">
            <?php 
			if($sum_row != "0")	{
				echo (($row['clicks'] / $sum_row['tsum'] ) * 100)."%";
			}else {
				echo "0%";
			}
			?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</th>
<?php } ?>
