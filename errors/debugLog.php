<?php
/*
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	12-05-2025
	Filename:	errors/debugLog.php
*/
function debugLog($bugLocation) {
	$log_entry = date('Y-m-d H:i:s')
	. " ".$bugLocation
	. "\r\n"
	. " flag: "
	. $_SESSION['statusFlag']
	. "\r\n"
	. " error log: "
	. $_SESSION['errorLog']
	. "\r\n"
	. " order by: "
	. $_SESSION['orderBy']	
	. "\r\n"	
	. " student_ID: "
	. $_SESSION['student_ID']
	. "\r\n"
	. " student_fname: "
	. $_SESSION['student_fname']
	. "\r\n"
	. " student_lname: "
	. $_SESSION['student_lname']
	. "\r\n"
	. " student_email: "
	. $_SESSION['student_email']
	. "\r\n"
	. " student_major: "
	. $_SESSION['student_major']
	. "\r\n"
	. " student_email: "
	. $_SESSION['student_email']
	. "\r\n"
	. " usernameInput: "
	. $_SESSION['usernameInput']
	. "\r\n"
	. " course_ID: "
	. $_SESSION['course_ID']
	. PHP_EOL;
	$log_file = '../errors/debug.log';
	file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
}