<?php
session_start();
require_once('../databaseManager/DBEnter.db.php');

if (!empty($_SESSION['cdid'] && $_POST['TID'] && $_POST['PID'] && $_POST['reply'])) {
  $CDID = $_SESSION['cdid'];
  $TID = $_POST['TID'];
  $PID = $_POST['PID'];
  $content = $_POST['reply'];
  $date = date("Y-m-d H:i:s");

  $result = DB::insert('reply', array(
      'RID' => NULL,
      'CDID' => $CDID,
      'TID' => $TID,
      'PID' => $PID,
      'content' => $content,
      'created' => $date
  ));

  if ($result != NULL) {
    // it had failed
    echo "<h3>success</h3>";
  }else {
    // Info was updated successfully
    echo "<h3>fail</h3><br>".DB::affectedRows();
  }
} else {
  echo "<h3>Something was missing</h3>";
}
?>