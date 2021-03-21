<?php

//PAGE IN CUI SI VEDONO LE GARE PROGRAMMATE

include_once "php/dbh.be.php";
include_once "php/requests.be.php";
session_start();
 ?>

<!DOCTYPE html>

<link rel="stylesheet" href="style.css">

<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>XiQubo - Gare</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
  </head>
  <body>

    <nav style="overflow:hidden; background:transparent;">
      <a href="index.php"><img src="resources/XiQubo.png" alt="XiQubo" width="80px"  height="80px" style="display: block; float: left;"></a>
      <h1 style="font-family: Georgia;">XiQubo - A Zeneixe software</h1>
    </nav>


<table style="margin:auto;" border="1" border-color="black" border-radius="9px" cellpadding="20px">
  <thead>
    <th>Nome gara</th>
    <th>Partecipanti</th>
    <th>Numero Problemi</th>
    <th>Orario</th>
  </thead>
  <?php
    foreach (requestGare() as $gara) {
      ?>
        <tr>
          <th><?php echo $gara['nome']; ?></th>
          <th><?php echo $gara['numsq']; ?></th>
          <th><?php echo $gara['numprob']; ?></th>
          <th><?php echo $gara['orario']; ?></th>
          <th onclick="location.href= 'gara.php?id=<?php echo $gara['id']; ?>'" style="cursor:pointer;">Classifica</th>
        </tr>
      <?php
    }
   ?>
</table>

  </body>
</html>
