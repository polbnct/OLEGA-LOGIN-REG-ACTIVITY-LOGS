<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; 

if(isset($_SESSION['user_id'])) {
	header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="wuser_idth=device-wuser_idth, initial-scale=1.0">
	<title>Delete</title>
</head>
<body style="text-align: center; background-color:red">
	<a href="index.php">Return Home</a>
	<h1>Are you sure you want to delete this user?</h1>
	<?php $getUserByID = getUserByID($pdo, $_GET['user_id']); ?>
	<div class="container">
        <h2>First Name: <?php echo $getUserByID['first_name']; ?></h2>
        <h2>Last Name: <?php echo $getUserByID['last_name']; ?></h2>
        <h2>Username: <?php echo $getUserByID['user_name']; ?></h2>
		<h2>Age: <?php echo $getUserByID['age']; ?></h2>
		<h2>Email: <?php echo $getUserByID['email']; ?></h2>
		<h2>Specialty: <?php echo $getUserByID['specialty']; ?></h2>

		<div class="deleteBtn">
			<form action="core/handleForms.php?user_id=<?php echo $_GET['user_id']; ?>" method="POST">
				<input type="submit" name="deleteUserBtn" value="Delete" style="border-style: soluser_id;">
			</form>			
		</div>	

	</div>
</body>
</html>