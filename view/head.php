<!--
  Class:     cop4433
  Project:   ACE Tutoring Lab
  Author:    Jay King
  Created:   10-15-2025
  Updated:   11-20-2025 Jay King
  Filename:  head.php
-->
<head>
<link rel="icon" href="../assets/favicon.ico" type="image/png">
<meta name="robots" content="noindex,nofollow">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
	if ($_SESSION['delayFlag'] > 0) {
		if (!isset($_SESSION['statusFlag'])) {$_SESSION['statusFlag'] = 0;}
		echo '<head><meta http-equiv="refresh" content="';
		echo $_SESSION['delayFlag'];
		if ($_SESSION['statusFlag'] == 3) {
			echo '; url=../login/login.php"></head>';
		} else {
			echo '; url=../login"></head>';
		}
	}	
?>
<title>ACE Tutoring Lab</title>
<style>
* {
  box-sizing: border-box;
}
/* Force layout to fill exact viewport height */
html, body {
  margin: 0;
  overflow: hidden;
  font-family: Arial, Helvetica, FreeSans, sans-serif;
  justify-content: center;  /* centers form horizontally */
}
body {
  line-height: 1.1;
  font-size: 3vw;
  text-align: center;
  /* 
  aspect-ratio: 5 / 3; height: auto; 
  color: black;
  */
  background-color: black;
  padding: 0;
  display: grid;
  min-height: 50vh;
}
main {
  background-color: #2fafeb;
  display: grid;
  margin: 0;
  padding: 0 0 1vh 0;
  width: 100%;
}
.button-bar {
  padding: 0;
  margin: 0 0 1vh 0;
}
.frame, .frame2 {
  text-align: center;
  border-radius: 1vw;
  border: 0.1vw solid #ccc;
  box-shadow: 0 0.5vw 1.1vw rgba(0, 0, 0, 0.15);
  background-color: #f3f3f3;
  /* top, right, bottom, left */
  padding: 0.5vh 0.5vw 0.5vh 0.5vw;
}
form {
  border-radius: 1vw; /* smooth corners */
  border: 0.1vw solid #ccc;
  box-shadow: 0 0.5vw 1.1vw rgba(0, 0, 0, 0.15); /* soft shadow */
  /* Changes made by Thomas */
  background-color: #f3f3f3;
  display: grid;
  align-items: center;
  text-align: center;
  border: none;
}
label {
  padding-right: 1vw;
  font-weight: 600;   /* semi-bold for clarity */
  color: #0e2a47;  /* same deep navy as headers */
}
.label-major {
  margin-bottom: 0.5vh;
}
input[type="text"]:valid,
select:valid {
  border: none;
  background-color: #dbe9fa;
}
input[type="text"]:invalid,
select:invalid {
  border: none;
  background: white;
  /* Horizontal offset, Vertical offset, Blur radius, color */
  box-shadow: .2vw .2vw .4vw blue;
}
input[type="text"]:focus,
select:focus {
  border: .1vw solid blue;
  background: white;
}
/* Thomas Changed Input Styling */
input[type="text"]:focus,
select:focus {
  outline: none;
  border-color: #2840a0;   /* Gulf Coast blue focus highlight */
  box-shadow: 0 0 5px rgba(40, 64, 160, 0.3);
  background-color: #f9fbff;   /* slight tint when active */
}
input[type="text"]:hover,
select:hover {
  border-color: #8fa4d4;   /* soft hover cue */
}
input[readonly],
input[readonly]:focus,
input[readonly]:hover {
  background-color: #dbe8eb;
  border: none;
  box-shadow: none;
}
header {
  display: grid;
  text-align: center;
  /* Aligns items vertically in the center of their grid areas */
  align-items: center;
  /* Centers the entire content (three columns) horizontally */
  justify-content: center;
  /* additional gap space between columns */
  gap: 0rem;
  width: 100%;
  background-color: blue;
  position: sticky;
  top: 0;
}
.img-logo {
  width: 90%;
  vertical-align: middle;
  padding: 0;
  margin: 0;
}
.img-c {
  width: 50%;
  vertical-align: middle;
  padding: 0;
  margin: 0;
}
h1 {
  /* Centers text horizontally within grid cell */
  text-align: center;
  margin: 0 0 1vh 1vw;
  padding: 0;
  font-family: Verdana, Geneva, serif; /* Thomas change */
  font-size: 6.5vw;
  color: white;
}
.button-form {
  border-radius: 0;
  border: 0;
  box-shadow: none; /* soft shadow */
  width: 100%;
  background-color: #2fafeb;
  display: grid;
  align-items: center;
  text-align: center;
  border: none;
  padding: 0;
}
section {
  display: grid;
  justify-content: center; /* centers form horizontally */
  align-items: center;   /* centers form vertically */
  background-color: #2fafeb;
  width: 100%;
  padding: 0;
  margin: 0;
}
button {
 justify-self: center; /* Centers only this item horizontally */
}
.error-msg {
  display: block;
  padding: 0;
  margin: 0;
  color: maroon;
  font-weight: 600;
  font-size: clamp(1rem,3.8vw,4rem);
}
p {
  min-height: clamp(1.5rem,4.5vw,5rem);
  text-align: center;
  margin: 0;
}
h2 {
  text-align: center;
  width: 100%;
  padding: 0.3vh 0 1.0vh 0;
  /* Following changed by Thomas */
  font-family: "Segoe UI", Arial, sans-serif;
  font-weight: 700;
  color: #0e2a47;
  background-color: #2fafeb;
}
.h3 {
  padding: 0;
  text-align: center;
  margin: 0.1vh auto 3vh auto;
  font-size: clamp(1.125rem,4.2vw,3.8rem);
  width: 30vw;
  /* Thomas */
  font-family: "Segoe UI", Arial, sans-serif;
  font-weight: 600;
  color: #0e2a47;
  /* Layout */
  padding-bottom: 1vh;
  border-bottom: 0.4vw solid #2840a0;
  border-radius: 0;
  background: none;
  display: block;
  box-shadow: none;
}
h5 {
  text-align: center;
  margin: 1.5vw 0 0.5vw 0;
  padding: 0;
  color: #000080;
  font-weight: 600;
}
h6 {
  text-align: center;
  width: 100%;
  padding: 0;
  margin: 0;
  color: white;
  background-color: blue;
}
footer {
  display: grid;
  color: #ffffff;
  text-align: center;
  width: 100%;
  background-color: blue;
  margin: 0;
  border-top: 1vw solid #2fafeb;
  padding: 0.2vh 0 0.2vh 0;
}
a {
  text-decoration: none;
  color: white;
}
table {
  width: 100%;
  border-collapse: collapse;
  border-right: 1vw solid #2fafeb;
  border-left: 1vw solid #2fafeb;
  font-size: 2.71vw;   /* Fluid font size: scales dynamically */
}
/* The scrollable area */
.table-container {
  overflow-y: auto;
  min-height: 0; /* Critical for grid scrolling in Chrome/Firefox */
  justify-content: center; /* Horizontal center */
  align-items: center;   /* Vertical center */
  background-color: #2fafeb;
}
th {
  /* Sticky table header */
  position: sticky;
  top: 0;
  z-index: 10; /* Ensures header is above scrolling content */
  background: DarkSlateBlue;
  color: white;
}
tr:nth-child(even), select option:nth-child(even) {
	background-color: #F0FFF0;
}
tr:nth-child(odd), select option:nth-child(odd) {
	background-color: #CFECEC;
}
tr:hover, option:hover {
  background-color: #2B60DE;
  cursor: pointer;
  color: white;
}
th, td {
  border-right: 0.1vw solid #ddd;
  /* top, right, bottom, left */
  padding: 0.5vh 0.5vw 0.5vh 1vw;
  text-align: left;
}
.right-align {
  text-align: right;
  width: 2em;
  font-style: italic;
}
.right-align-ID {
  text-align: right;
  width: 2em;
  font-style: italic;
}
.right-align-color {
  text-align: right;
  font-style: italic;
  font-weight: 400;
  width: 2em;
  color: blue;
}
.right-align-color-ID {
  text-align: right;
  font-style: italic;
  font-weight: 400;
  width: 2em;
  color: blue;
}
.btn1, .btn2, .btn3 {
  font-family: "Segoe UI", Arial, sans-serif;
  font-weight: 600;
  color: #fff;
  display: inline-block;
  box-shadow: .18vw .10vw .09vw #111111;
  padding: 0.4vh 0.4vw 0.4vh 0.4vw;
  font-size: clamp(1rem,3.4vw,3rem);
  cursor: pointer;
  border: medium outset rgb(50,60,140);
  border-radius: 1vw;
}
.btn1:hover,
.btn1:focus,
.btn2:hover,
.btn2:focus,
.btn3:hover,
.btn3:focus {
  color: black; /* black text for contrast */
  background-color: #8EEBEC; /* Blue Lagoon */
}
.btn1, .btn2 {
  margin: 1vh 1vw 1vh 1vw;
  border-radius: 1.5vw;
  /* minimum, preferred, maximum */
  width: clamp(8rem,30vw,16rem);
}
.btn1 {
  background-color: #2840a0;
}
.btn2 {
  background-color: blue;
}
.btn3 {
  background-color: #2840a0;
  margin: 1.5vh 1vw 1.5vh 1vw;
  width: clamp(10rem,35vw,18rem);
}
fieldset {
  display: grid;
  gap: 0.5vw;
  justify-self: start; /* revert to width determined by the HTML size */
  min-width: 0; /* prevents from being smaller than default style */
  padding: 0;
  border: none;
  /* top, right, bottom, left */
  margin: 0 auto 0.2vw auto;
}
label, input, fieldset, select, h5 {
  font-family: "Segoe UI", Arial, sans-serif;
  /* minimum, preferred, maximum */
  font-size: clamp(1.2rem, 4vw, 3rem);
}
.select-font-size {
  /* minimum, preferred, maximum */
  font-size: clamp(0.9rem, 4vw, 2.5rem);
  width: 86vw;
  margin-left: 1vw;
}
.grid-single {
  display: grid;
  grid-template-columns: auto;
  /*justify-content: center; Centers horizontally */
  /*align-items: center;  Centers vertically */
}
/***** defaults to @media (orientation: portrait) *****/
html {
  height: 85%;
}
header {
  padding: 0 0 0.5vh 1.5vw;
  /* three columns: 1fr for title, allows remaining centers images */
  grid-template-columns: 16% 1fr 16%;
}
.grid-double {
  /* Portrait (Default): One column for both labels and inputs */
  grid-template-columns: 1fr;
}
.right-align-ID {
  margin: 0 1vw 0 0;
  display: inline-block;
}
.right-align-color-ID {
  margin: 0 1vw 0 0;
  display: inline-block;
}
input {
  display: block;
  margin-left: 1vw;
}
.frame {
  width: 96vw;
  margin: 5vh auto 10vh auto;
}
.frame2 {
  width: 96vw;
  margin: 5vh auto 10vh auto;
}
form {
  width: 96vw;
  place-self: center;
  margin: 0 auto 0 auto;
  padding: 0.5vh 0.5vw 0.5vh 2vw;
}
.domain-part {
  display: block;
}
h2 {
  margin: 2vh auto 1vh auto;
  font-size: clamp(1.2rem, 6vw, 2.5rem);
}
h6 {
  /* minimum, preferred, maximum */
  font-size: clamp(0.9rem, 1.5vw, 2rem);
}
@media (orientation: landscape) {
html {
  height: 98%;
}
header {
  padding: 0 0 0.5vh 1.5vw;
  /* three columns: 1fr for title, allows remaining centers images */
  grid-template-columns: 12% 1fr 12%;
}
.grid-double {
  /* Landscape: Two columns (Label | Input) */
  grid-template-columns: auto 1fr;
}
.right-align-ID {
  margin: 0 1vw 0 0;
}
.right-align-color-ID {
  margin: 0 1vw 0 0;
}
input {
  display: inline-block;
}
.frame {
  width: 70vw;
  margin: 5vh auto 10vh auto;
}
.frame2 {
  width: 90vw;
  margin: 5vh auto 10vh auto;
}
form {
  width: 88vw;
  margin: 0 auto 0 auto;
  padding: 0.5vh 0.5vw 0.5vh 0.5vw;
}
.domain-part {
  display: inline-block;
}
h2 {
  margin: 0.5vh auto 0.5vh auto;
  font-size: 5vw;
}
h6 {
  /* minimum, preferred, maximum */
  font-size: clamp(0.9rem, 1.5vw, 2rem);
}}
</style>
</head>