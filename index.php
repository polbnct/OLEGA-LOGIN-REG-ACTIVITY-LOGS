<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; 

if(!isset($_SESSION['username'])) {
	header("Location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="wuser_idth=device-wuser_idth, initial-scale=1.0">
	<title>Homepage</title>
	<style>
		p {
			text-align: center;
		}
		th, td {
			padding: 15px;
			text-align: left;
			border-bottom: 1px solid;
		}
	</style>
</head>
<body style="background: aquamarine;">

	<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: green; text-align: center; background-color: ghostwhite; border-style: soluser_id;">	
			<?php echo $_SESSION['message']; ?>
		</h1>
	<?php } unset($_SESSION['message']); ?>

	<div style="text-align: center;">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
		<input type="text" name="searchInput" placeholder="Search Here">
		<input type="submit" name="searchBtn">
	</form>
	</div>

	<p><a href="index.php">Clear Search Query</a></p>
	<p><a href="insert.php">Insert New User</a></p>
	<p><a href="alluser.php">All Users</a></p>
	<p><a href="activitylogs.php">Activity Logs</a></p>
	<p><a href="core/handleForms.php?logoutAccountBtn=1">Logout</a></p>

	<table style="margin-left:auto;margin-right:auto;">
		<tr>
            <th>First Name</th>
            <th>Last Name</th>
			<th>Username</th>
			<th>Age</th>
			<th>Email</th>
			<th>Specialty</th>
			<th>Action</th>
		</tr>

		<?php if (!isset($_GET['searchBtn'])) { ?>
			<?php $getAllUsers = getAllUsers($pdo); ?>
				<?php foreach ($getAllUsers as $row) { ?>
					<tr>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
						<td><?php echo $row['user_name']; ?></td>
						<td><?php echo $row['age']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['specialty']; ?></td>
						<td>
							<a href="edit.php?user_id=<?php echo $row['user_id']; ?>">Edit</a>
							<a href="delete.php?user_id=<?php echo $row['user_id']; ?>">Delete</a>
						</td>
					</tr>
			<?php } ?>
			
		<?php } else { ?>
			<?php $searchForAUser =  searchForAUser($pdo, $_GET['searchInput']); ?>
				<?php foreach ($searchForAUser as $row) { ?>
					<tr>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
						<td><?php echo $row['user_name']; ?></td>
						<td><?php echo $row['age']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['specialty']; ?></td>
						<td>
							<a href="edit.php?user_id=<?php echo $row['user_id']; ?>">Edit</a>
							<a href="delete.php?user_id=<?php echo $row['user_id']; ?>">Delete</a>
						</td>
					</tr>
				<?php } ?>
		<?php } ?>	
		
	</table>
</body>
</html>