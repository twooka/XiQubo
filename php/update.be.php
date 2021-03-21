<?php
include_once "dbh.be.php";
include_once "requests.be.php";
include_once "utilities.be.php";

$idgara = $_REQUEST['id'];
$nome = $_REQUEST['nome'];
$numsq = $_REQUEST['numsq'];
$squadre = $_REQUEST['squadre'];
$numprob = $_REQUEST['numprob'];
$problemi = $_REQUEST['problemi'];
$orario = $_REQUEST['orario'];
$durata = $_REQUEST['durata'];

$qrstmt = "UPDATE gare SET nome=?, numsq=?, squadre=?, numprob=?, problemi=?, orario=?, durata=? WHERE id=".$idgara.";";
var_dump($qrstmt);
//$qry = "UPDATE ".$tbname." SET nome='".$nome."', numsq=".$numsq.", squadre='".$squadre."', numprob=".$numprob.", problemi='".$problemi."', orario='".$orario."', durata=".$durata." WHERE id=".$id.";";
if (!($query = $sql->prepare($qrstmt))) {
    echo "Prepare failed: (" . $sql->errno . ") " . $sql->error;
}
$query->bind_param('sisissi', $nome, $numsq, $squadre, $numprob, $problemi, $orario, $durata);
$query->execute();
$query->close();
$sql->close();
echo "niceeeee";
?>
