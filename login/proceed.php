<?php
session_start();
/*
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	11-20-2025
	Filename:	proceed.php
	
	a form action from login.php
*/
require '../model/database.php';
include '../model/proceed_db.php';
include '../model/logs_db.php';
$student_ID = $_SESSION['student_ID'];
$course_ID = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// string into an integer using type casting
	$course_ID = (int) $_POST['course_ID'];
	$student_ID = (int) $_POST['student_ID'];	
	$_SESSION['course_ID'] = $course_ID;
	$_SESSION['student_ID'] = $student_ID;
	add_log_entry($student_ID, $course_ID);
	$log_ID = get_last_log_ID();
	$_SESSION['statusFlag'] = 0;
	$_SESSION['log_ID'] = $log_ID;
	// confirmed log inserted
	header("Location: ../login/confirmLogEntry.php?id=$log_ID");
	exit();	
}
?>
