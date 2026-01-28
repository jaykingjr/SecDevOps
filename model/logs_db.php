<?php
/*
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Chaz
	Created:	10-20-2025
	Updated:	11-25-2025 Jay King
	Updated:	12-05-2025 Jay King
	Filename:	logs_db.php

TABLE log
	log_ID
	log_signin
	log_signout
	log_student_ID
	log_course_ID
	log_updated

TABLE courses
	course_ID
	course_professor
	course_name
	course_number
	course_updated

TABLE students
	student_ID
	student_fname
	student_lname
	student_email
	student_major
	student_updated

LEFT Join
Inner Query (Subquery)
Outer Query (Main Query)

*/
require_once '../errors/errorLog.php';
// Retrieves logs data ORDER BY log_updated
function get_logs() {
	if (!isset($_SESSION['orderBy'])) {$_SESSION['orderBy'] = "";}
	$orderBy = $_SESSION['orderBy'];
    try {
        global $pdo;
			switch ($orderBy) {
			case "Student":
				$query =
					"SELECT temp.*
					FROM (
						select
							log.log_ID,
							log.log_signin,
							log.log_signout,
							log.log_student_ID,
							log.log_course_ID,
							log.log_updated,
							courses.course_number,
							students.student_email
						FROM log
							LEFT JOIN courses ON log.log_course_ID = courses.course_ID
							LEFT JOIN students ON log.log_student_ID = students.student_ID
						ORDER BY log_updated DESC, log_ID DESC LIMIT 30
					) temp
					ORDER BY log_student_ID ASC";
				break;
			case "Course":
				$query =
					"SELECT temp.*
					FROM (
						select
							log.log_ID,
							log.log_signin,
							log.log_signout,
							log.log_student_ID,
							log.log_course_ID,
							log.log_updated,
							courses.course_number,
							students.student_email
						FROM log
							LEFT JOIN courses ON log.log_course_ID = courses.course_ID
							LEFT JOIN students ON log.log_student_ID = students.student_ID
						ORDER BY log_updated DESC, log_ID DESC LIMIT 30
					) temp
					ORDER BY log_course_ID ASC";
				break;
			default:
				$_SESSION['orderBy'] = "DateTime";
				$query =
					"SELECT
						log.log_ID,
						log.log_signin,
						log.log_signout,
						log.log_student_ID,
						log.log_course_ID,
						log.log_updated,
						courses.course_number,
						students.student_email
					FROM log
					LEFT JOIN courses ON log.log_course_ID = courses.course_ID
					LEFT JOIN students ON log.log_student_ID = students.student_ID
					ORDER BY log_updated DESC, log_ID DESC LIMIT 30";
		}

        $statement = $pdo->prepare($query);
        $statement->execute();
        $logs = $statement->fetchAll();

		// Close statement, release the resources and memory associated
		$statement->closeCursor();
        return $logs;
    } catch (PDOException $e)  {
		errorLog('select log getLogs',$e);
	}
}
function get_logs_updated_order() {
	try {
		global $pdo;
		// Prepare and execute the SQL query
		$query =
			"SELECT
				log_ID,
				log_signin,
				log_signout,
				log_student_ID,
				log_course_ID,
				log_updated
			FROM log
			ORDER BY
			log_updated ASC,
			log_ID ASC";

		// to prevent SQL injection vulnerabilities
		$statement = $pdo->prepare($query);
		// execute the prepared statement
		$statement->execute();
		$logs = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $logs;
	} catch (PDOException $e) {
		errorLog('select log updated order',$e);
	}
}
function get_logs_student_order() {
	try {
		global $pdo;
		// Prepare and execute the SQL query
		$query =
			"SELECT
				log_ID,
				log_signin,
				log_signout,
				log_student_ID,
				log_course_ID,
				log_updated
			FROM log
			ORDER BY
			log_student_ID ASC,
			log_ID ASC";

		// to prevent SQL injection vulnerabilities
		$statement = $pdo->prepare($query);
		// execute the prepared statement
		$statement->execute();
		$logs = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $logs;
	} catch (PDOException $e) {
		errorLog('select log updated order',$e);
	}
}
function get_logs_course_order() {
	try {
		global $pdo;
		// Prepare and execute the SQL query
		$query =
			"SELECT
				log_ID,
				log_signin,
				log_signout,
				log_student_ID,
				log_course_ID,
				log_updated
			FROM log
			ORDER BY
			log_course_ID ASC,
			log_ID ASC";

		// to prevent SQL injection vulnerabilities
		$statement = $pdo->prepare($query);
		// execute the prepared statement
		$statement->execute();
		$logs = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $logs;
	} catch (PDOException $e) {
		errorLog('select log updated order',$e);
	}
}
//	returns the highest ID currently in the log table
function get_last_log_ID() {
	try {
		global $pdo;
		// Use a prepared statement to prevent SQL injection
        $query ="SELECT MAX(log_ID) FROM log";
		// to prevent SQL injection vulnerabilities
		$statement = $pdo->prepare($query);
		// execute the prepared statement
		$statement->execute();
		$log_ID = $statement-> fetchColumn();
		$statement->closeCursor();
		return $log_ID;
	} catch (PDOException $e) {
		errorLog('select last log_ID',$e);
	}
}
//	Retrieves the log data based on the log ID.
function get_log_by_ID($log_ID) {
	try {
		global $pdo;

		// configures to throw a PDOException whenever a database error occurs.
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Use a prepared statement to prevent SQL injection
        $query =
			"SELECT
				log_ID,
				log_signin,
				log_signout,
				log_student_ID,
				log_course_ID,
				log_updated
			FROM log WHERE log_ID = :log_ID";

		// Prepare the statement to prevent SQL injection
		$statement = $pdo->prepare($query);

		// Bind the parameter
		$statement ->bindParam(':log_ID', $log_ID, PDO::PARAM_INT);

		// execute the query
		$statement->execute();

		// Fetch the row as an associative array
		$logData = $statement->fetch(PDO::FETCH_ASSOC);

		// Close statement, release the resources and memory associated
		$statement->closeCursor();

		// Check if a log was found
		if ($logData) {
			return $logData;
		} else {
			return null; // No log found with that ID
		}
	} catch (PDOException $e) {
		errorLog('select get_log_by_ID',$e);
	}
}
//	Deletes the log record based on the log ID.
function delete_log_by_ID($log_ID) {
	try {
		global $pdo;

		// configures to throw a PDOException whenever a database error occurs.
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Use a prepared statement to prevent SQL injection
		$query = "DELETE FROM log WHERE log_ID = :log_ID";

		// Prepare the statement to prevent SQL injection
		$statement = $pdo->prepare($query);

		// Bind the parameter
		$statement ->bindParam(':log_ID', $log_ID, PDO::PARAM_INT);

		// execute the query
		$statement->execute();

		// Close statement, release the resources and memory associated
		$statement->closeCursor();
	} catch (PDOException $e) {
		errorLog('delete log',$e);
	}
}
?>
