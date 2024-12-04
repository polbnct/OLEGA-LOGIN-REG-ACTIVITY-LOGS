<?php

use function PHPSTORM_META\elementType;

require_once 'dbConfig.php';

function getAllUsers($pdo) {
	$sql = "SELECT * FROM users 
			ORDER BY user_name ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * from users WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
	else {
		;
	}
}

function searchForAUser($pdo, $searchQuery) {
	
	$sql = "SELECT * FROM users WHERE 
			CONCAT(first_name, last_name, user_name,age,email,specialty, date_added) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchQuery."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	} else {
		;
	}
}



function insertNewUser($pdo, $first_name, $last_name, $user_name, $age, $specialty, 
	$email) {

        $response = array();
        $sql = "INSERT INTO users 
                (
                    first_name,
                    last_name,
                    user_name,
                    age,
                    specialty,
                    email
                )
                VALUES (?,?,?,?,?,?)";
    
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([
            $first_name, $last_name, $user_name, $age, $specialty, 
            $email
        ]);
    
        if ($executeQuery) {
            $findInsertedItemSQL = "SELECT * FROM users ORDER BY date_added DESC LIMIT 1";
            $stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
            $stmtfindInsertedItemSQL->execute();
            $getUserByID = $stmtfindInsertedItemSQL->fetch();
    
            $insertActivityLog = insertActivityLog($pdo, "INSERT", $getUserByID['user_id'], 
                $getUserByID['first_name'], $getUserByID['last_name'], 
                $getUserByID['user_name'], $getUserByID['age'], $getUserByID['specialty'], 
                $getUserByID['email']);
    
            if ($insertActivityLog) {
                $response = array(
                    "status" => "200",
                    "message" => "User added successfully!"
                );
            } else {
                $response = array(
                    "status" => "400",
                    "message" => "Insertion of activity log failed!"
                );
            }
    
        } else {
            $response = array(
                "status" => "400",
                "message" => "Insertion of data failed!"
            );
        }
    
        return $response;
	

}

function editUser($pdo, $first_name, $last_name, $user_name, $age, $email, $specialty, $user_id) {

	$sql = "UPDATE users
				SET user_name = ?,
                    first_name = ?,
                    last_name = ?,
					age = ?,
					email = ?,
					specialty = ?
				WHERE user_id = ? 
			";

	$stmt = $pdo->prepare($sql);
	return $stmt->execute([$first_name, $last_name, $user_name, $age, $email, $specialty, $user_id]);

}


function deleteUser($pdo, $user_id) {
    $response = array();
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$user_id]);
    $getUserByID = $stmt->fetch();

    if ($getUserByID) {
        $deleteSql = "DELETE FROM users WHERE user_id = ?";
        $deleteStmt = $pdo->prepare($deleteSql);
        $deleteQuery = $deleteStmt->execute([$user_id]);

        if ($deleteQuery) {
            $insertActivityLog = insertActivityLog($pdo, "DELETE", $getUserByID['user_id'], 
                $getUserByID['first_name'], $getUserByID['last_name'], 
                $getUserByID['user_name'], $getUserByID['age'], $getUserByID['specialty'], 
                $getUserByID['email']);

            $response = array(
                "status" => "200",
                "message" => "Deleted the User successfully and activity log inserted!"
            );
        } else {
            $response = array(
                "status" => "400",
                "message" => "Failed to delete the User!"
            );
        }
    } else {
        $response = array(
            "status" => "404",
            "message" => "User not found!"
        );
    }

    return $response;
}

function checkIfUserExists($pdo, $username) {
    $response = array();
    $sql = "SELECT * FROM user_accounts WHERE username = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$username])) {
        $userInfoArray = $stmt->fetch();

        if ($stmt->rowCount() > 0) {
            $response = array(
                "result" => true,
                "status" => "200",
                "userInfoArray" => $userInfoArray
            );
        } else {
            $response = array(
                "result" => false,
                "status" => "400",
                "message" => "User doesn't exist!"
            );
        }
    }

    return $response;
}

function insertNewAccount($pdo, $username, $first_name, $last_name, $password) {
    $response = array();
    $checkIfUserExists = checkIfUserExists($pdo, $username);

    if (!$checkIfUserExists['result']) {
        $sql = "INSERT INTO user_accounts (username, first_name, last_name, password) 
                VALUES (?,?,?,?)";

        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$username, $first_name, $last_name, $password])) {
            $response = array(
                "status" => "200",
                "message" => "User successfully inserted!"
            );
        } else {
            $response = array(
                "status" => "400",
                "message" => "An error occurred with the query!"
            );
        }
    } else {
        $response = array(
            "status" => "400",
            "message" => "User already exists!"
        );
    }

    return $response;
}

// Get all users from user_accounts table
function getAllAccount($pdo) {
    $sql = "SELECT * FROM user_accounts";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function insertActivityLog($pdo, $operation, $user_id, $first_name, $last_name, $user_name, 
                             $age, $specialty, $email) {

    $sql = "INSERT INTO activity_logs(operation, user_id, first_name, last_name, user_name, age, 
                                        specialty, email) 
            VALUES(?,?,?,?,?,?,?,?)";

    $stmt = $pdo->prepare($sql);

    $executeQuery = $stmt->execute([$operation, $user_id, $first_name, $last_name, $user_name, 
                                    $age, $specialty, $email]);
    return $executeQuery;
}

function getAllActivityLogs($pdo) {
    $sql = "SELECT activity_log_id, operation, user_id, first_name, last_name, user_name, age, 
                   specialty, email, date_added 
            FROM activity_logs";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        return $stmt->fetchAll();
    }
}


?>