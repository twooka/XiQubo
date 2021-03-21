<?php
include_once "dbh.be.php";
include_once "requests.be.php";
include_once "utilities.be.php";

$gara = requestGara($_GET['id']);
$tickets = requestTickets($_GET['id']);
$problems = parseProblems($gara['problemi']);
$start = strtotime($gara['orario']);
$end = $start+$gara['durata'];
$currentTime = $_SERVER['REQUEST_TIME'];

//classi e funzioni per team

function cmpteams($team1, $team2){
  return $team1->scoressum < $team2->scoressum;
}

class team{
  public $id;
  public $name;
  public $scores = Array();
  public $scoressum;
  public function __construct($_id, $_scores, $_nprob, $_name){
    $this->id = $_id;
    $this->scores = $_scores;
    $this->scoressum = array_sum($_scores)+10*$_nprob;
    $this->name = $_name;
  }
}

//Trova prima e terza risoluzione di ciascun problema
$sol = array_fill(0, $gara['numprob'], Array($currentTime, $currentTime, $currentTime));

foreach ($tickets as $key => $ticket) {
  if($ticket['tipo'] != 1){
    continue;
  }
  if($sol[$ticket['problema']][0]==$currentTime){
    $sol[$ticket['problema']][0] = strtotime($ticket['time']);
  }else if($sol[$ticket['problema']][1] == $currentTime){
    $sol[$ticket['problema']][1] = strtotime($ticket['time']);
  }else if($sol[$ticket['problema']][2] == $currentTime){
    $sol[$ticket['problema']][2] = strtotime($ticket['time']);
  }
}

//calcola bonus punteggi dei problemi

$bonustempo = Array();

foreach ($sol as $key => $s) {
  $bonustempo[$key] = min(intdiv($s[2]-$start, 60), intdiv($gara['durata'],60)-20);
}

$bonuserrori = array_fill(0, $gara['numprob'], 0);
foreach ($tickets as $ticket) {
  if($ticket['tipo']!=0){
    continue;
  }
  if($ticket['time']<$sol[$ticket['problema']][0]){
    $bonuserrori[$ticket['problema']] += 2;
  }
}
$deltabonus = Array();
for ($i=0; $i < $gara['numprob']; $i++) {
  $deltabonus[$i] = (($bonustempo[$i]>=0)?$bonustempo[$i]:0) + $bonuserrori[$i]+20;
}
//calcola i delta dei punteggi per squadra e i jolly
$teamsarray = array_fill(0, $gara['numsq'], array_fill(0, $gara['numprob'], 0));
$jollies = array_fill(0, $gara['numsq'], (($currentTime-$start<10*60)?-1:0));
//var_dump($currentTime);
//var_dump($start);

foreach ($tickets as $ticket) {
  //IMPOSTA IL JOLLY
  if($ticket['time']>$start+601) break;
  if($ticket['tipo'] == 2){
    $jollies[$ticket['squadra']] = $ticket['problema'];
  }
}
foreach ($tickets as $ticket) {
  //SKIPPA I JOLLY
  if($ticket['tipo'] == 2){
    continue;
  }
  //AGGIUNGI PUNTEGGIO PER RISPOSTA CORRETTA
  if($ticket['tipo'] == 1){
    $teamsarray[$ticket['squadra']][$ticket['problema']] += $deltabonus[$ticket['problema']]-($jollies[$ticket['squadra']]==$ticket['problema']?10:0);
  }
  //TOGLI PUNTI PER RISPOSTA SBAGLIATA
  if($ticket['tipo'] == 0){
    $teamsarray[$ticket['squadra']][$ticket['problema']] -= 10;
  }
}

//BONUS CONSEGNA
$r = array_fill(0, $gara['numprob'], 0);
$k = [20, 15, 10, 5];
foreach($tickets as $ticket){
  if($ticket['tipo']!=1) continue;
  if($r[$ticket['problema']]<count($k)) $teamsarray[$ticket['squadra']][$ticket['problema']]+=$k[$r[$ticket['problema']]];
  $r[$ticket['problema']]++;
}

//MOLTIPLICA IN BASE AL JOLLY
foreach ($jollies as $key => $jolly) {
  if($jolly!=-1){
    $teamsarray[$key][$jolly] *= 2;
  }
}
//ASSEGNA PUNTEGGI

$ranking = Array();
for ($i=0;$i<$gara['numsq'];$i++) {
  $ranking[$i] = new team($i, $teamsarray[$i], $gara['numprob'], json_decode($gara['squadre'])[$i][0]);
}

if($_GET['ordered']){
  usort($ranking, "cmpteams");
}

$solved = array_fill(0, $gara['numsq'], array_fill(0, $gara['numprob'], 0));
foreach($tickets as $ticket){
  if($ticket['tipo']==2){
    continue;
  }
  $solved[$ticket['squadra']][$ticket['problema']] = $ticket['tipo']*2-1;
}

echo json_encode(array("ranking" => $ranking, "deltabonus" => $deltabonus, "startDate" => $start, "countDownDate" => $end, "jollies" => $jollies, "solved" => $solved));
?>
