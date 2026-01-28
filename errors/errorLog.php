<?php
/*
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Chaz
	Created:	11-19-2025
	Updated:	12-07-2025 Jay King
	Filename:	errorLog.php
*/
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function errorLog($errorMsg, $e=null) {
	// The message to log, including a timestamp for better context
	if ($e==null) {
		$log_message = "[".date("Y-m-d H:i:s")."] ".$errorMsg.PHP_EOL;
		error_log($log_message, 3, "../errors/error.log");
	} else {
		$log_message = "[".date("Y-m-d H:i:s"). "] ".$e->getMessage().PHP_EOL;
		error_log($log_message, 3, "../errors/error.log");
		error_log($e->getTraceAsString().PHP_EOL,3, "../errors/error.log");
	}
	$_SESSION['errorLog'] = $errorMsg;
	// problems with header allready called
	// header('Location: ../errors/error.php');
	// exit();
	
die ('<div style="color:black;
	font-size: 4.0vw;
	font-weight: 600;
    text-align: center;
	border-radius: 1vw;
    border: 0.4vw solid red;
    box-shadow: 0 0.5vw 1.1vw rgba(0, 0, 0, 0.15);
    background-color: #f3f3f3;
    width: 70vw;
    padding: 0.5vw 0.5vw 2vw 0.5vw;
    margin:5vh auto 10vh auto;">'
. '<h2>ERROR in '
. $_SESSION['errorLog']
. '</h2><br>'
. 'There was an error connecting to the database.'
. '<br><br>'
. 'Please contact support as soon as possible.'
. '<br><br>'
. 'The error.log has captured this error.'
. '</div>');	
}
?>
