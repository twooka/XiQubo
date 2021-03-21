<?php

//PAGE DELLA Classifica

//IL CODICE GENERA LA CLASSIFICA A PARTIRE DAL DATABASE
session_start();

include_once "php/dbh.be.php";
include_once "php/requests.be.php";
include_once "php/utilities.be.php";

//VARIABILI UTILI
if(isset($_GET['id']))
  {$gara = requestGara($_GET['id']);}
else{
    header("Location: gare.php");
    die();
  }
if($gara == NULL){
  header("Location: gare.php");
  die();
}
 ?>


 <!DOCTYPE html>

 <html lang="it" dir="ltr">
   <head>
     <link rel="stylesheet" href="style.css">
     <meta charset="utf-8">
     <title>XiQubo - <?php echo $gara['nome']; ?></title>
   </head>
   <body>
     <nav style="overflow:hidden; background:transparent;">
       <a href="index.php"><img src="resources/XiQubo.png" alt="XiQubo" width="80px"  height="80px" style="display: block; float: left;"></a>
       <h1 style="font-family: Georgia;">XiQubo - A Zeneixe software</h1>
     </nav>


     <div style="display:flex; margin:15px auto 60px auto; align-items: center;">
       <button id="btn">reload</button>
       <div id="clock"> </div>
       <?php  //var_dump($gara['orario']); var_dump($gara['durata']); var_dump($_SERVER['REQUEST_TIME']);?>
       <?php
              if(isset($_SESSION['username'])) {?>
       <form action="risposte.php" method="post" target="_blank">
         <input type="submit" name="submit" value="Invia risposte">
         <input type="hidden" name="idgara" value="<?php echo $gara['id'] ?>">
       </form>
   <?php }else if(!isset($_SESSION['squadra'])){ ?>
       <form action="risposte.php" method="post" target="_blank">
         <input type="number" name="squadra" value="" placeholder="Numero squadra">
         <input type="password" name="password" value="" placeholder="Password">
         <input type="submit" name="submit" value="Invia risposte">
         <input type="hidden" name="idgara" value="<?php echo $gara['id'] ?>">
       </form>
   <?php }else{ ?>
       <form action="risposte.php" method="post" target="_blank">
         <input type="submit" name="submit" value="Invia risposte">
         <input type="hidden" name="idgara" value="<?php echo $gara['id'] ?>">
       </form>
   <?php }  ?>
     </div>


     <table>
       <thead id="testa">
       </thead>
       <tbody id="classifica">
       </tbody>
     </table>

     <div id="nascosto">

     </div>
   </body>
 </html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
  var idgara = <?php echo $_GET['id']; ?>;
</script>
<script type="text/javascript" src="js/gara.js"></script>
