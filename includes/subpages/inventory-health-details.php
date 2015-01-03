 <?php 
  $sud_row		=	$sql_obj->QFetchRowArray("SELECT * FROM inventory_health_detail  WHERE asin = '".$row['asin']."'");
  


 
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
            <th >Product Name</th>
            <th >MSKU</th>
            <th class="numeric">Total Sellable Quantity</th>
            <th class="numeric">Sales Price</th>
            <th class="numeric">Cost Per Unit</th>
            <th class="numeric">Total Cost</th>
            <th class="numeric">Unit Shipped Last 30 Days</th>
            <th class="numeric">Days Till Empty</th>
          </tr>
        </thead>
        <tbody>
       <?php foreach($sud_row as $key=>$krow)	{ ?>
          <tr id="keyword_<?php echo $krow['id']; ?>">
            <td class="numeric"><?php echo $krow['keyword']; ?></td>
            <td class="numeric"><?php echo $krow['clicks']; ?></td>
            <td class="numeric"></td>
             <tr id="keyword_<?php echo $krow['id']; ?>">
            <td class="numeric"><?php echo $krow['keyword']; ?></td>
            <td class="numeric"><?php echo $krow['clicks']; ?></td>
            <td class="numeric"></td>
            
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
