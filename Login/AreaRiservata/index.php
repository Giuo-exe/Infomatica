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
        <img class="logo" src="images/logo.svg" alt="logo">
        <nav>
          <ul class="nav__links">
            <li><a href="#">Servizi</a></li>
            <li><a href="#">Stampa</a></li>
            <li><a href="#">Contattaci</a></li>
          </ul>
        </nav>
        <a class="cta" href="#"><button>Accedi</button></a>
      </header>
    </body>
  </html>
  <?php
}
  else{
    echo "<html>
    <a href='https://www.youtube.com/watch?v=bfDnnG2Rcwg&has_verified=1'>
    <h1>Non puoi accedere a questa pagina
    </html>";}


?>
