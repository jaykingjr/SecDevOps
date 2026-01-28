<?php session_start(); ?>
<!DOCTYPE html>
<!--
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	11-10-2025
	Filename:	register.php
	Updated:	11-20-2025
	
	$_SESSION['statusFlag']
	0 init by index.php & proceed.php
	1 assigned by process.php for Not registered
	2 assigned by process.php to change 1 to 2 
	3 assigned by process.php & placing.php for new student insert
	4 assigned by studentsBrowse.php & placing.php for edit update
	5 assigned by placing.php for next record, -5 for failure
	6 assigned by placing.php for previous record, -6 for failure	
	7 assigned by placing.php to delete student record, -7 for failure
	
	Has few functions:
	1. registers new student for tutoring
	2. edits and update student, selected from studentsBrowse.php
	3. prevous and next movement of record by admin sudent edit page
	4. delete student record
-->
<?php
	$majors = array(
	"Accounting Applications Cert.",
	"Accounting, AA",
	"Accounting Technology, AS",
	"Advertising/Public Relations, AA",
	"Alternative Energy Systems Specialist, Cert.",
	"Anthropology/Archeology, AA",
	"Architectural Design Construction Tech., AS",
	"Architecture, AA",
	"Art, AA",
	"Biology Education, AA",
	"Biology, AA",
	"Business Administration & Management, AS",
	"Business Administration, AA",
	"Business Specialist, Cert.",
	"CNC Machinist, Cert.",
	"Central Sterile Processing Technologist, Cert.",
	"Certified Nursing Assistant Cert.",
	"Chef's Apprentice, Cert.",
	"Chemistry Education, AA",
	"Chemistry, AA",
	"Chiropractic Medicine, AA",
	"Clinical Laboratory Sciences, AA",
	"Composite Fabrication and Testing, CCC",
	"Computer Engineering, AA",
	"Computer Science, AA",
	"Correctional Officer, VC",
	"Criminal Justice Technology, AS",
	"Criminology/Criminal Justice, AA",
	"Crossover Correctional to LEO, VC",
	"Culinary Arts, CCC",
	"Culinary Management, AS",
	"Cybersecurity, AS",
	"Dental Assisting, VC",
	"Dental Hygiene, AS",
	"Dental Medicine, AA",
	"Digital Media Technology, AS",
	"Digital Media, BAS",
	"Digital Media/Multimedia, Cert.",
	"Early Childhood Education Liberal Arts, AA",
	"Early Childhood Education, AS",
	"Earth/Space Education, AA",
	"Economics, AA",
	"Economics for Business, AA",
	"Elementary Teacher Education, AA",
	"Emergency Medical Services, AS",
	"Emergency Medical Technician, ATD",
	"Engineering, AA",
	"Engineering Tech. Support Specialist, CCC",
	"Engineering Technology, AS",
	"Engineering Tech./Building Construction, AA",
	"English, AA",
	"English Teacher Education, AA",
	"Entomology, AA",
	"Environmental Science, AA",
	"Fire Science Technology, AS",
	"Firefighting, Cert.",
	"Florida Child Care Professional, Cert.",
	"Forestry, AA",
	"Geology, AA",
	"Health Education, AA",
	"Health Services Administration, AA",
	"Hilton Hospitality Mgmt and Tourism, AS",
	"History, AA",
	"Journalism, AA",
	"Legal Studies, AA",
	"Leisure Services Management, AA",
	"Marine Biology, AA",
	"Mathematics Education, AA",
	"Mathematics, AA",
	"Medical, AA",
	"Middle School Science Education, AA",
	"Music, AA",
	"Network Server Administration, CCC",
	"Network Systems Technology, AS",
	"Nursing, AA or AS",
	"Nutrition, Food, and Exercise Science, AA",
	"Occupational Therapy, AA",
	"Optometry, AA",
	"Organizational Management, BAS",
	"Paramedic, Cert.",
	"Pharmacy, AA",
	"Philosophy, AA",
	"Physical Education, AA",
	"Physical Therapist Assistant, AS",
	"Physical Therapy, AA",
	"Physics Education, AA",
	"Physics, AA",
	"Political Science, AA",
	"Practical Nurse Cert.",
	"Psychology, AA",
	"RN to BSN",
	"Radio/Television Broadcasting, AA",
	"Radiography, AS",
	"Rapid Prototyping Specialist",
	"Registered Nurse First Assistant, ATC",
	"Religion, AA",
	"Respiratory Care (Therapy), AS",
	"Respiratory Care Therapy, AA",
	"Social Studies Education, AA",
	"Social Work, AA",
	"Sociology, AA",
	"Software and Database Developer, AS",
	"Sonography, Diagnostic Medical, AS",
	"Spanish Language, AA",
	"Spanish Language Teacher Education, AA",
	"Special Education, AA",
	"Speech, AA",
	"Sports Medicine/Athletics Trainer, AA",
	"Stage Technology, CCC",
	"Surgical First Assisting, AS or CCC",
	"Surgical Services - Surgical Technologist",
	"Technology Management, BAS",
	"Theatre, AA",
	"Theatre and Entertainment Technology, AS",
	"Unmanned Vehicles Systems, AS or CCC",
	"Veterinary Medicine, AA",
	"Other, Not Listed");
	$count = count($majors); // Get array size
	
	require_once '../errors/errorLog.php';
	include '../model/database.php';
	include '../model/students_db.php';

	// init
	$student_ID = 0;
	$student_email = "";
	$student_fname = "";
	$student_lname = "";
	$student_major = "";

	// from studentsBrowse.php
	if ($_SESSION['statusFlag'] == 4) {

		// Checks if value is a valid integer.href="../login/register.php?id=
		$student_ID = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
		if (!$student_ID) {
			$student_ID = get_last_student_ID(); // last inserted student_ID key
		}
		$studentRecord = get_student_by_ID($student_ID);
		$student_email = $studentRecord['student_email'];
		$student_fname = htmlspecialchars($studentRecord['student_fname']);
		$student_lname = htmlspecialchars($studentRecord['student_lname']);
		$student_major = $studentRecord['student_major'];

	// register
	} elseif ($_SESSION['statusFlag'] == 3) {
		$student_email = $_SESSION['student_email'];
	} elseif (
		($_SESSION['statusFlag'] == 5) ||
		($_SESSION['statusFlag'] == 6) ||
		($_SESSION['statusFlag'] == 7) ||
		($_SESSION['statusFlag'] == -5) ||	
		($_SESSION['statusFlag'] == -6) ||			
		($_SESSION['statusFlag'] == -7)) {
		$student_ID = $_SESSION['student_ID'];
		$studentRecord = get_student_by_ID($student_ID);
		$student_email = $studentRecord['student_email'];
		$student_fname = htmlspecialchars($studentRecord['student_fname']);
		$student_lname = htmlspecialchars($studentRecord['student_lname']);
		$student_major = $studentRecord['student_major'];
	}
