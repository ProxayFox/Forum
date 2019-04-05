<?php
	require_once("o-db.php");
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
				header("Location: ../signup.php?signup=email");
			} elseif (myDB::getInstance()->getUserByUsername($uname)) {
				header("Location: ../signup.php?signup=username");
			} else{
				header("Location: ../signup.php?signup=fail");
			}
		} else {

			// Get Users
			$result = myDB::getInstance()->getUser($email);
			$row = $result->fetch_row();
			$uid = $row[0];

			// Add Login
			myDB::getInstance()->addLogin($uid, $uname, $pwd);
			header('location: ../index.php?signup=success');
			exit;
		}
	}
?>

<?php 
// function check_input($data){
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlspecialchars($data);
//   return $data;
// }


// if (isset($_POST['submit'])) {
// 	$name = cheack_input($_POST["name"]);
// 	$subject = check_input($_POST["subject"]);
// 	$mailFrom = check_input($_POST["mail"]);
// 	$message = check_input($_POST["message"]);

// 	$mailTo = "atcav1@proxwebdev.com";
// 	$headers = "From: ".$mailFrom;
// 	$txt = "You have recived an e-mail from".$name.".\n\n".$message;

// 	mail($mailTo, $subject, $txt, $headers);
// 	header("Location: index.php?mailsend");
// }
?>