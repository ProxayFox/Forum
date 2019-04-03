<?php
	require_once("o-db.php");
	$loginSuccess = false;

	// verify user's credentials
	if (isset($_POST)) {
		session_start();
		$loginSuccess = (myDB::getInstance()->verifyLogin($_POST['uname'], $_POST['password']));

		if ($loginSuccess == true) {
			// store session data
			$_SESSION['start']=1;
			$_SESSION['user'] = $_POST['uname'];
			header('location: ../index.php?login=success');
			exit;
		} else{
			header('location: ../index.php?login=fail');
			exit;
		}
	}
?>