<?php
session_start();
require_once('../databaseManager/DBEnter.db.php');

//check if the post is empty
if (!empty($_POST['img'])) {
  $CPID = $_SESSION['cpid'];
  $img = $_POST['img'];

  // for the image
  $target = "../img/profileIMG/";
  $cTarget = $target . basename($_FILES["imageName"]["name"]);
  $imageName = ($_FILES["imageName"]["name"]);
  $imgType = pathinfo($cTarget,PATHINFO_EXTENSION);

  // Check File Type
  if($imgType != "jpg" && $imgType != "png" && $imgType != "jpeg" && $imgType != "gif" ) {
    $imgError ='Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>The file entered is a '.$imgType.' type';
    $_SESSION['img_error'] = $imgError;
    echo $imgError;
  } else {
    //get all values to input into the database the new name
    $getClientProfileValues = DB::query("SELECT * FROM clientProfile");
    foreach ($getClientProfileValues as $row) {
      $cpid = $row['CPID'];
      $fName = $row['fName'];
      $lName = $row['lName'];
      $displayName = $row['displayName'];
      $email = $row['email'];
      $UIMG = $row['UIMG'];
      $web = $row['web'];
      $social = $row['social'];
      $upRep = $row['upRep'];
      $downRep = $row['downRep'];
      $rep = $row['rep'];
      $postNo = $row['postNo'];
      $followers = $row['followers'];

      // insert and update the database
      $result = DB::insertUpdate('accounts', array(
          'CPID' => $cpid, //primary key
          'fName' => $fName,
          'lName' => $lName,
          'displayName' => $displayName,
          'email' => $email,
          'UIMG' => $UIMG,
          'web' => $web ,
          'social' => $social,
          'upRep' => $upRep,
          'downRep' => $downRep,
          'rep' => $rep,
          'postNo' => $postNo,
          'followers' => $followers
      ), array(
          'UIMG' => $imageName
      ));

      if (!$result) {
        // it had failed
        echo "<h1>fail</h1>";
      }else {
        // Save Uploaded Files
        move_uploaded_file($_FILES["imageName"]["tmp_name"], $cTarget);
        // Info was updated successfully
        echo "<h1>success</h1>";
      }
    }
  }




} else {
  header("Location: ../../index.php?not_meant_to_be_here");
}
?>
?>