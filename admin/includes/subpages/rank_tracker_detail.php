<?php 

 $sud_row		=	$sql_obj->QFetchRowArray("SELECT * FROM rank_tracker_keywords  WHERE rank_tracker_id = '".$row['id']."'");
  
 if(is_array($sud_row))	{
 ?>

<tr id="ra_<?php echo $row['id']; ?>" style="display:none;">
  <th colspan="7" > <div class="portlet box green">
      <div class="portlet-title">
        <div class="caption">Detial Keyword</div>
      </div>
      <div class="portlet-body flip-scroll">
        <table class="table table-bordered table-striped table-condensed flip-content">
          <thead class="flip-content">
            <tr>
              <th class="numeric">Keyword</th>
              <th>Current Position</th>
              <th>Last Update</th>
              
            </tr>
          </thead>
          <tbody>
          
            <?php foreach($sud_row as $key=>$krow)	{ ?>
            <tr id="keyword_<?php echo $krow['id']; ?>">
              <td class="numeric">>&nbsp;<strong><a href="#form_modal<?php echo $krow['id']; ?>"  data-toggle="modal" ><?php echo str_replace("+"," ",$krow['keyword']); ?></a></strong></td>
              <?php
			  $high_rank	=	getHigestRank($krow['id']);
			  
			  ?>
              <td><?php if($high_rank != 0) echo $high_rank; else echo "--"; ?></td>
              <td><?php if($high_rank['rank'] != 0) echo getLastUpdateDate($krow['id']); else echo "--"; ?></td>
              
            </tr>
            <?php include('includes/subpages/rank-tracker-chart.php');?>
            <?php } ?>
           
          </tbody>
        </table>
      </div>
    </div>
  </th>
</tr>
<?php } ?>
