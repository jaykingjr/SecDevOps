<?php
session_start();
/*
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	11-20-2025
	Filename:	placing.php

	places new student into stundents file
	form action from register.php
	goes to confirm.php then to login.php

Students Table
student_ID | INT(10)
student_fname | VARCHAR(50)
student_lname | VARCHAR(50)
student_email | VARCHAR(100)
student_major | VARCHAR(100)
student_updated | DATETIME

*/
require '../model/database.php';
include '../model/students_db.php';
$_SESSION['statusFlag'] = 3; // default to add record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$action = htmlspecialchars($_POST['action']);
	
	$student_ID = $_POST['student_ID'];
	$student_fname = $_POST['student_fname'];
	$student_lname = $_POST['student_lname'];
	$student_email = $_POST['student_email'];
	$student_major = $_POST['student_major'];

	$_SESSION['student_ID'] = $student_ID;
	$_SESSION['student_fname'] = $student_fname;
	$_SESSION['student_lname'] = $student_lname;
	$_SESSION['student_email'] = $student_email;
	$_SESSION['student_major'] = $student_major;

	if ($action == "Next") {
		$_SESSION['statusFlag'] = 5;
		$students = get_students_lname_order();
		$studentIDs = array_column($students, 'student_ID');
		$index = array_search($student_ID, $studentIDs);
		// avoid "Offset Not Found", verify the index exists
		if (isset($studentIDs[$index + 1])) {
			$student_ID = $studentIDs[$index + 1];
			$_SESSION['student_ID'] = $student_ID;
		} else {
			$_SESSION['statusFlag'] = -5;
		}
		header('Location: register.php');
		exit();
	} elseif ($action == "Previous") {
		$_SESSION['statusFlag'] = 6;
		$students = get_students_lname_order();
		$studentIDs = array_column($students, 'student_ID');
		$index = array_search($student_ID, $studentIDs);
		// avoid "Offset Not Found", verify the index exists

		if ($index > 0) {
			$student_ID = $studentIDs[$index - 1];
			$_SESSION['student_ID'] = $student_ID;
		} else {
			$_SESSION['statusFlag'] = -6;
		}

		header('Location: register.php');
		exit();
	// updates student record and returns to student list
	} elseif ($action == "Update") {
		$_SESSION['statusFlag'] = 4;
		$student_ID = filter_input(INPUT_POST, 'student_ID', FILTER_VALIDATE_INT);
		$student_fname = filter_input(INPUT_POST, 'student_fname', FILTER_SANITIZE_STRING);
		$student_lname = filter_input(INPUT_POST, 'student_lname', FILTER_SANITIZE_STRING);
		$student_email = filter_input(INPUT_POST, 'student_email', FILTER_SANITIZE_EMAIL);
		$student_major = filter_input(INPUT_POST, 'student_major', FILTER_SANITIZE_STRING);
		if (!$student_ID || !$student_fname || !$student_lname || !$student_email || !$student_major) {
			// error log exit
			errorLog('placing.php, Invalid input data');
		}
		update_student($student_fname,$student_lname,$student_email,$student_major,$student_ID);
		// redirects back to the browse page after update
		header('Location: ../admin/studentsBrowse.php');
		exit();
	// 	deletes student record & returns to studentList
	} elseif ($action == "Delete") {
		$_SESSION['statusFlag'] = 7;
		// string into an integer using type casting
		$student_ID = (int) $_POST['student_ID'];
		if ($student_ID<1) {
			// error log exit
			errorLog('placing.php, Invalid student_ID');
		}
		// if log exist for student then no delete
		if (exist_student_in_log($student_ID)) {
			$_SESSION['student_ID'] = $student_ID;
			$_SESSION['statusFlag'] = -7;
			header('Location: register.php');
			exit();
		} else {
			delete_student_by_ID($student_ID);
			$_SESSION['student_ID'] = 0;
			// redirects back to the browse page
			header('Location: ../admin/studentsBrowse.php');
			exit();
		}

	// new student added and returns to confirm
	} elseif ($action == "Register") {
		// flag that informs confirm.php and register.php
		add_new_student($student_fname, $student_lname, $student_email,$student_major);
		header('Location: confirmStudent.php');
		exit();
	} else {
		// If accessed directly without POST, redirect to browse page
		header('Location: ../admin/studentsBrowse.php');
		exit();
	}
}
?>