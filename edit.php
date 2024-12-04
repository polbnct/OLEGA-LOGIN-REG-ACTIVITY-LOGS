<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="wuser_idth=device-wuser_idth, initial-scale=1.0">
	<title>Edit</title>
</head>
<body style="text-align: center; background-color: aquamarine;">
	<?php $getUserByID = getUserByID($pdo, $_GET['user_id']); ?>
	<a href="index.php" style="text-align: left;">Return Home</a>
	<h1>Edit the user!</h1>
	<form action="core/handleForms.php?user_id=<?php echo $_GET['user_id']; ?>" method="POST">
    <p>
			<label for="first_name">First Name: </label> 
			<input type="text" name="first_name" value="<?php echo $getUserByID['first_name']; ?>">
		</p>
		<p>
			<label for="last_name">Last Name: </label> 
			<input type="text" name="last_name" value="<?php echo $getUserByID['last_name']; ?>">
		</p>
    <p>
			<label for="user_name">User Name: </label> 
			<input type="text" name="user_name" value="<?php echo $getUserByID['user_name']; ?>">
		</p>
		<p>
			<label for="age">Age: </label> 
			<input type="text" name="age" value="<?php echo $getUserByID['age']; ?>">
		</p>
		<p>
			<label for="email">Email: </label> 
			<input type="text" name="email" value="<?php echo $getUserByID['email']; ?>">
		</p>
		<p>
			<label for="specialty">Specialty: </label> 
			<input type="text" name="specialty" value="<?php echo $getUserByID['specialty']; ?>">
		</p>
		<p>
			<input type="submit" value="Save" name="editUserBtn">
		</p>
	</form>
</body>
</html>