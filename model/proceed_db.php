<?php
/*
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	11-20-2025
	Filename:	proceed_db.php
	
	Add a new log record with student_ID, courseID, sign-in datetime, updated datetime without signout
*/
require_once '../errors/errorLog.php';
function add_log_entry($student_ID, $log_course_ID) {
	try {
		global $pdo;
		// Insert a new record with datetime example: student_ID 1, email switwicky
		$query ="INSERT INTO log (log_student_ID, log_course_ID, log_signin, log_updated) VALUES (?, ?, NOW(), NOW())";
		// Prepare the statement to prevent SQL injection
		$statement = $pdo->prepare($query);
		
		// Bind each parameter by its indexed position
		$statement->bindParam(1, $student_ID, PDO::PARAM_INT);
		$statement->bindParam(2, $log_course_ID, PDO::PARAM_INT);
		
		// Execute the statement
		$statement->execute();
		
		// Close statement, release the resources and memory associated
		$statement->closeCursor();
		
	// $statement->execute([$student_ID, $selectCourseInput]);
	} catch (PDOException $e) {
		errorLog('proceed_db.php select students',$e);
	}
}
?>
