<?php session_start();
/*
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	12-07-2025
	Filename:	progress.php
		
*/
require_once '../errors/errorLog.php';
include '../model/database.php';
include '../model/logs_db.php';
include '../model/process_db.php';
$browseFlag = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// use the Null Coalescing Operator for undefined array
	$action = htmlspecialchars($_POST['action'] ?? '');
	$log_ID = $_POST['log_ID'];

	if ($action == "Next") {
		$_SESSION['statusFlag'] = 8;
		
		if ($_SESSION['orderBy'] == "Student") {
			$logs = get_logs_student_order();		
		} elseif ($_SESSION['orderBy'] == "Course") {
			$logs = get_logs_course_order();
		} else {
			$_SESSION['orderBy'] = "DateTime";
			$logs = get_logs_updated_order();
		}

		$logIDs = array_column($logs, 'log_ID');
		$index = array_search($log_ID, $logIDs);

		// avoid "Offset Not Found", verify the index exists
		if (isset($logIDs[$index + 1])) {
			$log_ID = $logIDs[$index + 1];
			$_SESSION['log_ID'] = $log_ID;
		} else {
			$_SESSION['statusFlag'] = -8;
		}	
	} elseif ($action == "Previous") {
		$_SESSION['statusFlag'] = 9;
		
		if ($_SESSION['orderBy'] == "Student") {
			$logs = get_logs_student_order();		
		} elseif ($_SESSION['orderBy'] == "Course") {
			$logs = get_logs_course_order();
		} else {
			$_SESSION['orderBy'] = "DateTime";
			$logs = get_logs_updated_order();
		}		
		
		$logIDs = array_column($logs, 'log_ID');
		$index = array_search($log_ID, $logIDs);
		// avoid "Offset Not Found", verify the index exists

		if ($index > 0) {
			$log_ID = $logIDs[$index - 1];
			$_SESSION['log_ID'] = $log_ID;
		} else {
			$_SESSION['statusFlag'] = -9;
		}
	// 	updates log record and returns to log record
	} elseif ($action == "Update") {
		$_SESSION['statusFlag'] = 10;
		$existLogRecord = get_log_by_ID($log_ID);
		if ($existLogRecord) {
			// incomplete record found, update it with signout datetime;	
			update_log($existLogRecord);
		}

	// 	deletes log record and returns to log browse
	} elseif ($action == "Delete") {
		$_SESSION['statusFlag'] = 11;
		// string into an integer using type casting
		$log_ID = (int) $_POST['log_ID'];
		if ($log_ID<1) {
			// error log exit
			errorLog('progress.php, Invalid log_ID');
		}
		delete_log_by_ID($log_ID);
		$browseFlag = 1;
	}
}
if ($browseFlag == 1) {
	// redirects back to the browse page
	header('Location: ../admin/logBrowse.php');
	exit();
} else {
	header("Location: ../admin/logRecord.php?id=$log_ID");
	exit();
}
?>