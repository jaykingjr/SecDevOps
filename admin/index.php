<?php
	session_start();
	$_SESSION['errorLog'] = "";
	$_SESSION['orderBy'] = "DateTime";
	$_SESSION['statusFlag'] = 0;
	$_SESSION['student_ID'] = 0;
	$_SESSION['student_fname'] = "";
	$_SESSION['student_lname'] = "";
	$_SESSION['student_major'] = "";
	$_SESSION['course_ID'] = 0;
	$_SESSION['student_email'] = "";
	$_SESSION['usernameInput'] = "";
	$_SESSION['log_ID'] = 0;
?>
<!DOCTYPE html>
<!--
Class:		cop4433
Project:	ACE Tutoring Lab
Author:		Cameron
Created:	11-8-2025
Updated:	11-25-2025
Filename:	admin/index.php
-->
<html lang="en">
<?php $_SESSION['delayFlag'] = 10; include '../views/head.php';?>
<body>
<?php include '../views/header.php'; ?>
<main>
<h2>ADMINISTRATOR MENU<br>at <?php echo $_SERVER['HTTP_HOST']; ?></h2>
<br>

<div class="frame">

<a class="btn1" href="../login">SignIn</a>
<br>

<a class="btn3" href="logBrowse.php">Browse Logs</a>
<a class="btn3" href="studentsBrowse.php">Browse Students</a>
<h5>Click on a row of a browse (selection list)<br>displays its detail record.</h5>
</div> <!-- frame -->
<div class="error-msg">Administrative passwords<br>deactivated for testing purposes.</div>
</main>
<?php include '../views/footer.php'; ?>
</body>
</html>