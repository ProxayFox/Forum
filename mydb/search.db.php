<?php
require_once("o-db.php");
session_start();
if (isset($_POST)) {
    $search = $_POST['search'];

    // Add/update information
    $result = myDB::getInstance()->search($search);

    if (!$result) {
        // info was not updated
        header("Location: ../index.php?search=fail");
    } else {
        // info was updated
        header("Location: ../search.php?search=success");
    }
}
?>