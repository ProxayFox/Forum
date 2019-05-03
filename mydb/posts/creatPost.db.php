<?php
require_once("../databaseManager/o-db.php");
session_start();
if (isset($_POST)) {
  $TID = $_POST['TID'];
  $title = $_POST['title'];
  $info = $_POST['info'];
  $date = date("Y-m-d H:i:s");



  // Add/update information
  $result = myDB::getInstance()->creatPosts($TID, $title, $info, $date);

  if (!$result) {
    // info was not updated
    header("Location: ../../posts.pro.php?post=fail&TID=".$TID);
  } else {
    // info was updated
    header("Location: ../../posts.pro.php?post=success&TID=".$TID);
  }
}
?>