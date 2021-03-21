<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>XiQubo - Login</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
  </head>
  <body>

    <nav style="overflow:hidden; background:transparent;">
      <a href="index.php"><img src="resources/XiQubo.png" alt="XiQubo" width="80px"  height="80px" style="display: block; float: left;"></a>
      <h1 style="font-family: Georgia;">XiQubo - A Zeneixe software</h1>
    </nav>


      <form class="login" action="php/login.be.php" method="post">
        <input type="text" name="username" value="" placeholder="Username">
        <input type="password" name="password" value="" placeholder="Password">
        <button type="submit" name="submit" value="">Logga</button>
      </form>
  </body>
</html>