?>
<?php $_SESSION['delayFlag'] = 0; include '../views/head.php';?>
<html lang="en">
<body>
<?php include '../views/header.php';?>
<main>
<h2>
<?php
	if ($_SESSION['statusFlag'] == 3) {
		echo 'REGISTER STUDENT FOR TUTORING';
	} else {
		echo 'EDIT STUDENT';
	}
?>
</h2>

<form id="registerForm" action="placing.php" autocomplete="on" method="post">

<fieldset class="grid-double">
<div>
	<label for="student_email" title="Display only">Email:</label>
		<input
		<?php
			if ($_SESSION['statusFlag'] == 3) {
				echo 'type="hidden"';
			} else {
				echo 'type="text"';
			}
		?>
		id="student_ID"
		name="student_ID"
		size="2"
		class = "right-align-color-ID"
		value="<?php echo $student_ID; ?>"
		readonly>
		</div>
	<input text="email"
		id="student_email"
		name="student_email"
		size="20"
		value="<?php echo $student_email; ?>"
		readonly>
</fieldset>
<fieldset class="grid-double">
	<label for="student_fname" title="First name is a required entry">First name:</label>
	<input type="text" size="20"
		title="First name is a required entry"
		placeholder ="John-example"
		id="student_fname"
		name="student_fname"
		value="<?php echo $student_fname; ?>"
		required>
</fieldset>
<div class="grid-container">
	<p><span id="firstNameError" class="error-msg"></span></p>
</div>
<fieldset class="grid-double">
	<label for="student_lname" title="Last name is a required entry">
	Last name:
	</label>
	<input type="text" size="20"
		title="Last name is a required entry"
		placeholder ="Smith-example"
		id="student_lname"
		name="student_lname"
		value="<?php echo $student_lname; ?>"
		required>
</fieldset>	
<div class="grid-container">
	<p><span id="lastNameError" class="error-msg">
		<?php
			if ($_SESSION['statusFlag'] == -7) {
				echo 'Can NOT Delete, Student has log history';
			}
		?>
	</span></p>
</div>
	<?php
	if ($_SESSION['statusFlag'] != 3) {
		echo '<label for="student_major" class="label-major" title="College Major is a required entry">College major:</label>';
	}
	?>
	<fieldset>
	<select id="student_major" name="student_major" class="select-font-size" required>
		<option value="">Select college major</option>
			<?php foreach ($majors as $major): ?>
		<option value=
			<?php
				if ($student_major == $major) {
					echo '"'.$major.'" selected>';
				} else {
					echo '"'.$major.'">';
				}
			?>
			<?php echo $major; ?>
		</option>
		<?php endforeach; ?>
	</select>
