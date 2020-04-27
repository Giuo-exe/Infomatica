<?php
  session_start();

  $username=$_SESSION['username'];
  $nome=$_SESSION['nome'];
  $cognome=$_SESSION['cognome'];
  $ruolo=$_SESSION['ruolo'];



echo"
  <form method='POST' action=''>
    <input type='text' value='$username' name='username'><br>
    <input type='text' value='$nome' name='nome'><br>
    <input type='text' value='$cognome' name='cognome'><br>
    <h2>Ruolo:$ruolo<h2><br>
    <input type='text' name='classe'><br>
    <input type='number' name='numero'><br>
    <input type='submit' name='Conferma'>
  </form>";
?>

<html>

</html>
