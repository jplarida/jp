
           
           
           
           
                <tr id="pr_<?php echo $GET['id']; ?>" style="display:none;"><th colspan="7" > 
                  
                  <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                      <thead class="flip-content">
                        <tr >
                          <th>Name</th>
                          <th>ASIN</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
								 
		 $query 		=	mysql_query("SELECT * from products where user_id =$id");		
		 if(mysql_num_rows($query) > 0){
		  $i						=	1;
  while($row		=	mysql_fetch_array($query))	{

	  ?>
                        <tr class="odd" id="s<?php echo $row['id']; ?>">
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['asin']; ?></td>
                          </tr>
                        <?php }?>
                      </tbody>
                      <?php }else {
						
						 ?>
                      <tr>
                        <th colspan="7"><?php echo "Sorry! Your have no record :("; ?> </th>
                      </tr>
                      <?php } ?>
                    </table>
                  </div>
                 
         </th>
</tr>
