<?php
/*
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Chaz
	Created:	10-29-2025
	Updated:	11-25-2025 Jay King
	Filename:	course_db.php
*/
require_once '../errors/errorLog.php';
function get_courses() {
	try {
		global $pdo; 
		$query = "SELECT * FROM courses ORDER BY course_number";
        $statement = $pdo->prepare($query);
        $statement->execute();
        $courses = $statement->fetchAll();
        $statement->closeCursor();
        return $courses;
	} catch (PDOException $e) {
		errorLog('select courses',$e);
	}		
}
// retrieves the course data based on the course ID.
function get_course_by_ID($course_ID) {
	try {
		global $pdo;

		// configures to throw a PDOException whenever a database error occurs.
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Use a prepared statement to prevent SQL injection
		$query = "SELECT * FROM courses WHERE course_ID = :course_ID";

		// Prepare the statement to prevent SQL injection
		$statement = $pdo->prepare($query);

		// Bind the parameter
		$statement ->bindParam(':course_ID', $course_ID, PDO::PARAM_INT);

		// execute the query
		$statement->execute();

		// Fetch the row as an associative array
		$courseData = $statement->fetch(PDO::FETCH_ASSOC);
		
		// Close statement, release the resources and memory associated
		$statement->closeCursor();
		
		// Check if a course was found
		if ($courseData) {
			return $courseData;
		} else {
			return null; // No course found with that ID
		}
	} catch (PDOException $e) {
		errorLog('select course',$e);
	}
}
?>