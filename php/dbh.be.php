<?php
//DBH

//FILE PHP DA INCLUDERE PER CONNESSIONE AL DATABASE


$dbServername = "";
$dbUsername = "";
$dbPassword = "";
$dbName = "my_matematicacassini";

$sql = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
$GLOBALS['sql'] = $sql;

if ($sql->connect_errno) {
    echo "Sembra che ci sia un problema al server: (" . $sql->connect_errno . ") " . $sql->connect_error;
}
//echo $sql->host_info . "\n";

?>
