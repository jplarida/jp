<?php 

 $sud_row		=	$sql_obj->QFetchRowArray("SELECT * FROM rank_tracker_keywords  WHERE rank_tracker_id = '".$row['id']."'");
  
 if(is_array($sud_row))	{
 ?>

<tr id="ra_<?php echo $row['id']; ?>" style="display:none;">
  <th colspan="7" > <div class="portlet box green">
      
      <div class="portlet-body flip-scroll">
        <table class="table table-bordered table-striped table-condensed flip-content">
          <thead class="flip-content">
            <tr>
              <th class="numeric">Keyword</th>
              <th>Current Position</th>
              <th>Last Update</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          
            <?php foreach($sud_row as $key=>$krow)	{ ?>
            <tr id="keyword_<?php echo $krow['id']; ?>">
              <td class="numeric">>&nbsp;<strong><a href="#form_modal<?php echo $krow['id']; ?>"  data-toggle="modal" ><?php echo str_replace("+"," ",$krow['keyword']); ?></a></strong></td>
              <?php
			  $high_rank	=	getCurrentRank($krow['id']);
			  
			  ?>
              <td>
              <a  href="http://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=<?php echo str_replace("+"," ",$krow['keyword']); ?>" target="_blank" >
			  <?php if($high_rank != 0) echo $high_rank; else echo "--"; ?>
              </a>
              </td>
              <td><?php if($high_rank['rank'] != 0) echo getLastUpdateDate($krow['id']); else echo "--"; ?></td>
              <td><a onClick="deleteRecord('keyword_<?php echo $krow['id']; ?>','<?php echo $krow['id']; ?>','rank_tracker_keywords','<td colspan=4>Keyword is deleted sucessfully</td>');" href="javascript:void(0);" ><span class="label label-sm label-info">Delete</span></a></td>
            </tr>
            <?php include('includes/subpages/rank-tracker-chart.php');?>
            <?php } ?>
            <tr id="key_area<?php echo $row['id']; ?>">
              <td><input type="text" class="form-control" id="key_valye<?php echo $row['id']; ?>" placeholder="Enter keywork text here"></td>
              <td colspan="3"><button onClick="addRTKeyword('<?php echo $row['id']; ?>');" type="button" class="btn btn-success">Add Keyowrd</button>&nbsp;&nbsp;<span id="usermsg<?php echo $row['id']; ?>" style="display:none;">This keyword alredy exist</span></td>
              
              
            </tr>
            
          </tbody>
        </table>
      </div>
    </div>
  </th>
</tr>
<?php }else{ ?>

<tr id="ra_<?php echo $row['id']; ?>" style="display:none;">
  <th colspan="7" > <div class="portlet box ">
      
      <div class="portlet-body flip-scroll">
        <table class="table table-bordered table-striped table-condensed flip-content">
          <thead class="flip-content">
            <tr>
              <th class="numeric">Keyword</th>
              <th>Current Position</th>
              <th>Last Update</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          
            <?php foreach($sud_row as $key=>$krow)	{ ?>
            <tr id="keyword_<?php echo $krow['id']; ?>">
              <td class="numeric">>&nbsp;<strong><a href="#form_modal<?php echo $krow['id']; ?>"  data-toggle="modal" ><?php echo str_replace("+"," ",$krow['keyword']); ?></a></strong></td>
              <?php
			  $high_rank	=	getCurrentRank($krow['id']);
			  
			  ?>
              <td><?php if($high_rank != 0) echo $high_rank; else echo "--"; ?></td>
              <td><?php if($high_rank['rank'] != 0) echo getLastUpdateDate($krow['id']); else echo "--"; ?></td>
              <td><a onClick="deleteRecord('keyword_<?php echo $krow['id']; ?>','<?php echo $krow['id']; ?>','rank_tracker_keywords','<td colspan=4>Keyword is deleted sucessfully</td>');" href="javascript:void(0);" ><span class="label label-sm label-info">Delete</span></a></td>
            </tr>
            <?php include('includes/subpages/rank-tracker-chart.php');?>
            <?php } ?>
            <tr id="key_area<?php echo $row['id']; ?>">
              <td><input type="text" class="form-control" id="key_valye<?php echo $row['id']; ?>" placeholder="Enter keywork text here"></td>
              <td colspan="3"><button onClick="addRTKeyword('<?php echo $row['id']; ?>');" type="button" class="btn btn-success">Add Keyowrd</button>&nbsp;&nbsp;<span id="usermsg<?php echo $row['id']; ?>" style="display:none;">This keyword alredy exist</span></td>
              
              
            </tr>
            
          </tbody>
        </table>
      </div>
    </div>
  </th>
</tr>


<?php } ?>