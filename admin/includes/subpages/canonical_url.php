<tr id="cu_<?php echo $GET['id']; ?>" style="display:none;"><th colspan="7" >
                  <div class="portlet-body flip-scroll">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                      <thead class="flip-content">
                        <tr>
                          <th>Url</th>
                          <th>Refine Url</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
								 
		 $query 		=	mysql_query("SELECT * from canonical_url where user_id = $id");		
		 if(mysql_num_rows($query) > 0){
		  $i						=	1;
  while($row		=	mysql_fetch_array($query))	{

	  ?>
                        <tr class="odd" id="s<?php echo $row['id']; ?>">
                          <td><a target="_blank" href="<?php echo $row['../../url']; ?>"><?php echo $row['url']; ?></a></td>
                          <td><a target="_blank" href="<?php echo $row['../../refine_url']; ?>"><?php echo $row['refine_url']; ?></a></td>
                          
                        </tr>
                        <?php }?>
                      </tbody>
                      <?php }else {
						
						 ?>
                      <tr>
                        <th colspan="7"><?php echo "Sorry! Your have not any super URL. :("; ?> </th>
                      </tr>
                      <?php } ?>
                    </table>
                     </div>
              

         </th>
</tr>
      