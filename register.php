<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link rel="stylesheet" href="styles.css">

	</style>
</head>
<body>
	<h1>Register here!</h1>

	<?php  
	if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

		if ($_SESSION['status'] == "200") {
			echo "<h1 style='color: green;'>{$_SESSION['message']}</h1>";
		}

		else {
			echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>";	
		}

	}
	unset($_SESSION['message']);
	unset($_SESSION['status']);
	?>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="username">Username</label>
			<input type="text" name="username" required>
		</p>
		<p>
			<label for="first_name">First Name</label>
			<input type="text" name="first_name" required>
		</p>
		<p>
			<label for="last_name">Last Name</label>
			<input type="text" name="last_name" required>
		</p>
		<p>
			<label for="password">Password</label>
			<input type="password" name="password" required>
		</p>
		<p>
			<label for="confirm_password">Confirm Password</label>
			<input type="password" name="confirm_password" required>
		</p>
		<p>
			<input type="submit" name="insertNewAccountBtn">
		</p>
	</form>
</body>
</html>