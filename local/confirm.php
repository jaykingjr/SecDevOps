<!DOCTYPE html>
<!--
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Due:		10-3-2025
	Filename:	confirm.php
-->
<?php
	session_start();
	$firstNameInput = cleanInput($_POST['firstNameInput']);
	$lastNameInput = cleanInput($_POST['lastNameInput']);		
	$selectCourseInput = cleanInput($_POST['selectCourseInput']);	
	$emailInput = cleanInput($_POST['emailInput']);		
	function cleanInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
<html lang="en">

<?php include '../view/head.php';?>
<body>
<?php include '../view/header.php';?>
<main>
<?php include '../view/commodore.php';?>
<h2>Confirmed</h2>
<p>
<?php echo $firstNameInput ?>, information has been logged with email,<?php echo $emailInput ?>.
</p>
</main>
<?php include '../view/footer.php';?>
<?php
header("Refresh: 15; url=index.php");
exit();
?>
</body>

</html>