</fieldset>
<div class="button-container">
	<button type="submit"
	<?php
	if ($_SESSION['statusFlag'] == 3) {
		echo 'name="action" value="Register" class ="btn1">Register</button>';
	} else {
		echo 'name="action" value="Update" class ="btn1">Update</button>';
	}

	if ($_SESSION['statusFlag'] != 3) {

		if ($_SESSION['statusFlag'] == -6) {
			echo '<button type="submit" formnovalidate name="action" value="Previous" class="btn2">';
			echo 'AT FIRST';
		} else {
			echo '<button type="submit" formnovalidate name="action" value="Previous" class="btn1">';
			echo 'Previous';
		}
		echo '</button>';

		if ($_SESSION['statusFlag'] == -5) {
			echo '<button type="submit" formnovalidate name="action" value="Next" class="btn2">';
			echo 'AT LAST';
		} else {
			echo '<button type="submit" formnovalidate name="action" value="Next" class="btn1">';
			echo 'Next';
		}
		echo '</button>';

		echo '<button type="submit" name="action" value="Delete" class="btn1">Delete</button>';
		echo '<a class="btn1" href="../admin/studentsBrowse.php">Browse</a>';
	}
	?>
	
</div> <!-- class="button-container"-->
</form>
</main>
<?php include '../views/footer.php';?>
<script>
"use strict";
const charList ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
// Get the input element and the display element
const firstElement = document.getElementById('student_fname');
const lastElement = document.getElementById('student_lname');
const firstNameErrorDisplay  = document.getElementById("firstNameError");
const lastNameErrorDisplay  = document.getElementById("lastNameError");
// Add an 'input' event listener
firstElement.addEventListener('input', function(e) {
    const cursorPosition = this.selectionStart;
    // Get the character that was just added/is at the position before the caret
    // We get the character right before the current cursor position
    const lastChar = this.value[cursorPosition - 1];
	let errorDisplay ="";
	if (lastChar ==" ") {
	    this.value = this.value.trim();
		errorDisplay = 'No spaces allowed';
	// no message for undefineds
	} else if (lastChar == null) {
    // Check if the last typed character and remove it if not allowed
    } else if (charList.indexOf(lastChar) < 0) {
        // Update the input value to exclude the not allowed character
        this.value = this.value.slice(0, cursorPosition - 1) + this.value.slice(cursorPosition);
        // Reposition the cursor correctly after removal
        this.selectionStart = this.selectionEnd = cursorPosition - 1;
		errorDisplay = 'Removed '+lastChar+'. It is not allowed.';
    }
	firstNameErrorDisplay.textContent=errorDisplay; // display message
});
// Add an 'input' event listener
lastElement.addEventListener('input', function(e) {
    const cursorPosition = this.selectionStart;
    // Get the character that was just added/is at the position before the caret
    // We get the character right before the current cursor position
    const lastChar = this.value[cursorPosition - 1];
	let errorDisplay ="";
	if (lastChar ==" ") {
	    this.value = this.value.trim();
		errorDisplay = 'No spaces allowed';
	// no message for undefineds
	} else if (lastChar == null) {
	// Check if the last typed character and remove it if not allowed
    } else if (charList.indexOf(lastChar) < 0) {
        // Update the input value to exclude the not allowed character
        this.value = this.value.slice(0, cursorPosition - 1) + this.value.slice(cursorPosition);
        // Reposition the cursor correctly after removal
        this.selectionStart = this.selectionEnd = cursorPosition - 1;
		errorDisplay = 'Removed '+lastChar+'. It is not allowed.';
    }
	lastNameErrorDisplay.textContent=errorDisplay; // display message
});
</script>
</body>
</html>
<!--
type null 168
type null 169
type null 169
type null 170
type null 171
$student_ID 235
$student_email 242
$student_fname 252
$student_lname 267
$student_major 290


$student_ID= 0; // init

if (($_SESSION['statusFlag'] == 8) ||
	($_SESSION['statusFlag'] == 9) ||
	($_SESSION['statusFlag'] == -8) ||
	($_SESSION['statusFlag'] == -9)) {
	$student_ID= $_SESSION['student_ID'];
}
if (!$student_ID) {	
	$student_ID = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
}
// if $student_ID is zero, then !$student_ID evaluates true otherwise false. 
if (!$student_ID) {
	$student_ID= get_last_student_ID(); // last inserted log_ID key
}


$studentRecord = get_student_by_ID($student_ID);



-->

