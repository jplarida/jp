<?php

function goUrll($path = NULL){
	if(!empty($path) || !is_null($path)){
		?>
        <script>window.location.href = '<?php echo $path;?>';</script>
        <?php
	}
}


if(!isset($_SESSION['admin_type_id'])){
	goUrll("login.php");
	}


?>