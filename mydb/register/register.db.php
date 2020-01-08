<?php
require_once('../databaseManager/DBEnter.db.php');
//	require_once("../databaseManager/o-db.php");
if (!empty($_POST['uname']) && $_POST['email'] && $_POST['PWD']) {
  $uname = $_POST['uname'];
  $email = $_POST['email'];
  $pwd = $_POST['PWD'];
  //hashing the password using sha512
  $hashedPWD = hash('sha512', $pwd);

  @$emailTest = DB::query("SELECT email FROM clientData WHERE email = '".$email."'");
  // checking for duplicate email
  if (DB::affectedRows() == 0) { // if $emailTest is not empty than insert into the database
    @$unameTest = DB::query("SELECT UName FROM login WHERE UName = '".$uname."'");
    if (DB::affectedRows() == 0) {
      DB::insertIgnore('clientData', array(
        'CDID' => NULL,
        'email' => $email
      ));

      $getCPID = DB::query("SELECT CDID FROM clientData WHERE email = '".$email."'");
      foreach ($getCPID as $row) {
        $cdid = $row['CDID'];

        DB::insert('login', array(
            'LID'       => NULL,
            'CDID' => $cdid,
            'UName' => $uname,
            'PWD' => $hashedPWD
        ));

        DB::insert('clientProfile', array(
            'CPID' => NULL,
            'CDID' => $cdid,
            'displayName' => $uname,
            'UIMG' => NULL,
            'web' => NULL,
            'social' => NULL,
            'postNo' => NULL
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