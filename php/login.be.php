<?php
include_once "dbh.be.php";
session_start();
if(isset($_SESSION['username'])){
  header("Location: ../index.php");
  $sql->close();
  exit();
}
//PREPARE STATEMENT
if (!($query = $sql->prepare("SELECT * FROM users WHERE username=?"))) {
    echo "Prepare failed: (" . $sql->errno . ") " . $sql->error;
}
if (!$query->bind_param("s", $_POST['username'])) {
    echo "Binding parameters failed: (" . $query->errno . ") " . $query->error;
}
if (!$query->execute()) {
    echo "Execute failed: (" . $query->errno . ") " . $query->error;
}
$id = "";
$type = "";
$username = "";
$password = "";
$query->bind_result($id, $type, $username, $password);
$query->store_result();
if($query->num_rows()==0){
  echo "Utente inesistente.\n";
}else{
  $query->fetch();
  if(password_verify($_POST['password'], $password)){
    echo "Benvenuto, ".$username.".\n";
    session_start();
    $_SESSION['id'] = $id;
    $_SESSION['username'] = $password;
    $_SESSION['type'] = $type;
    header("Location: ../index.php");
  }else{
    echo "Password errata.\n";
  }
}
$query->free_result();
$query->close();
$sql->close();
?>
