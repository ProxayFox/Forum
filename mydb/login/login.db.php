<?php
require_once('../databaseManager/meekrodb.2.3.class.php')
if (!empty($_POST) {
  $uName = $_POST['uName'];
  $email = $_POST['email'];
  $PWD = $_POST['PWD'];
  $hashedPWD = hash('sha512', $PWD);
  // add the user
  $result = DB::insert('clientProfile', array(
    'CPID' => NULL,
    'email' => $email
  ));
  if (!$result) {
    // user was not made, error
    // was there a duplicate username
    if ($email == DB::query("SELECT * FROM clientProfile WHERE email =".$email)){
      // send user back to index with a failure
      header("Location: ../../signup.php?signup=email");
    } else {
      $gotuser = DB::query("SELECT CPID FROM clientProfiel WHERE email = ".$email);
    }
  }
} else {
  header('Location: ../../signup.php?signup=NIL');
}
?>
<?php
//	require_once("../databaseManager/o-db.php");
//	if (isset($_POST)) {
//		$uname = $_POST['uname'];
//		$email = $_POST['email'];
//		$pwd = $_POST['PWD'];
//
//		// Add Users
//		$result = myDB::getInstance()->addUser($email);
//		if (!$result and $result1) {
//			// User was not created
//			// Duplicate Username
//			if (myDB::getInstance()->getUserByEmail($email)) {
//				header("Location: ../../signup.php?signup=email");
//			} elseif (myDB::getInstance()->getUserByUsername($uname)) {
//				header("Location: ../../signup.php?signup=username");
//			} else{
//				header("Location: ../../signup.php?signup=fail");
//			}
//		} else {
//
//			// Get Users
//			$result = myDB::getInstance()->getUser($email);
//			$row = $result->fetch_row();
//			$uid = $row[0];
//
//			// Add Login
//			myDB::getInstance()->addLogin($uid, $uname, $pwd);
//			header('location: ../../index.php?signup=success');
//			exit;
//		}
//	}
?> 