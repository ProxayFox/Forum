<?php
require_once('../databaseManager/meekrodb.2.3.class.php');
//  require_once('../databaseManager/o-db.php');
DB::$user = 'localhost';
DB::$dbName = 'forum';
DB::$user = 'root';
DB::$password = '';


// verify user's credentials
if (!empty($_POST)) {
  session_start();
  $loginSuccess = (myDB::getInstance()->verifyLogin($_POST['uname'], $_POST['password']));

  if ($loginSuccess == true) {
    // store session data
    $_SESSION['start']=1;
    $_SESSION['user'] = $_POST['uname'];
    header('location: ../../index.php?login=success');
    exit;
  } else{
    header('location: ../../index.php?login=fail');
    exit;
  }
}
?>