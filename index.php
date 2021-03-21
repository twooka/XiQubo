<!DOCTYPE html>

<?php
//INDEX PAGE
//DA QUI SI ACCEDE A TUTTI I CONTENUTI

//FATTO:

//FUNZIONALITA' DI BASE

// TODO:

//-Risultati vecchie gare

session_start();
?>



<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>XiQubo</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">

  </head>
  <body>
    <nav style="overflow:hidden; background:transparent;">
      <a href="index.php"><img src="resources/XiQubo.png" alt="XiQubo" width="80px"  height="80px" style="display: block; float: left;"></a>
      <h1 style="font-family: Georgia;">XiQubo - A Zeneixe software</h1>
    </nav>
    <img src="resources/XiQubo.png" alt="XiQubo" width="400px"  height="400px" style="display: block; margin-left: auto; margin-right: auto;">
    <table cellpadding="20px" style="margin:auto;">
      <tr onclick="location.href= 'gare.php'" style="cursor:pointer;"><th>Gare</th></tr>
      <tr onclick="location.href = 'admin.php'"><th>Guarda risultati gare (WIP)</th></tr>
      <?php if(!isset($_SESSION['username'])) {?>
      <tr onclick="location.href= 'login.php'" style="cursor:pointer;"><th>Login (Admin)</th></tr>
    <?php }else{ ?>
      <tr onclick="location.href= 'php/logout.be.php'" style="cursor:pointer;"><th>Logout</th></tr>
    <?php } ?>
    </table>
  </body>
</html>
