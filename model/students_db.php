<?php
/*
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	11-25-2025
	Filename:	students_db.php
*/
require_once '../errors/errorLog.php';
//	returns the highest ID currently in the student table
function get_last_student_ID() {
	try {
		global $pdo;
		// Use a prepared statement to prevent SQL injection
        $query ="SELECT MAX(student_ID) FROM students";
		// to prevent SQL injection vulnerabilities
		$statement = $pdo->prepare($query);
		// execute the prepared statement
		$statement->execute();
		$log_ID = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $student_ID;
	} catch (PDOException $e) {
		errorLog('select student last student_ID',$e);
	}
}
function get_student_by_ID($student_ID) {
	try {
		global $pdo;

		// configures to throw a PDOException whenever a database error occurs.
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Use a prepared statement to prevent SQL injection
		$query =
			"SELECT
			student_ID,
			student_fname,
			student_lname,
			student_email,
			student_major,
			student_updated
			FROM students WHERE student_ID = :student_ID";

		// Prepare the statement to prevent SQL injection
		$statement = $pdo->prepare($query);

		// Bind the parameter
		$statement ->bindParam(':student_ID', $student_ID, PDO::PARAM_INT);

		// execute the query
		$statement->execute();

		// Fetch the row as an associative array
		$studentData = $statement->fetch(PDO::FETCH_ASSOC);

		// Close statement, release the resources and memory associated
		$statement->closeCursor();

		// Check if a student was found
		if ($studentData) {
			return $studentData;
		} else {
			return null; // No student found with that ID
		}
	} catch (PDOException $e) {
		errorLog('select student',$e);
	}
}
function delete_student_by_ID($student_ID) {
	try {
		global $pdo;

		// configures to throw a PDOException whenever a database error occurs.
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Use a prepared statement to prevent SQL injection
		$query = "DELETE FROM students WHERE student_ID = :student_ID";

		// Prepare the statement to prevent SQL injection
		$statement = $pdo->prepare($query);

		// Bind the parameter
		$statement ->bindParam(':student_ID', $student_ID, PDO::PARAM_INT);

		// execute the query
		$statement->execute();

		// Close statement, release the resources and memory associated
		$statement->closeCursor();
	} catch (PDOException $e) {
		errorLog('delete student',$e);
	}
}
function get_students_lname_order() {
	try {
		global $pdo;
		// Prepare and execute the SQL query
		$query =
			"SELECT
			student_ID,
			student_fname,
			student_lname,
			student_email,
			student_major,
			student_updated
			FROM students
			ORDER BY
			student_lname ASC,
			student_fname ASC,
			student_ID ASC";

		// to prevent SQL injection vulnerabilities
		$statement = $pdo->prepare($query);
		// execute the prepared statement
		$statement->execute();
		$students = $statement->fetchAll(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return $students;
	} catch (PDOException $e) {
		errorLog('select students',$e);
	}
}
// Add a new student record with first name, last name, email, and college major
function add_new_student($student_fname, $student_lname, $student_email, $student_major) {
	try {
		global $pdo;
		// Insert a new student record
		$query ="INSERT INTO students (student_fname, student_lname, student_email, student_major, student_updated) VALUES (?, ?, ?, ?, NOW())";

		// Prepare the statement to prevent SQL injection
		$statement = $pdo->prepare($query);

		// Bind each parameter by its indexed position
		$statement->bindParam(1, $student_fname, PDO::PARAM_STR);
		$statement->bindParam(2, $student_lname, PDO::PARAM_STR);
		$statement->bindParam(3, $student_email, PDO::PARAM_STR);
		$statement->bindParam(4, $student_major, PDO::PARAM_STR);

		// Execute the statement
		$statement->execute();

		// last inserted autocremented ID
		$_SESSION['student_ID']= $pdo->lastInsertId();

		// Close statement, release the resources and memory associated
		$statement->closeCursor();

	} catch (PDOException $e) {
		errorLog('insert students',$e);
	}
}
// updates student
function update_student($student_fname,$student_lname,$student_email,$student_major,$student_ID) {
	try {
		global $pdo;
		// configures to throw a PDOException whenever a database error occurs.
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// using named placeholders
		$query = "UPDATE students SET
		student_fname = :student_fname,
		student_lname = :student_lname,
		student_email = :student_email,
		student_major = :student_major,
		student_updated = NOW()
		WHERE student_ID = :student_ID";

		// Prepare the statement to prevent SQL injection
		$statement = $pdo->prepare($query);

        // Bind the parameters
        $statement->bindParam(':student_fname', $student_fname, PDO::PARAM_STR);
        $statement->bindParam(':student_lname', $student_lname, PDO::PARAM_STR);
		$statement->bindParam(':student_email', $student_email, PDO::PARAM_STR);
        $statement->bindParam(':student_major', $student_major, PDO::PARAM_STR);
        $statement->bindParam(':student_ID', $student_ID, PDO::PARAM_INT);

        // Execute the statement
        $statement->execute();

		// Close statement, release the resources and memory associated
		$statement->closeCursor();

    } catch (PDOException $e) {
			// error log exit
			errorLog('student_db.php, update failed',$e);
    }
}
/*
TABLE `log` (
  `log_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_signin` datetime NOT NULL DEFAULT current_timestamp(),
  `log_signout` datetime,
  `log_student_ID` int(10) UNSIGNED NOT NULL,
  `log_course_ID` int(10) UNSIGNED NOT NULL,
  `log_updated` DATETIME NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`log_ID`),
  FOREIGN KEY (`log_student_ID`) REFERENCES students(`student_ID`),
  FOREIGN KEY (`log_course_ID`) REFERENCES courses(`course_ID`)
*/
function exist_student_in_log($id) {
	try {
		global $pdo; // Assumes your PDO connection object is $pdo

		// Prepare query with a named placeholder ':id'
		$query = "SELECT log_ID, log_student_ID
					FROM log
					WHERE log_student_ID = :id
					LIMIT 1";

		// Prepare the statement to prevent SQL injection
		$statement = $pdo->prepare($query);

		// Bind the parameter
		$statement->bindParam(':id', $id, PDO::PARAM_INT);

		// Execute
		$statement->execute();

		// Return results as boolean
		$result = $statement->fetch() !== false;

		// Close statement, release the resources and memory associated
		$statement->closeCursor();

		// Returns true if a record exists, false otherwise
		return $result;

	} catch (PDOException $e) {
		// error log exit
		errorLog('student_db.php, student exist',$e);
    }
}
?>
