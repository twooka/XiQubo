<?php
include_once "dbh.be.php";
include_once "requests.be.php";
include_once "utilities.be.php";

$idgara = $_REQUEST['idgara'];
echo json_encode(requestJollies($idgara));
?>
