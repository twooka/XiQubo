<?php

include_once "dbh.be.php";
include_once "requests.be.php";

if(!isset($_POST['submit']) && !isset($_POST['jolly'])) {
  header("Location: ../index.php");
  return 0;
}

$idgara = $_POST['idgara'];
$squadra = $_POST['squadra'];
$problema = $_POST['problema'];

$n = $_POST['n'];

$jolly = 0;
if(isset($_POST['jolly'])){
  $jolly=1;
}

$gara = requestGara($idgara);
$problemi = json_decode($gara['problemi']);

$time = time();
$finegara = strtotime($gara['orario'])+$gara['durata'];
if($time>$finegara) {
  ?>
  <script type="text/javascript">
    self.close();
  </script>
  <?php
  exit();
}

$tipo = 0;
if($jolly == 1){
  $tipo = 2;
}else if($n == $problemi[$problema]){
  $tipo = 1;
}
if($tipo !=2 && requestSolved($idgara)[$squadra][$problema]==1){
  ?>
  <script type="text/javascript">
    self.close();
  </script>
  <?php
  exit();
}
$tbname = "`"."gara".(string)($idgara)."`";
$qrstmt = "INSERT INTO ".$tbname." (`squadra`, `tipo`, `problema`) VALUES (?, ?, ?)";
if (!($query = $sql->prepare($qrstmt))) {
    echo "Prepare failed: (" . $sql->errno . ") " . $sql->error;
}
$query->bind_param('iii', $squadra, $tipo, $problema);

var_dump($squadra);
var_dump($tipo);
var_dump($problema);
var_dump($qrstmt);
$query->execute();
$query->close();
$sql->close();


 ?>
<script type="text/javascript">
  self.close();
</script>
