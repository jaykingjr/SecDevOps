<?php
$newLogin = true; //set by data query of Log file
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailInput = $_POST['usernameInput']."@my.gulfcoast.edu";
	$emailInput = filter_var($emailInput , FILTER_SANITIZE_EMAIL);
	if (isset($_POST['usernameInput'])) {
		session_start();
		$_SESSION['emailInput'] = $emailInput;
		if ($newLogin) {
			header('Location: login.php');
			exit;
		} else {
			header('Location: logout.php');
			exit;
		}
	}
}
?>
