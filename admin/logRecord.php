<?php session_start(); ?>
<!DOCTYPE html>
<!--
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	11-25-2025
	Filename:	logRecord.php
	
Tables Used:
Log Table
log_ID | INT(10)
log_signin | DATETIME
log_signout | DATETIME
log_student_ID | CHAR(10
log_course_ID | CHAR(10)
log_tutor_ID | CHAR(10)
log_updated | DATETIME

Students Table
student_ID | INT(10)
student_fname | VARCHAR(50)
student_lname | VARCHAR(50)
student_email | VARCHAR(100)
student_major | VARCHAR(100)
student_updated | DATETIME

Courses Table
course_ID | INT(10)
course_number
course_number | CHAR(10)
course_updated | DATETIME
-->
<?php
include '../model/database.php';
include '../model/logs_db.php';
include '../model/process_db.php';
include '../model/students_db.php';
include '../model/course_db.php';
$log_ID = 0; // init
if (!isset($_SESSION['statusFlag'])) {$_SESSION['statusFlag'] = 0;}
if (!isset($_SESSION['orderBy'])) {$_SESSION['orderBy'] = "DateTime";}
if (($_SESSION['statusFlag'] == 8) ||
	($_SESSION['statusFlag'] == 9) ||
	($_SESSION['statusFlag'] == -8) ||
	($_SESSION['statusFlag'] == -9)) {
	$log_ID = $_SESSION['log_ID'];
}
if (!$log_ID) {
	$log_ID = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
}
// if $log_id is zero, then !$log_id evaluates true otherwise false.
if (!$log_ID) {
	$log_ID = get_last_log_ID(); // last inserted log_ID key
}
$logRecord = get_log_by_ID($log_ID);
$log_student_ID  = $logRecord['log_student_ID'];
$log_course_ID = $logRecord['log_course_ID'];
$studentRecord = get_student_by_ID($log_student_ID);
$courseRecord = get_course_by_ID($log_course_ID);
?>
<html lang="en">
<?php $_SESSION['delayFlag'] = 0; include '../views/head.php';?>
<body>
<?php include '../views/header.php';?>
<main>
<h2>LOG RECORD DISPLAY</h2>
<form id="logForm" autocomplete="on" method="post" action = "progress.php">
	<fieldset class="grid-double">
		<div>
			<label for="log_signin" title="Display only">Sign In:</label>
			<input type="text"
				id="log_ID"
				name="log_ID"
				size="2"
				<?php
				if ($_SESSION['orderBy'] == "DateTime") {
					echo 'class = "right-align-color-ID"';
				} else {
					echo 'class = "right-align-ID"';
				}
				?>
				value="<?php echo $log_ID; ?>"
			readonly>
		</div>
		<input type="text"
			id="log_signin"
			name="log_signin"
			size="16"
			value="<?php echo $logRecord['log_signin']; ?>"
		readonly>
	</fieldset>
	<fieldset class="grid-double">
		<label for="log_signout" title="Display only">Sign Out:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</label>
		<input type="text"
			id="log_signout"
			name="log_signout"
			size="16"
			value="<?php echo $logRecord['log_signout']; ?>"
			readonly>
		</fieldset>
	<fieldset class="grid-double">
		<div>
			<label for="student_name" title="Display only">Student:</label>
			<input type="text"
				id="student_ID"
				name="student_ID"
				size="2"
				<?php
				if ($_SESSION['orderBy'] == "Student") {
					echo 'class = "right-align-color-ID"';
				} else {
					echo 'class = "right-align-ID"';
				}
				?>
				value="<?php echo  $logRecord['log_student_ID']; ?>"
			readonly>
		</div>
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
		<div>
			<label for="course_name" title="Display only">Course:</label>
			<input type="text"
				id="course_ID"
				name="course_ID"
				aria-label="Display Course ID"
				size="2"
				<?php
				if ($_SESSION['orderBy'] == "Course") {
					echo 'class = "right-align-color-ID"';
				} else {
					echo 'class = "right-align-ID"';
				}
				?>
				value="<?php echo $logRecord['log_course_ID']; ?>"
			readonly>
		</div>
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
	<div class="button-container">
		<a class="btn1" href="logBrowse.php">Browse</a>
		<?php
		if ($_SESSION['statusFlag'] == -9) {
			echo '<button type="submit" formnovalidate name="action" value="Previous" class="btn2">';
			echo 'AT FIRST';
		} else {
			echo '<button type="submit" formnovalidate name="action" value="Previous" class="btn1">';
			echo 'Previous';
		}
		echo '</button>';
		if ($_SESSION['statusFlag'] == -8) {
			echo '<button type="submit" formnovalidate name="action" value="Next" class="btn2">';
			echo 'AT LAST';
		} else {
			echo '<button type="submit" formnovalidate name="action" value="Next" class="btn1">';
			echo 'Next';
		}
		echo '</button>';
		if (!$logRecord['log_signout']) {
			echo '<button type="submit" formnovalidate name="action" value="Update" class ="btn1">Update</button>';
		}
		?>	
		<button type="submit" formnovalidate name="action" value="Delete" class ="btn1">Delete</button>
	</div>
</form>
</main>
<?php include '../views/footer.php';?>
</body>
</html>