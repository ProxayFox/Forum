<?php
// starting the session
session_start();
//getting information inner working from meekroDB
require_once('../databaseManager/meekrodb.2.3.class.php');
require_once('../databaseManager/DBEnter.db.php');

// checking if a post was sent
if (!empty($_POST['uname'] && $_POST['password'])) {
  //getting the post from the login form
  $uname = $_POST['uname'];
  $pwd = $_POST['password'];
  // hashing the password to be checked
  $hashedPWD = hash('sha512', $pwd);
  //starting the session

  $loginResult = DB::queryFirstRow("SELECT LID, CPID FROM login WHERE UName='".$uname."' AND PWD='".$hashedPWD."'");

  if ($loginResult != null) {
      //getting values and assigning them
      $lid = $loginResult['LID'];
      $cpid = $loginResult['CPID'];

      //creating session values
      $_SESSION['lid'] = $lid;
      $_SESSION['cpid'] = $cpid;
      $_SESSION['start']=1;
      $_SESSION['user'] = $uname;
    //take the user back to index with a signing success
    header('location: ../../index.php?login=success');
    exit;
  } else {
    header('location: ../../index.php?login=fail');
    exit;
  }
} else {
  // redirect the user back to the index with a message of they aren't meant to be here
  header("Location: ../../index.php?not_meant_to_be_here");
  exit;
}