<?php
require_once("o-db.php");
session_start();
if (isset($_POST)) {
  $title = $_POST['title'];
  $info = $_POST['info'];
  $date = date("Y-m-d H:i:s");



  // Add/update information
  $result = myDB::getInstance()->creatThread($title, $info, $date);

  if (!$result) {
    // info was not updated
    header("Location: ../threads.pro.php?thread=fail");
  } else {
    // info was updated
    header("Location: ../threads.pro.php?thread=success");
  }
}
?>