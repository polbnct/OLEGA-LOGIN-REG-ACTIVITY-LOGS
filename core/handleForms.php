<?php  

require_once 'dbConfig.php';
require_once 'models.php';


if (isset($_POST['insertUserBtn'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $user_name = trim($_POST['user_name']);
    $age = trim($_POST['age']);
    $specialty = trim($_POST['specialty']);
    $email = trim($_POST['email']);

    if (!empty($first_name) && !empty($last_name) && !empty($user_name) && !empty($age)
        && !empty($specialty) && !empty($email)) {

        $insertChef = insertNewUser($pdo, $first_name, $last_name, $user_name, $age, 
                                    $specialty, $email);

        $_SESSION['status'] = $insertUser['status']; 
        $_SESSION['message'] = $insertUser['message']; 
        header("Location: ../index.php");
        exit;
    } else {
        $_SESSION['message'] = "Please make sure there are no empty input fields";
        $_SESSION['status'] = '400';
        header("Location: ../index.php");
        exit;
    }
}


if (isset($_POST['editUserBtn'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $user_name = trim($_POST['user_name']);
    $age = trim($_POST['age']);
    $email = trim($_POST['email']);
    $specialty = trim($_POST['specialty']);
	$user_id = $_GET['user_id'];

    $updateResult = editUser($pdo, $first_name, $last_name, $user_name, $age, $email, $specialty, $user_id);

    if ($updateResult) {
        $operation = "UPDATED";
        insertActivityLog($pdo, $operation, $first_name, $last_name, $user_name, $age, $email, 
                          $specialty, $user_id);

        $_SESSION['message'] = "User updated successfully!";
        $_SESSION['status'] = "success";
        header("Location: ../index.php");
        exit;
    } else {
        $_SESSION['message'] = "Failed to update User!";
        $_SESSION['status'] = "error";
        header("Location: edit.php?user_id=" . $user_id);
        exit;
    }
}

if (isset($_POST['deleteUserBtn'])) {
	$id = $_GET['user_id'];

    if (!empty($id)) {
        $deleteChef = deleteUser($pdo, $id);
        $_SESSION['message'] = $deleteUser['message'];
        $_SESSION['status'] = $deleteUser['status'];
        header("Location: ../index.php");
	}
}

if (isset($_GET['searchBtn'])) {
	$searchForAUser = searchForAUser($pdo, $_GET['searchInput']);
	foreach ($searchForAUser as $row) {
		echo "<tr> 
				<td>{$row['first_name']}</td>
				<td>{$row['last_name']}</td>
				<td>{$row['user_id']}</td>
				<td>{$row['user_name']}</td>
				<td>{$row['age']}</td>
				<td>{$row['email']}</td>
				<td>{$row['specialty']}</td>
			  </tr>";
	}
}

if (isset($_POST['insertNewAccountBtn'])) {
    $username = trim($_POST['username']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (!empty($username) && !empty($first_name) && !empty($last_name) && 
        !empty($password) && !empty($confirm_password)) {

        if ($password == $confirm_password) {
            $insertQuery = insertNewAccount($pdo, $username, $first_name, $last_name, 
                                         password_hash($password, PASSWORD_DEFAULT));

            if ($insertQuery['status'] == '200') {
                $_SESSION['message'] = $insertQuery['message'];
                $_SESSION['status'] = $insertQuery['status'];
                header("Location: ../login.php");
            } else {
                $_SESSION['message'] = $insertQuery['message'];
                $_SESSION['status'] = $insertQuery['status'];
                header("Location: ../register.php");
            }
        } else {
            $_SESSION['message'] = "Please make sure both passwords are equal";
            $_SESSION['status'] = "400";
            header("Location: ../register.php");
        }
    } else {
        $_SESSION['message'] = "Please make sure there are no empty input fields";
        $_SESSION['status'] = "400";
        header("Location: ../register.php");
    }
}

if (isset($_POST['loginAccountBtn'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $loginQuery = checkIfUserExists($pdo, $username);

        if ($loginQuery['status'] == '200') {
            $usernameFromDB = $loginQuery['userInfoArray']['username'];
            $passwordFromDB = $loginQuery['userInfoArray']['password'];

            if (password_verify($password, $passwordFromDB)) {
                $_SESSION['username'] = $usernameFromDB;
                header("Location: ../index.php");
            }
        } else {
            $_SESSION['message'] = $loginQuery['message'];
            $_SESSION['status'] = $loginQuery['status'];
            header("Location: ../login.php");
        }
    } else {
        $_SESSION['message'] = "Please make sure no input fields are empty";
        $_SESSION['status'] = "400";
        header("Location: ../login.php");
        exit;
    }
}

if (isset($_GET['logoutAccountBtn'])) {
    unset($_SESSION['username']);
    header("Location: ../login.php");
    exit;
}

?>