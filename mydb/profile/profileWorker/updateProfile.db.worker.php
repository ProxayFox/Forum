<?php
session_start();
require_once('../databaseManager/DBEnter.db.php');





$existing = DB::queryFirstRow("SELECT * FROM clientData WHERE CDID= '".$_SERVER['cdid']."'");



