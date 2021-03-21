<?php

//FILE UTILITIES

//CONTIENE TUTTE LE FUNZIONI PER PARSARE DAL DATABASE ET SIMILIA

function parseProblems($pstring){
  return json_decode($pstring);
}

function checkTeamPassword($teamname, $password, $teamstring){
  $teams = json_decode();
  foreach($teams as $team){
    if($team[0] == $teamname){
      return ($team[1] == $password);
    }
  }
  return false;
}











 ?>
