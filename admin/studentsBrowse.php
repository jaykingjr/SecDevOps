<?php session_start(); ?>
<!DOCTYPE html>
<!--
	Class:		cop4433
	Project:	ACE Tutoring Lab
	Author:		Jay King
	Created:	10-20-2025
	Updated:	12-07-2025 Jay King
	Filename:	admin/studentsBrowse.php
-->
<?php 
	$_SESSION['statusFlag'] = 4;
	include '../model/database.php';
	include '../model/students_db.php';
	$students = get_students_lname_order(); 
?>
<html lang="en">
<?php $_SESSION['delayFlag'] = 0; include '../views/head.php';?>
<head><style>
    .clickable-row { cursor: pointer; }
</style></head>
<body>

<?php include '../views/header.php';?>
<?php
function datetimeFormat($mysql_datetime) {
    // Convert MySQL datetime string to a Unix timestamp
    $timestamp = strtotime($mysql_datetime);
    
    // Format the timestamp to the desired 'yy-mm-dd hour:minutes' format
    // 'y' for two-digit year, 'm' for month, 'd' for day
    // 'H' for 24-hour format, 'i' for minutes
    $formatted_datetime = date('y-m-d H:i', $timestamp);
    return $formatted_datetime;
}
?>
<!-- note, no main -->
<section>
    <h2>STUDENTS BROWSE</h2>
</section>
<div class="table-container">
	<table>
		<thead>
			<tr>
				<th>ID</th>				
				<th>Name</th>
				<th>Email</th>
				<th>Updated</th>
			</tr>
		</thead>
        <tbody id="studentTableBody">
			<?php foreach ($students as $student): ?>
			
            <tr class="clickable-row" data-id="<?= $student['student_ID'] ?>">
					<td class="right-align"><?php echo $student['student_ID']; ?></td>		
					<td><?php echo $student['student_lname'].', '.
					$student['student_fname']; ?></td>
					<td><?php echo $student['student_email']; ?></td>
					<td><?php echo datetimeFormat($student['student_updated']); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div> <!-- table-container -->
<?php include '../views/footer.php';?>

<script>
    // JavaScript to make the entire row clickable, cleaner and more efficient. 

document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".clickable-row");
    rows.forEach(row => {
        row.addEventListener("click", () => {
            const studentId = row.dataset.id;
            // Redirect to the external file with the ID as a GET parameter
            window.location.href = `../login/register.php?id=${studentId}`;
        });
    });
});

</script>
</body>
</html>
