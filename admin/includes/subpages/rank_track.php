 <tr id="ra_<?php echo $GET['id']; ?>" style="display:none;"><th colspan="7" > 
                <div class="portlet-body flip-scroll">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                      <tr>
                        <th>Product</th>
                       
                        <th>Added</th>
                       <!-- <th>Top Keyword</th>
                        <th>Last Update</th>-->
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
								 
		 $rank_row 		=	$sql_obj->QFetchRowArray("SELECT rt.* FROM rank_tracker rt
          WHERE rt.user_id = $id ");		
		 if(is_array($rank_row)){
			 foreach($rank_row as $key=>$row)	{

	  ?>
                      <tr  class="odd" id="s<?php echo $row['id']; ?>">
                      <td><a onClick="showRankDetails('ra_<?php echo $row['id'] ?>');" href="javascript:void(0)"><strong>> <?php echo getProductName($row['product_id']);  ?></strong></a></td>
                      
                        
                        <td><?php echo ago(strtotime($row['date_time'])); ?></td>
                      </tr>
                      <?php include('rank_tracker_detail.php'); ?>
                      
                      
                      <?php }?>
                    </tbody>
                    <?php }else {
						
						 ?>
                    <tr>
                      <th colspan="7"><?php echo "Sorry! No record found. :("; ?> </th>
                    </tr>
                    <?php } ?>
                  </table>
                     </div>
               

         </th>
</tr>
      