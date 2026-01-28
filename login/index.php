<?php session_start(); ?>
<!DOCTYPE html>
<!--
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Updated:	11-7-2025
	Filename:	index.php
--> 
<?php
$_SESSION['errorLog'] = "";
$_SESSION['orderBy'] = "";
// If it does not exist in the session
if (!isset($_SESSION['statusFlag'])) {$_SESSION['statusFlag'] = 0;}
if (!isset($_SESSION['student_ID'])) {$_SESSION['student_ID'] = 0;}
if (!isset($_SESSION['student_fname'])) {$_SESSION['student_fname'] = "";}
if (!isset($_SESSION['student_lname'])) {$_SESSION['student_lname'] = "";}
if (!isset($_SESSION['student_major'])) {$_SESSION['student_major'] = "";}
if (!isset($_SESSION['course_ID'])) {$_SESSION['course_ID'] = 0;}
if (!isset($_SESSION['student_email'])) {$_SESSION['student_email'] = "";}
if (!isset($_SESSION['usernameInput'])) {$_SESSION['usernameInput'] = "";}
if (!isset($_SESSION['log_ID'])) {$_SESSION['log_ID'] = 0;}
?>
<!--  Thomas cleared username label, added div for css -->
<html lang="en">
<?php $_SESSION['delayFlag'] = 0; include '../views/head.php';?>
<body>
<?php include '../views/header.php';?>
<main>
<h2>LOGIN/LOGOUT</h2>
<form id="indexForm" autocomplete="on" method="post" action="process.php">
	<label for="usernameInput" class="h3">Student Email:</label>
	<fieldset class="grid-double">
		<input type="text"
		aria-label="UserName Input"
		id="usernameInput"
		name="usernameInput"
		placeholder = "jsmith2"
		size="15"
		minlength="3"
		maxlength="100"
		<?php
			if ($_SESSION['statusFlag'] == 1) {
				echo 'value ='. $_SESSION['usernameInput'];
			}
		?>
		required>
		<span class="domain-part">@my.gulfcoast.edu</span>
	</fieldset>
	<fieldset class="grid-single">
		<p>
		<span id="usernameError" class="error-msg">
			<?php
			if ($_SESSION['statusFlag'] == 1) {
				echo 'Not registered! Continue to.';
			}
			?>
		</span>
		</p>
	</fieldset>
	<button type="submit" class ="btn1">Continue</button>
</form>
</main>
<?php include '../views/footer.php';?>
<script>
// Get the input element and the display element
const inputElement = document.getElementById('usernameInput');
const charList = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890-_.";
const usernameErrorDisplay  = document.getElementById("usernameError");
// Add an 'input' event listener
inputElement.addEventListener('input', function(e) {
    const cursorPosition = this.selectionStart;
    // Get the character that was just added/is at the position before the caret
    // We get the character right before the current cursor position
    const lastChar = this.value[cursorPosition - 1];
	let errorDisplay = "";
	if (lastChar ==" ") {
	    this.value = this.value.trim();
		errorDisplay = 'No spaces allowed';
	} else if (lastChar == null) {
    // Check if the last typed character and remove it if not allowed
    } else if (lastChar == "@") {
        // Update the input value to exclude the not allowed character
        this.value = this.value.slice(0, cursorPosition - 1) + this.value.slice(cursorPosition);
        // Reposition the cursor correctly after removal
        this.selectionStart = this.selectionEnd = cursorPosition - 1;
		errorDisplay = 'Enter the part before @';
    // Check if the last typed character and remove it if not allowed
    } else if (charList.indexOf(lastChar) < 0) {
        // Update the input value to exclude the not allowed character
        this.value = this.value.slice(0, cursorPosition - 1) + this.value.slice(cursorPosition);
        // Reposition the cursor correctly after removal
        this.selectionStart = this.selectionEnd = cursorPosition - 1;
		errorDisplay = 'Removed '+lastChar+'. It is not allowed.';
    }
	this.value = this.value.toLowerCase();
	usernameErrorDisplay.textContent=errorDisplay; // display message
});
</script>
</body>
</html>