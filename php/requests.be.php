<?php

include_once "dbh.be.php";

function requestGare(){
  $items = array();
  $result = $GLOBALS['sql']->query("SELECT * FROM gare");
  $i = 0;
  while(($row = $result->fetch_assoc())) {
      $items[$i] = $row;
      $i++;
  }
  $result->free_result();
  return $items;
}

function requestJollies($idgara){
  $tickets = requestTickets($idgara);
  $gara = requestGara($idgara);
  $jollies = array_fill(0, $gara['numsq'], -1);
  foreach($tickets as $ticket){
    if($ticket['tipo']!=2){
      continue;
    }
    $jollies[$ticket['squadra']] = $ticket['problema'];
  }
  return $jollies;
}

function requestSolved($idgara){
  $tickets = requestTickets($idgara);
  $gara = requestGara($idgara);
  $solved = array_fill(0, $gara['numsq'], array_fill(0, $gara['numprob'], 0));
  foreach($tickets as $ticket){
    if($ticket['tipo']==2){
      continue;
    }
    $solved[$ticket['squadra']][$ticket['problema']] = $ticket['tipo']*2-1;
  }
  return $solved;
}

function requestGara($idGara){
  $result = $GLOBALS['sql']->query("SELECT * FROM gare WHERE id=".$idGara);
  $row = $result->fetch_assoc();
  $result->free_result();
  return $row;
}

function requestProblem($idGara, $numP){
  $result = $GLOBALS['sql']->query("SELECT * FROM gare WHERE id=".$idGara);
  $row = $result->fetch_assoc();
  $result->free_result();
  return json_decode($row['problemi'])[$numP];
}

function requestTickets($idGara){
  $items = array();
  $result = $GLOBALS['sql']->query("SELECT * FROM gara".$idGara." ORDER BY time");
  $i = 0;
  if($result === 0){
    return Array();
  }
  while(($row = $result->fetch_assoc())) {
      $items[$i] = $row;
      $i++;
  }
  $result->free_result();
  return $items;
}


 ?>
