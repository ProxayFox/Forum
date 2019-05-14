<?php
  require_once ('../databaseManager/meekrodb.2.3.class.php');
  DB::$user = 'localhost';
  DB::$dbName = 'forum';
  DB::$user = 'root';
  DB::$password = '';

  function getAllThreads() {
  return $this->query("
  SELECT *
  FROM thread
  ");
  }
?>