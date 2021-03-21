<?php
include_once "php/dbh.be.php";
include_once "php/requests.be.php";
session_start();

if(!isset($_SESSION['username'])){
  header("Location: index.php");
  exit();
}

 ?>

<link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>XiQubo - ADMIN</title>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
  </head>
  <body>
    <nav style="overflow:hidden; background:transparent;">
      <a href="index.php"><img src="resources/XiQubo.png" alt="XiQubo" width="80px"  height="80px" style="display: block; float: left;"></a>
      <h1 style="font-family: Georgia;">XiQubo - A Zeneixe software</h1>
    </nav>
    <input id="id" type="number" name="id" placeholder="ID">
    <button id="create" type="button" name="create">Crea table</button>
    <button id="fetch" type="button" name="fetch">Fetch</button>
    <button id="update" type="button" name="update">Update</button>
    <form action="index.html" method="post" style="display:flex; margin-left: auto; margin-right: auto;">
      <div style="margin-left:auto; margin-right: auto;">
        <label for="nome">Nome della gara</label>
        <input id="nome" type="text" placeholder="Nome"> <br>
        <label for="numsq">Partecipanti</label>
        <input id="numsq" type="number" placeholder="Numero di partecipanti"> <br>
        <label for="squadre">Partecipanti + Password</label>
        <textarea id="squadre" rows="8" cols="80" placeholder="partecipanti + password in JSON"></textarea> <br>
        <label for="numprob">Numero di problemi</label>
        <input id="numprob" type="number" placeholder="Numero di problemi"> <br>
        <label for="problemi">Numero di problemi</label>
        <textarea id="problemi" rows="8" cols="80" placeholder="Problemi in JSON"></textarea> <br>
        <label for="orario">Orario</label>
        <input id="orario" type="text" placeholder="Data di inizio"> <br>
        <label for="orario">Durata</label>
        <input id="durata" type="number" placeholder="durata in secondi"> <br>
      </div>
    </form>


  </body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/admin.js"></script>
</html>
