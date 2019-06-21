<?php
session_start();
require_once('../databaseManager/DBEnter.db.php');

if (!empty($_POST['TID'] && $_POST['title'] && $_POST['info'] )) {
  $CDID = $_SESSION['cdid'];
  $TID = $_POST['TID'];
  $title = $_POST['title'];
  $info = $_POST['info'];
  $date = date("Y-m-d H:i:s");

  $result = DB::insert('post', array(
      'PID' => NULL,
      'CDID' => $CDID,
      'TID' => $TID,
      'title' => $title,
      'info' => $info,
      'created' => $date
  ));


  if ($result != NULL) {
    // It had failed
    echo "<h3>success</h3>";
  }else {
    // Info was updated successfully
    echo "<h3>fail</h3><br>".DB::affectedRows();
  }
} else {
  header("Location: ../../index.php?not_meant_to_be_here");
}
?>