<?php session_start();?>
<!DOCTYPE html>
<!--
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	10-15-2025
	Updated:	11-20-2025
	Filename:	confirmStudent.php
	
	Confirms student starts signin tutor session
	Add a log entry with signout as null: login.php -> proceed.php -> confirmStudent.php
-->
<?php
if (!isset($_SESSION['student_email'])) {$_SESSION['student_email'] = "";}
if (!isset($_SESSION['student_fname'])) {$_SESSION['student_fname'] = "";}
if (!isset($_SESSION['student_lname'])) {$_SESSION['student_lname'] = "";}
if (!isset($_SESSION['student_major'])) {$_SESSION['student_major'] = "";}
if (!isset($_SESSION['statusFlag'])) {$_SESSION['statusFlag'] = 0;}
$student_email = $_SESSION['student_email'];
$student_fname = $_SESSION['student_fname'];
$student_lname = $_SESSION['student_lname'];
$student_major = $_SESSION['student_major'];
?>
<html lang="en">
<?php $_SESSION['delayFlag'] = 6; include '../views/head.php';?>
<body>
<?php include '../views/header.php';?>
<main>
<h2>Confirm Student Registered</h2>
<div class="frame">
	<fieldset>
	<?php echo $student_fname." ".$student_lname; ?>
	<br>
	<?php echo $student_email; ?>
	<br>
	<?php echo $student_major; ?>
	</fieldset>
	<h5>
	 New student is registered.
	</h5>
</div>
</main>
<?php include '../views/footer.php';?>
</body>
</html>