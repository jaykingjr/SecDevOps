<!DOCTYPE html>
<!--
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Due:		10-3-2025
	Filename:	login.php
-->
<?php
session_start();
?>
<html lang="en">
<?php include '../view/head.php';?>
<body>
<?php include '../view/headrr.php';?>
<main>
<?php include '../view/commodore.php';?>
<h2>Welcome</h2>
<form id="loginForm" autocomplete="on" method="post" action="confirm.php">
<fieldset>
<label title="Display only">Email:</label>
	<input type="email"
	id="emailInput"
	name="emailInput"
	size="25"
	value="<?php echo isset($_SESSION['emailInput']) ? $_SESSION['emailInput'] : ''; ?>"
	readonly>
<br>
<label title="First name is a required entry">First name:</label>
	<input type="text" size="25" onkeyup="validateFirstname(this)"
	title="First name is a required entry"
	placeholder = "John-example" id="firstNameInput" name="firstNameInput" required>
<br>
<label title="Last name is a required entry">Last name:</label>
	<input type="text" size="25" onkeyup="validateLastname(this)"
	title="Last name is a required entry"
	placeholder = "Smith-example" id="lastNameInput" name="lastNameInput" required>
<br>

<label title="Requires a selection">Course:</label>
<select id="selectCourseInput" name="selectCourseInput" onchange="selectCourse()" required>
	<option value="">Select course with professor</option>
	<option value="1">ACC2001 - Rosemary Walker</option>
	<option value="2">ACC2001 - Tracy Sewell</option>
	<option value="3">ACC2011 - Tracy Sewell</option>
	<option value="4">CGS1570 - Kim Allan</option>
	<option value="5">CGS1570 - Wendy Payne</option>
	<option value="6">COP1000 - Trendon Ellis</option>
	<option value="7">COP2251 - Caleb Jordan</option>
	<option value="8">COP2700 - Wendy Payne</option>
	<option value="9">CTS1650 - David Lee</option>
	<option value="10">DIG2100 - Rique Orozco</option>
	<option value="11">ECO2013 - Brandon Cole</option>
	<option value="12">ECO2013 - Matthew Herndon</option>
	<option value="13">ECO2023 - Matthew Herndon</option>
	<option value="14">FIN3400 - Cara Pattinato</option>
</select>
<span id="selectCourseError" class="errorMsg"></span>
<br>



</fieldset>

	<button type="submit" class ="btn1">Confirm</button>

</form>
</main>
<?php include '../view/footer.php';?>

<script>

"use strict";

function validateFirstname(inputElement) {
	inputElement.value = alphaOnly(inputElement.value);
}
function validateLastname(inputElement) {
	inputElement.value = alphaOnly(inputElement.value);
}
function alphaOnly(str) {
	const charList = "abcdefghijklmnopqrstuvwxyz";
	let strReturn;
	str=str.toLowerCase();
	for (let i = 0; i < str.length;) {
		if (charList.indexOf(str.charAt(i)) < 0) {
			str = str.substring(0,i) + str.substring(i+1, str.length);
		} else {
			i++;
		}
	}
	strReturn=str.charAt(0).toUpperCase()+str.slice(1);
	return strReturn;
}
</script>
</html>