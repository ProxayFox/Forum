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

  @$emailTest = DB::query("SELECT email FROM clientProfile WHERE email = '".$email."'");
  // checking for duplicate email
  if (DB::affectedRows() == 0) { // if $emailTest is not empty than insert into the database
    @$unameTest = DB::query("SELECT UName FROM login WHERE UName = '".$uname."'");
    if (DB::affectedRows() == 0) {
      DB::insertIgnore('clientProfile', array(
        'CPID' => NULL,
        'email' => $email
      ));

      $getCPID = DB::query("SELECT * FROM clientProfile WHERE email = '".$email."'");
      foreach ($getCPID as $row) {
        $cpid = $row['CPID'];

        DB::insert('login', array(
            'LID' => NULL,
            'CPID' => $cpid,
            'UName' => $uname,
            'PWD' => $hashedPWD
        ));
      }
      header('location: ../../index.php?signup=success');
      exit;
      } else {
      header("Location: ../../index.php?signup=uname");
      exit;
      }
    } else {
      header("Location: ../../index.php?signup=email");
    exit;
    }
  } else {
  header("Location: ../../index.php?not_meant_to_be_here");
  exit;
}
?>