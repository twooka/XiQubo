<?php

include_once "dbh.be.php";
session_start();
if(!$_SESSION['username']){
  header("Location: ../index.php");
  exit();
}

unset($_SESSION["id"]);
unset($_SESSION["name"]);
session_destroy();
header("Location: ../index.php");
