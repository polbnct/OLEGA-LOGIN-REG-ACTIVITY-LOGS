<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Activity Logs</title>
	<style>
		th, td {
			padding: 15px;
			text-align: left;
			border-bottom: 1px solid;
		}
	</style>

</head>
<body style="background-color: aquamarine;">
	<p><a href="index.php">Return</a></p>
	<div class="tableClass">
		<table style="width: 100%;" cellpadding="20">
			<tr>
				<th>Operation Used</th>
				<th>User ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Username</th>
				<th>Age</th>
				<th>Specialty</th>
				<th>Email</th>
				<th>Date Modified</th>
			</tr>
			<?php $getAllActivityLogs = getAllActivityLogs($pdo); ?>
			<?php foreach ($getAllActivityLogs as $row) { ?>
			<tr>
				<td><?php echo $row['operation']; ?></td>
				<td><?php echo $row['user_id']; ?></td>
				<td><?php echo $row['first_name']; ?></td>
				<td><?php echo $row['last_name']; ?></td>
				<td><?php echo $row['user_name']; ?></td>
				<td><?php echo $row['age']; ?></td>
				<td><?php echo $row['specialty']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['date_added']; ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>