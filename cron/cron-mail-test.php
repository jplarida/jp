<?php



function sendEmail($message)	{
	$to      = 'link2qaiser@gmail.com';
	$subject = 'Assignment';

	
	$headers = 'From: support@dixeam.com' . "\r\n" .
		'Reply-To: support@dixeam.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	
	mail($to, $subject, $message, $headers);
}





ob_start( ); // start output buffering

require_once('keywork-rank.php');

$Buffer = ob_get_contents(); // get the output

ob_end_clean( ); // stop output buffering

sendEmail($Buffer);



?> 