<?php
session_start();
require_once ("../databaseManager/meekrodb.2.3.class.php");
require_once('../databaseManager/DBEnter.db.php');

if (!empty($_POST)) {
  $CPID = $_SESSION['cpid'];
  $TID = $_POST['TID'];
  $title = $_POST['title'];
  $info = $_POST['info'];
  $date = date("Y-m-d H:i:s");

  $result = DB::insert('post', array(
      'PID' => NULL,
      'CPID' => $CPID,
      'TID' => $TID,
      'title' => $title,
      'info' => $info,
      'created' => $date
  ));

  if (!$result) {
    // it had failed
    header("Location: ../../posts.pro.php?post=fail&TID=".$TID);
  }else {
    // Info was updated successfully
    header("Location: ../../posts.pro.php?post=success&TID=".$TID);
  }
}
?>