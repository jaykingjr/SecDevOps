<?php
session_start();
?>
<!DOCTYPE html>
<!--
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	10-15-2025
	Filename:	login.php
	Updated:	11-20-2025
-->
<html lang="en">
<?php $_SESSION['delayFlag'] = 0; include '../views/head.php';?>
<?php include '../model/database.php';?>
<?php include '../model/course_db.php';?>
<body>
<?php include '../views/header.php';?>
<main>
<h2>WELCOME TO SIGN-IN</h2>
<form id="loginForm" autocomplete="on" method="post" action="proceed.php">
	<fieldset>
		<input type="hidden" name="student_ID"
		value="<?php echo isset($_SESSION['student_ID']) ? $_SESSION['student_ID'] : ''; ?>">
		<label for="student_email" title="Display only">Email:</label>
		<input type="email"
			id="student_email"
			name="student_email"
			size="20"
			minlength="15"
			maxlength="100"
			value="<?php echo isset($_SESSION['student_email']) ? $_SESSION['student_email'] : ''; ?>"
			readonly>
	</fieldset>	
	<br>
<fieldset class="grid-double">
		<label for="student_fname">First name:</label>
		<input type="text"
			size="20"
			minlength="1"
			maxlength="100"
			id="student_fname"
			name="student_fname"
			value="<?php echo isset($_SESSION['student_fname']) ? $_SESSION['student_fname'] : ''; ?>"
			readonly>	
	</fieldset>	
<fieldset class="grid-double">
		<label for="student_lname">Last name:</label>
		<input type="text" 
			id="student_lname"
			name="student_lname"
			size="20"
			minlength="1"
			maxlength="100"
			value="<?php echo isset($_SESSION['student_lname']) ? $_SESSION['student_lname'] : ''; ?>"
			readonly>
	</fieldset>	
	<?php
		$courses = get_courses();
	?>
	<div class="grid-container">
		<label for="course_ID">Course To Be Tutored Upon</label>
	</div>
	<fieldset>
		<select id="course_ID" name="course_ID" class="select-font-size" required>
			<option value="">Select course with professor</option>
			<?php foreach ($courses as $course): ?>
				<option value="<?php echo htmlspecialchars($course['course_ID']); ?>">
					<?php
						echo htmlspecialchars($course['course_number']. ' ' .$course['course_name']. ' - ' .$course['course_professor']);
					?>
				</option>
			<?php endforeach; ?>
 		</select>
	</fieldset>
	<br>
	<button type="submit"class ="btn1">Confirm</button>
</form>
</main>
<?php include '../views/footer.php';?>
</html>