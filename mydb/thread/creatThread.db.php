<?php
session_start();  
require_once ("../databaseManager/meekrodb.2.3.class.php");
DB::$user = 'localhost';
DB::$dbName = 'forum';
DB::$user = 'root';
DB::$password = '';

if (!empty($_POST)) {
  $CPID = $_SESSION['cpid'];
  $title = $_POST['title'];
  $info = $_POST['info'];
  $date = date("Y-m-d H:i:s");

  $result = DB::insert('thread', array(
      'TID' => NULL,
      'CPID' => $CPID,
      'title' => $title,
      'info' => $info,
      'created' => $date
  ));

  if (!$result) {
    // it had failed
    header("Location: ../../threads.pro.php?thread=fail");
  }else {
    // Info was updated successfully
    header("Location: ../../threads.pro.php?thread=success");
  }
}
?>