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
	<title>All Users</title>
	<style>
		p, h2 {
			text-align: center;
		}
		th, td {
			padding: 15px;
			text-align: left;
			border-bottom: 1px solid;
		}
	</style>
</head>
<body style="background-color: aquamarine;">
	<a href="index.php">Return</a>
	<h2>All Users</h2>
	<table style="width: 100%;" cellpadding="20">
		<tr>
		 	<th>Username</th>
			<th>First Name</th>
			<th>Last Name</th>
		</tr>
	
		<?php $getAllUsers = getAllAccount($pdo); ?>
		<?php foreach ($getAllUsers as $row) { ?>
		<tr>
			<td><?php echo $row['username']; ?></td>
			<td><?php echo $row['first_name']; ?></td>
			<td><?php echo $row['last_name']; ?></td>
		</tr>
		<?php } ?>
	
</body>
</html>