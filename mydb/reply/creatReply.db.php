<?php
session_start();
require_once ("../databaseManager/meekrodb.2.3.class.php");
DB::$user = 'localhost';
DB::$dbName = 'forum';
DB::$user = 'root';
DB::$password = '';

if (!empty($_POST)) {
  $CPID = $_SESSION['cpid'];
  $TID = $_POST['TID'];
  $PID = $_POST['PID'];
  $content = $_POST['reply'];
  $date = date("Y-m-d H:i:s");

  $result = DB::insert('reply', array(
      'RID' => NULL,
      'CPID' => $CPID,
      'TID' => $TID,
      'PID' => $PID,
      'content' => $content,
      'created' => $date
  ));

  if (!$result) {
    // it had failed
    header("Location: ../../post.pro.php?post=fail&TID=".$TID."&PID=".$PID);
  }else {
    // Info was updated successfully
    header("Location: ../../post.pro.php?post=success&TID=".$TID."&PID=".$PID);
  }
}
?>