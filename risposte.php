<?php
session_start();
include_once "php/dbh.be.php";
include_once "php/requests.be.php";
include_once "php/utilities.be.php";

if(!isset($_POST['submit']) && !isset($_SESSION['teamdata']) && !isset($_SESSION['username'])){
  header('Location: index.php');
}

if(isset($_POST['idgara'])) $_SESSION['teamdata'][0] = $_POST['idgara'];
if(isset($_POST['squadra'])) $_SESSION['teamdata'][1] = $_POST['squadra'];
if(isset($_POST['password'])) $_SESSION['teamdata'][2] = $_POST['password'];

if(!isset($_SESSION['username']) && json_decode(requestGara($_SESSION['teamdata'][0])['squadre'])[$_SESSION['teamdata'][1]][1]!=$_SESSION['teamdata'][2]){

  ?>
<script type="text/javascript">
  self.close();
</script>
  <?php
}
  $gara = json_decode(requestGara($_SESSION['teamdata'][0]));


 ?>
<link rel="stylesheet" href="style.css">

 <!DOCTYPE html>
 <html lang="it" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>XiQubo - Risposte</title>
     <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
     <link rel="icon" href="favicon.ico" type="image/x-icon">
   </head>
   <body>
     <nav style="overflow:hidden; background:transparent;">
       <a href="index.php"><img src="resources/XiQubo.png" alt="XiQubo" width="80px"  height="80px" style="display: block; float: left;"></a>
       <h1 style="font-family: Georgia;">XiQubo - A Zeneixe software</h1>
     </nav>

     <div style="display:flex; margin:15px auto 60px auto; align-items: center;">
     <button id="btn">reload</button>
     <p style="margin:auto;" id="clock"> </p>
      </div>
    <table>
      <thead id="testa">
      </thead>
      <tbody id="classifica">
      </tbody>
    </table>
   </body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
  var gara = JSON.parse(<?php echo json_encode($gara);?>);
  var squadra = (<?php  echo $_SESSION['teamdata'][1];?>);
  var idgara = <?php echo $_SESSION['teamdata'][0] ?>;
</script>
<?php if(isset($_SESSION['username'])){ ?>
 <script type="text/javascript" src="js/risposteadmin.js"></script>
<?php }else{ ?>
 <script type="text/javascript" src="js/risposte.js"></script>
<?php } ?>

</html>
