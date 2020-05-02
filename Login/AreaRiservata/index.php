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
          <a href="logout.php">
            <div class="group">
              <div class="avatar">
              </div>
              <div class="info">
                <h4><?php echo $_SESSION['username'];?></h4>
                <h3>LogOut</h3>
              </div>
            </div>
          </a>
        </nav>
      </header>
      <div class="container">
        <div class="box">
          <a href="calendar.php">
            <h2>1</h2>
            <h3>Prenota una stampa</h3>
            <p>In questa sesione puoi prenotare la sua stampa</pack>
          </a>
        </div>
        <div class="box">
          <a href="operator/manage.php">
            <h2>1</h2>
            <h3>Service One</h3>
            <p>ciao</pack>
          </a>
        </div>
      </div>
    </body>
  </html>
  <?php
}
  else{
    echo "<html>
    <a href='../index.php'>
    <h1>Non puoi accedere a questa pagina


    </html>";}


?>
