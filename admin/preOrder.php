<?php
session_start();
/*
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	12-07-2025
	Filename:	preOrder.php
	
	a form action from logBrowse.php
*/

$_SESSION['orderBy'] = "DateTime";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['action_course'])) {
        // The 'course order' button was pressed.
        $status = htmlspecialchars($_POST['action_course']);
		$_SESSION['orderBy'] = "Course";

    } elseif (isset($_POST['action_student'])) {
        // The 'student order' button was pressed.
        $status = htmlspecialchars($_POST['action_student']);
		$_SESSION['orderBy'] = "Student";
    }
}
header('Location: logBrowse.php');
exit();
?>

