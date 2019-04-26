<?php
require_once("o-db.php");
session_start();
if (isset($_POST)) {
  $TID = $_GET['TID'];
  $title = $_POST['title'];
  $info = $_POST['info'];
  $date = date("Y-m-d H:i:s");



  // Add/update information
  $result = myDB::getInstance()->creatPosts($TID, $title, $info, $date);

  if (!$result) {
    // info was not updated
    header("Location: ../posts.pro.php?post=fail");
  } else {
    // info was updated
    header("Location: ../posts.pro.php?post=success");
  }
}
?>s