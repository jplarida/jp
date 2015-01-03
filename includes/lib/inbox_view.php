<?php require_once('../includes/lib/db_con.php'); 

	$id =  $_GET['name'];
	$result = mysql_query("select * from message where id = '$id' ");//  where to_id  = 'adeel'
	$msg  = mysql_fetch_assoc($result);
?>
<div class="inbox-header inbox-view-header">
	<h1 class="pull-left"><?php echo $msg['sub'] ?></h1>
	<div class="pull-right"><i class="icon-print"></i></div>
</div>
<div class="inbox-view-info row-fluid">
	<div class="span7">
		<img src="assets/img/avatar1_small.jpg"> 
		<span class="bold"><?php echo $msg['from_id'] ?></span>
		<span>&#60;support@go.com&#62;</span> to <span class="bold"><?php echo $msg['to_id'] ?></span> on 
		<?php  
		$old_date_timestamp = strtotime($msg['recieve_date']);
		$new_date = date('d M Y, H:i A', $old_date_timestamp); 
		echo $new_date;
		  ?>
	</div>
	<div class="span5 inbox-info-btn">
		<div class="btn-group">
			<button class="btn blue reply-btn">
			<i class="icon-reply"></i> Reply
			</button>
			<button class="btn blue  dropdown-toggle" data-toggle="dropdown">
			<i class="icon-angle-down"></i>
			</button>
			<ul class="dropdown-menu pull-right">
			<li><a href="#"><i  id="abbr" class="icon-reply reply-btn "></i> Reply</a></li>
			<li><a href="#"><i class="icon-arrow-right reply-btn"></i> Forward</a></li>
			<li><a href="#"><i class="icon-print"></i> Print</a></li>
			<li class="divider"></li>
			<li><a href="#"><i class="icon-ban-circle"></i> Spam</a></li>
			<li><a href="#"><i class="icon-trash"></i> Delete</a></li>
			<li>
		</div>
	</div>
</div>
<div class="inbox-view">
<p><?php echo $msg['message_body'] ?></p>
</div>
<hr>
<div class="inbox-attached">
<div class="margin-bottom-15">
<span>3 attachments —</span> 
<a href="#">Download all attachments</a>   
<a href="#">View all images</a>   
</div>
<div class="margin-bottom-25">
<img src="assets/img/gallery/image4.jpg">
<div>
<strong>image4.jpg</strong>
<span>173K</span>
<a href="#">View</a>
<a href="#">Download</a>
</div>
</div>
<div class="margin-bottom-25">
<img src="assets/img/photo2.jpg">
<div>
<strong>IMAG0705.jpg</strong>
<span>14K</span>
<a href="#">View</a>
<a href="#">Download</a>
</div>
</div>
<div class="margin-bottom-25">
<img src="assets/img/gallery/image5.jpg">
<div>
<strong>test.jpg</strong>
<span>132K</span>
<a href="#">View</a>
<a href="#">Download</a>
</div>
</div>
</div>