<?php
include_once "dbh.be.php";
include_once "requests.be.php";
include_once "utilities.be.php";

$idgara = $_REQUEST['idgara'];
$tickets = requestTickets($idgara);
$gara = requestGara($idgara);
$solved = array_fill(0, $gara['numsq'], array_fill(0, $gara['numprob'], 0));
foreach($tickets as $ticket){
  if($ticket['tipo']==2){
    continue;
  }
  $solved[$ticket['squadra']][$ticket['problema']] = $ticket['tipo']*2-1;
}
echo json_encode($solved);

?>
