<?php session_start();?>
<!DOCTYPE html>
<!--
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Cameron
	Created:	11-8-2025
	Updated:	11-30-2025 Jay King
	Updated:	12-07-2025 Jay King
	Filename:	admin/logBrowse.php
-->
<?php 
	$_SESSION['statusFlag'] = 4;
	include '../model/database.php';
	include '../model/logs_db.php';
	$logs = get_logs(); 
?>
<html lang="en">
<?php $_SESSION['delayFlag'] = 0; include '../views/head.php';?>
<body>

<?php include '../views/header.php';?>
<!-- note, no main -->
<section>
	<h2>LATEST LOG ENTRIES</h2>
</section>
<form
	id="buttonForm"
	class="button-form"
	action="preOrder.php"
	autocomplete="on"
	method="post">
	<nav class="button-bar">
		<button name="action_course" value="Course" class = 
		<?php 
			if ($_SESSION['orderBy'] == "Course") {
				echo '"btn2"';
			} else {
				echo '"btn1"';
			}
		?>
		type="submit">Course Order</button>
		<button name="action_student" value="Student" class = 
		<?php 
			if ($_SESSION['orderBy'] == "Student") {
				echo '"btn2"';
			} else {
				echo '"btn1"';
			}
		?>
		type="submit">Student Order</button>
		<button name="action_datetime" value="Student" class = 
			<?php 
			if ($_SESSION['orderBy'] == "DateTime") {
				echo '"btn2"';
			} else {
				echo '"btn1"';
			}
		?>
		type="submit">Date Order</button>
	</nav>
</form>
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Sign in</th>
                <th>Sign out</th>
				<th colspan="2">Student</th>
				<th colspan="2">Course</th>
            </tr>
        </thead>
        <tbody>
		
		<tbody id="logTableBody">
			<?php foreach ($logs as $log): ?>
			
            <tr class="clickable-row" data-id="<?= $log['log_ID'] ?>">
					<td class="right-align"><?php echo $log['log_ID']; ?></td>		

					<td><?php echo $log['log_signin']; ?></td>
					<td><?php echo $log['log_signout']; ?></td>
					<td class="right-align"><?php echo $log['log_student_ID']; ?></td>
					<td><?php echo strstr($log['student_email'], '@', true); ?></td>
					<td class="right-align"><?php echo $log['log_course_ID']; ?></td>
					<td><?php echo $log['course_number']; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div> <!-- table-container -->
<?php include '../views/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".clickable-row");
    rows.forEach(row => {
        row.addEventListener("click", () => {
            const logId = row.dataset.id;
            // Redirect to the external file with the ID as a GET parameter
            window.location.href = `logRecord.php?id=${logId}`;
        });
    });
});
</script>
</body>
</html>
