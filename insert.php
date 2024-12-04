<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; 

if(isset($_SESSION['user_id'])) {
	header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="wuser_idth=device-wuser_idth, initial-scale=1.0">
	<title>Insert</title>
	<style>
		p{
			text-align: center;
		}
	</style>
</head>
<body style="background: aquamarine;">
	<a href="index.php">Return Home</a>
	<h1 style="text-align: center;">Please Insert a new user!</h1>
	<form action="core/handleForms.php" method="POST">
        <p>
			<label for="first_name">First Name: </label> 
			<input type="text" name="first_name">
		</p>
		<p>
			<label for="last_name">Last Name: </label> 
			<input type="text" name="last_name">
		</p>
		<p>
			<label for="user_name">Username: </label> 
			<input type="text" name="user_name">
		</p>
		<p>
			<label for="age">Age: </label> 
			<input type="text" name="age">
		</p>
		<p>
			<label for="email">Email: </label> 
			<input type="text" name="email">
		</p>
		<p>
			<label for="specialty">Specialty</label> 
			<input type="text" name="specialty">
		</p>
		<p>
			<input type="submit" name="insertUserBtn">
		</p>
	</form>
</body>
</html>