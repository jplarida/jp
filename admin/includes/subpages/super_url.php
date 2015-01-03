
                 <tr id="su_<?php echo $GET['id']; ?>" style="display:none;"><th colspan="7" > 
                <div class="portlet-body flip-scroll">
                  <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                      <tr>
                        <th>Product</th>
                       
                        <th>Short Link</th>
                        <th>Added Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
								 
		 $query 		=	mysql_query("SELECT su.*,p.asin ,p.name as pname FROM super_url su, products p WHERE su.user_id = $id AND su.product_id = p.id ");		
		 if(mysql_num_rows($query) > 0){
		  $i						=	1;
  while($row		=	mysql_fetch_array($query))	{

	  ?>
                      <tr class="odd" id="s<?php echo $row['id']; ?>">
                        <td><a onClick="showSUDetail('<?php echo 'su_'.$row['id']; ?>');" href="javascript:void(0)"><strong>> <?php echo $row['pname']; ?></strong></a></td>
                        <?php 
						
						$url	=	 googleUrlShort(SITE_URL."goSuperUrl.php?ie=".md5(SITE_URL).md5(SITE_URL)."&cmd=superUrl&id=".$row['id']."&pid=".$row['product_id']);
						
						?>
                        <td><a href="<?php echo $url; ?>" target="_blank" ><?php echo $url;  ?></a></td>
                        <td><?php echo $row['date_time']; ?></td>
                      </tr>
                      <?php include('super_url_detail.php'); ?>

                      <?php }?>
                    </tbody>
                    <?php }else {
						
						 ?>
                    <tr>
                      <th colspan="7"><?php echo "Sorry! Your have not any super URL. :("; ?> </th>
                    </tr>
                    <?php } ?>
                    <tr>
                      
                    </tr>
                  </table>
               </div>
              

         </th>
</tr>
