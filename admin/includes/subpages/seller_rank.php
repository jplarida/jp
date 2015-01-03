<tr id="sr_<?php echo $GET['id']; ?>" style="display:none;"><th colspan="7" >
                <div class="portlet-body flip-scroll">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                      <tr>
                        <th>Product</th>
                        <th>Note</th>
                        <th>Last Rank</th>
                        <th>Added Date</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
								 
								 function getLastSellerRank($id)	{
									 global $sql_obj;
									 $row	=	$sql_obj->QFetchArray("SELECT seller_rank FROM seller_rank_detail WHERE seller_rank_id = '$id' ORDER BY date_time DESC LIMIT 1");
									 return $row['seller_rank'];
								 }
		 $query 		=	mysql_query("SELECT sr.*,p.asin ,p.name as pname FROM seller_rank sr, products p WHERE sr.user_id = $id AND sr.product_id = p.id ");		
		 if(mysql_num_rows($query) > 0){
		  $i						=	1;
  while($row		=	mysql_fetch_array($query))	{

	  ?>
                      <tr class="odd" id="s<?php echo $row['id']; ?>">
                        <td><a href="#form_modal<?php echo $row['id']; ?>"  data-toggle="modal" >> <?php echo $row['pname']; ?></strong></a></td>
                       <td><?php echo $row['note']; ?></td>
                       <td style="color:#900; "><?php echo getLastSellerRank($row['id']); ?></td>
                       
                       <td><?php echo $row['date_time']; ?></td>
        
                   
                      </tr>
                      <?php include('plugins/seller-rank-chart.php'); ?>

                      <?php }?>
                    </tbody>
                    <?php }else {
						
						 ?>
                    <tr>
                      <th colspan="7"><?php echo "Sorry! Your have not any record. :("; ?> </th>
                    </tr>
                    <?php } ?>
                    <tr>
                      
                    </tr>
                  </table>
                   </div>
               

         </th>
</tr>
      
               