<?php session_start(); ?>
<!DOCTYPE html>
<!--
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	10-15-2025
	Updated:	11-20-2025 Jay King
	Filename:	logout.php

-->
<?php
include '../model/database.php';
include '../model/logs_db.php';
include '../model/students_db.php';
include '../model/course_db.php';

$log_ID = $_GET['id'];
if (!$log_ID) {	
	$log_ID = $_SESSION['log_ID'];
}
$logRecord = get_log_by_ID($log_ID);

$student_ID = $logRecord['log_student_ID'];
$course_ID = $logRecord['log_course_ID'];

$studentRecord = get_student_by_ID($student_ID);
$courseRecord = get_course_by_ID($course_ID);
$course_name = $courseRecord['course_name'];
?>
<html lang="en">
<?php $_SESSION['delayFlag'] = 6; include '../views/head.php';?>
<body>
<?php include '../views/header.php';?>
<main>
<h2>Logging Out</h2>
<div class="frame2">
	<fieldset class="grid-double">
		<label for="log_signin" title="Display only">&nbsp;&nbsp;&nbsp;Sign In:</label>
		<input type="text"
			id="log_signin"
			name="log_signin"
			size="16"
			value="<?php echo $logRecord['log_signin']; ?>"
		readonly>
	</fieldset>
	<fieldset class="grid-double">
		<label for="log_signout" title="Display only">Sign Out:</label>
		<input type="text"
			id="log_signout"
			name="log_signout"
			size="16"
			value="<?php echo $logRecord['log_signout']; ?>"
			readonly>
		</fieldset>
	<fieldset class="grid-double">
		<label for="student_name" title="Display only">Student:</label>
		<input type="text"
			size="20"
			id="student_name"
			name="student_name"
			value="<?php echo $studentRecord['student_fname'].' '.$studentRecord['student_lname']; ?>"
		readonly>
	</fieldset>
	<fieldset class="grid-double">
		<label for="student_email" title="Display only">Email:</label>
		<input type="text"
			id="student_email"
			name="student_email"
			size="20"
			value="<?php echo $studentRecord['student_email']; ?>"
		readonly>
	</fieldset>
	<fieldset class="grid-double">
			<label for="course_name" title="Display only">Course:</label>
		<input type="text"
			id="course_number"
			name="course_number"
			aria-label="Display Course Number"
			size="5"
			value="<?php echo $courseRecord['course_number']; ?>"
		readonly>
	</fieldset>
	<fieldset class="grid-single">
		<input type="text"
			id="course_name"
			name="course_name"
			class="select-font-size"
			size="20"
			value="<?php echo $courseRecord['course_name']; ?>"
		readonly>
	</fieldset>
	<fieldset class="grid-double">
		<label for="course_professor" title="Display only">Professor:</label>
		<input type="text"
			id="course_professor"
			name="course_professor"
			size="20"
			value="<?php echo $courseRecord['course_professor']; ?>"
			readonly>
	</fieldset>
	<h5>
		Your session has completed. Thank you.
	</h5>	
</div>
</main>
<?php include '../views/footer.php';?>
</body>
</html>





