<?php
session_start();
require_once('../databaseManager/DBEnter.db.php');

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
    echo "<h1>fail</h1>";
  }else {
    // Info was updated successfully
    echo "<h1>success</h1>";
  }
}
?>