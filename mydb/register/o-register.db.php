<?php
	require_once("../databaseManager/o-db.php");
	if (isset($_POST)) {
		$uname = $_POST['uname'];
		$email = $_POST['email'];
		$pwd = $_POST['PWD'];
		
		// Add Users
		$result = myDB::getInstance()->addUser($email);
		if (!$result and $result1) {
			// User was not created
			// Duplicate Username
			if (myDB::getInstance()->getUserByEmail($email)) {
				header("Location: ../../signup.php?signup=email");
			} elseif (myDB::getInstance()->getUserByUsername($uname)) {
				header("Location: ../../signup.php?signup=username");
			} else{
				header("Location: ../../signup.php?signup=fail");
			}
		} else {

			// Get Users
			$result = myDB::getInstance()->getUser($email);
			$row = $result->fetch_row();
			$uid = $row[0];

			// Add Login
			myDB::getInstance()->addLogin($uid, $uname, $pwd);
			header('location: ../../index.php?signup=success');
			exit;
		}
	}
?>