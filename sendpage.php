<?php
include_once "php/dbh.be.php";
include_once "php/requests.be.php";
session_start();


if(!isset($_SESSION['username']) && ( $_SESSION['teamdata'][0] != $_GET['idgara'] || $_SESSION['teamdata'][1] != $_GET['squadra'] )) {
  header("Location: index.php");
}

$idgara = $_GET['idgara'];
$squadra = $_GET['squadra'];
$problema = $_GET['problema'];
 ?>

<link rel="stylesheet" href="style.css">

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>XiQubo - Invia risposta</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
  </head>
  <body>
    <nav style="overflow:hidden; background:transparent;">
      <a href="index.php"><img src="resources/XiQubo.png" alt="XiQubo" width="80px"  height="80px" style="display: block; float: left;"></a>
      <h1 style="font-family: Georgia;">XiQubo - A Zeneixe software</h1>
    </nav>


    <form action="php/send.be.php" method="post" >
      <input type="hidden" name="idgara" value="<?php echo $idgara; ?>">
      <input type="hidden" name="squadra" value="<?php echo $squadra; ?>">
      <input type="hidden" name="problema" value="<?php echo $problema; ?>">
      <input type="submit" name="jolly" value="Imposta come jolly">
    </form>
    <form action="php/send.be.php" method="post">
      <input type="number" name="n" value="0000">
      <input type="hidden" name="idgara" value="<?php echo $idgara; ?>">
      <input type="hidden" name="squadra" value="<?php echo $squadra; ?>">
      <input type="hidden" name="problema" value="<?php echo $problema; ?>">
      <input type="submit" name="submit" value="invia">
    </form>
  </body>
</html>

<?php
/*
Per aprire in nuova finestra:
target="print_popup" onsubmit="window.open('about:blank','print_popup','width=500,height=300');"
*/
 ?>
