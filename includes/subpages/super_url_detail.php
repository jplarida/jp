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
            <th class="numeric">Action</th>
          </tr>
        </thead>
        <tbody>
       <?php foreach($sud_row as $key=>$krow)	{ ?>
          <tr id="keyword_<?php echo $krow['id']; ?>">
            <td class="numeric"><?php echo $krow['keyword']; ?></td>
            <td class="numeric"><?php echo $krow['clicks']; ?></td>
            <td class="numeric">
            <?php 
			if($sum_row != "0")	{
				echo (($krow['clicks'] / $sum_row['tsum'] ) * 100)."%";
			}else {
				echo "0%";
			}
			?>
            </td>
            <td><a onclick="deleteRecord('keyword_<?php echo $krow['id']; ?>','<?php echo $krow['id']; ?>','super_url_detail','<td colspan=4>Keyword is deleted sucessfully</td>');" href="javascript:void(0);"><span class="label label-sm label-info">Delete</span></a></td>
          </tr>
          <?php } ?>
          <tr id="key_area">
              <td><input type="text" class="form-control" id="key_valye<?php echo $row['id']; ?>" placeholder="Enter keywork text here"></td>
              <td colspan="3"><button onClick="addSUKeyword('<?php echo $row['id']; ?>');" type="button" class="btn btn-success">Add Keyowrd</button></td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</th>
<?php } ?>
