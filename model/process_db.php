<?php
/*
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	11-20-2025
	Filename:	process_db.php
	
	Incomplete record found, update it with signout datetime
*/
require_once '../errors/errorLog.php';
function update_log($existLogRecord) {
	try {
		global $pdo;
		// example is student_ID 30 Sheila McCoy smccoy2
		$query= "UPDATE log SET log_signout = NOW(), log_updated = NOW() WHERE log_ID = ?";
		$statement = $pdo->prepare($query);
		$statement->execute([$existLogRecord['log_ID']]);

		// Close statement, release the resources and memory associated
		$statement->closeCursor();
						
	} catch (PDOException $e) {
		errorLog('update log',$e);
	}
}
/*
 Retrieves the student data based on the student email.
*/
function get_student_by_email($student_email) {
	try {
		global $pdo;
		// SQL query using a placeholder (?)
		$query = "SELECT student_ID, student_fname, student_lname FROM students WHERE student_email = ?";
		// Prepare the statement to prevent SQL injection
		$statement = $pdo->prepare($query);
		// Bind the parameter and execute the query
		$statement->execute([$student_email]);
		// Fetch the row as an associative array
		$studentData = $statement->fetch(PDO::FETCH_ASSOC);
		// Check if a student was found
		
		// Close statement, release the resources and memory associated
		$statement->closeCursor();
		
		if ($studentData) {
			return $studentData;
		} else {
			return null; // No student found with that email
		}
	} catch (PDOException $e) {
		errorLog('select students',$e);
	}		
}
/*
 Retrieves the log_ID based on the student_ID.
*/
function get_log_by_student($student_ID) {
	try {
		global $pdo;
		// SQL query using a placeholder (?)
		$query = "SELECT log_ID FROM log WHERE log_student_ID = ? AND log_signout IS NULL";
		// Prepare the statement to prevent SQL injection
		$statement = $pdo->prepare($query);
		// Bind the parameter and execute the query
		$statement->execute([$student_ID]);
		// Fetch the row as an associative array
		$existLogRecord = $statement->fetch(PDO::FETCH_ASSOC);
		// Close statement, release the resources and memory associated
		$statement->closeCursor();
		
		if ($existLogRecord) {
			return $existLogRecord;
		} else {
			return null; // No student found with that email
		}
	} catch (PDOException $e) {
		errorLog('select get log by student',$e);
	}
}
?>