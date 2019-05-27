<?php
  require_once('../databaseManager/meekrodb.2.3.class.php');
  require_once('../databaseManager/DBEnter.db.php');
//	require_once("../databaseManager/o-db.php");
	if (!empty($_POST['uname']) && $_POST['email'] && $_POST['PWD']) {
		$uname = $_POST['uname'];
		$email = $_POST['email'];
		$pwd = $_POST['PWD'];
		//hashing the password using sha512
    $hashedPWD = hash('sha512', $pwd);
		
		// Add Users
		@$result = DB::insertIgnore('clientProfile', array(
		  'CPID' => NULL,
      'email' => $email
    ));
        //myDB::getInstance()->addUser($email);
		if (DB::affectedRows() == 0) {
			// User was not created
			// Duplicate Username
			if (DB::query("SELECT * FROM clientProfile WHERE email ='".$email."'")) {
				header("Location: ../../index.php?signup=email");
			//check username
			} elseif (DB::query("SELECT * FROM login WHERE UName ='".$uname."'")) {
				header("Location: ../../index.php?signup=username");
			} else {
			//unknown issue
        header("Location: ../../index.php?signup=fail");
      }
		} else {
		  // Get CPID using email as the email has placed information into client profile
			$CPIDResult = DB::query("SELECT * FROM clientProfile WHERE email = '".$email."'");
			foreach ($CPIDResult as $row) {
			 $cpid = $row['CPID'];

			// Add Login and check it
			$loginResult = DB::insert('login', array(
        'LID' => NULL,
        'CPID' => $cpid,
        'UName' => $uname,
        'PWD' => $hashedPWD
      ));
			header('location: ../../index.php?signup=success');
			exit;
      }
		}
	}
?>