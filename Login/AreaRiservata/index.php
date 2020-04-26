<?php
session_start();
include "check.php";
if(check()){
  ?>
  <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Navbar</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
      <header>
        <nav>
          <div class="logo">
            <h4>Sala Stampa</h4>
          </div>
        </nav>
      </header>
      <div class="container">
        <div class="box">
          <a href="calendar.php">
          <h2>1</h2>
          <h3>Prenota una stampa</h3>
          <p>In questa sesione puoi prenotare la sua stampa</pack>
        </div>
        <div class="box">
          <h2>1</h2>
          <h3>Service One</h3>
          <p>ciao</pack>
        </div>
      </div>

    </body>
  </html>
  <?php
}
  else{
    echo $_SESSION["token"]."    ".$_COOKIE["token"];
    echo "<html>
    <a href='https://www.youtube.com/watch?v=bfDnnG2Rcwg&has_verified=1'>
    <h1>Non puoi accedere a questa pagina
    <h1>Torna a fanculo


    </html>";}


?>
