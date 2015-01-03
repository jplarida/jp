<?php 
require_once('../includes/lib/includes.php');  

if(isset($_GET['id']))
{$id= $_GET['id'];}

if(isset($_GET['cmd']) && $_GET['cmd'] == "superUrl")	{
	$date 				=   date('Y-m-d H:i:s');
	
	global $sql_obj;	
	$sql_obj->Query("insert into click_details(click_id,date)values('".$_GET['id']."','$date')");
	$row				=	$sql_obj->QFetchArray("SELECT * from super_url WHERE id = '".$_GET['id']."'");
	goUrl($amazone_obj->getSuperUrl($row['target_url'],$row['keywords']));
	die();
}

if(isset($_GET['cmd']) && $_GET['cmd'] == "del")	{
	
	 $id			=	$_GET['id'];
	$sql_obj->Query("DELETE FROM canonical_url WHERE id = '$id'");
	 goUrl("canonical-url.php?msg=:) Super URL Deleted sucessfully.#tab_1");
}




if(isset($_POST['submit'])) {
	
  	$url   	     =       mysql_real_escape_string($_POST['url']);
	
if($sql_obj->RowCount("canonical_url", "WHERE url =  '$url' " ) == 0){
	
	$refine_url	=		$amazone_obj->canonicalUrl($url);
	
	//QUERY OF INSERTION
	$sql_obj->Query("insert into 	
		  			canonical_url(url,refine_url,user_id)
					values('$url','$refine_url','".$_SESSION['user_id']."')
					") or die(mysql_error());
					
	//REDIRECT
	goUrl("canonical-url.php?msg=:) Canonical URL added sucessfully.#tab_1");
  
}else{
	$_GET['msg'] =  "Canonical URL already exist. :(";
}

  

}

?>
<?php require_once('includes/subpages/header.php'); ?>
<div class="page-container"> 
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar navbar-collapse collapse"> 
    <!-- BEGIN SIDEBAR MENU -->
    <?php require_once('includes/subpages/sidebar.php'); ?>
    
    <!-- END SIDEBAR MENU --> 
  </div>
  <!-- END SIDEBAR --> 
  <!-- BEGIN PAGE -->
  <div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body"> Widget settings form goes here </div>
          <div class="modal-footer">
            <button type="button" class="btn blue">Save changes</button>
            <button type="button" class="btn default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content --> 
      </div>
      <!-- /.modal-dialog --> 
    </div>
    <!-- /.modal --> 
    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM--> 
    <!-- BEGIN STYLE CUSTOMIZER -->
    <?php require_once('includes/subpages/theme-style.php'); ?>
    
    <!-- END BEGIN STYLE CUSTOMIZER --> 
    <!-- BEGIN PAGE HEADER-->
    <div class="row">
      <div class="col-md-12"> 
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title"> Canonical URL </h3>
        <ul class="page-breadcrumb breadcrumb">
          <!--<li class="btn-group">
            <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> <span>Actions</span> <i class="fa fa-angle-down"></i> </button>
            <ul class="dropdown-menu pull-right" role="menu">
              <li><a href="?cmd=refresh&page=feedbacks">Refresh</a></li>
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </li>-->
          <li> <i class="fa fa-home"></i> <a href="index.php">Home</a> <i class="fa fa-angle-right"></i> </li>
          <li> <a href="#">Canonical URL</a> </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
      <div class="col-md-12">
        <?php if(isset($_GET['msg'])){ getSucessMessage($_GET['msg']); } 
		if(isset($msg)){ getSucessMessage($msg); } 
		if(isset($not)){ getErrorMessage($not); } 
		 ?>
        <div class="col-md-12"> 
          <div class="tabbable tabbable-custom boxless">
           
            <div class="tab-content">
              
              <div class="tab-pane active" id="tab_1">
                <div class="portlet box green">
                  <div class="portlet-title">
                    <div class="caption"><i class="fa fa-link"></i>URL Listing</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                  </div>
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
                          <td><a target="_blank" href="<?php echo $row['url']; ?>"><?php echo $row['url']; ?></a></td>
                          <td><a target="_blank" href="<?php echo $row['refine_url']; ?>"><?php echo $row['refine_url']; ?></a></td>
                          
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
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END PAGE CONTENT--> 
      </div>
      <!-- END PAGE --> 
    </div>
  </div>
  <div id="form_modal10" class="modal fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title">Add Product</h4>
        </div>
        <form onSubmit="return addProducts();"  class="form-horizontal" role="form" method="post" action="">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Url:</label>
              <div class="col-md-7">
                <textarea required class="form-control" name="url"  placeholder="http://"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4"></label>
              <div class="col-md-8"> <span id="edit-errorr" class="alert-danger" style="background:none;"></span> </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn green"  name="submit" type="submit">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require_once('includes/subpages/footer.php'); ?>
