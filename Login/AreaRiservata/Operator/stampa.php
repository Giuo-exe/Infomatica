<?php
  session_start();
  include "../connection.php";
  include "../pre.php";
  include "services.php";
  include "check.php";

  if(isset($_POST['conferma'])){
    if(isset($_POST['copie'])&&isset($_POST['pagine'])&&isset($_POST['tipo'])){

      $copie = $_POST['copie'];
      $pagine = $_POST['pagine'];
      $tipo = $_POST['tipo'];
      $costo=00.00;
      $richiedente = isset($_POST["richiedente"]) ? $_POST["richiedente"] : "";

      if($tipo="A3")
        $costo = $copie * $pagine * 0.10;
      else if($tipo="A4")
        $costo = $copie * $pagine * 0.05;

      $operatore = $_SESSION['username'];
      $data = date("Y-m-d H:i:s");


      $id = isset($_GET['id']) ? $_GET['id'] : "";
      $nome_file="";
      $sql = "SELECT nome_file FROM prenotazione WHERE id_prenotazione = '$id'";
      $conn=connect();
      $records=$conn->query($sql);

      if ( $records == TRUE) {
          //echo "<br>Query eseguita!";
      } else {
        die("Errore nella query: " . $conn->error);
      }
      //gestisco gli eventuali dati estratti dalla query
      if($records->num_rows == 0){
      }else{
        while($tupla=$records-> fetch_assoc()){
          $nome_file=$tupla['nome_file'];
        }
      }


      if(aggiungiStampa($copie,$pagine,$tipo,$costo,$richiedente,$operatore,$data)){
        echo "<h1 id='riuscito'>Inserimento riuscito</h1>";

        if(!empty($id)){
          eliminaProgrammazione($id);
        }

        if(!empty($nome_file)){
          if(eliminaFile($nome_file)){
            unlink("../caricamenti/$nome_file");
          }else{
          }
        }

         header("refresh:2; url=../index.php");
      }else{
        echo "<h1 id='fallito'>Inserimento non riuscito</h1>";
      }
    }
  }

  function prendidati(){
    $id = $_GET['id'];
    $ownuser= $_SESSION['username'];
    $sql = "SELECT * FROM prenotazione WHERE id_prenotazione = '$id'";
    $conn=connect();
    $records=$conn->query($sql);

    if ( $records == TRUE) {
        //echo "<br>Query eseguita!";
    } else {
      die("Errore nella query: " . $conn->error);
    }
    //gestisco gli eventuali dati estratti dalla query
    if($records->num_rows == 0){
    }else{
      while($tupla=$records-> fetch_assoc()){
        $i=$tupla['id_prenotazione'];
        $ruolo=$tupla['richiedente'];
        $p=$tupla['pagine'];
        $n_c=$tupla['n_copie'];
        $costo=$tupla['costo'];
        $t=$tupla['tipo'];
        $d=$tupla['date'];
        $f=$tupla['nome_file'];
        $v=$tupla['note'];
        $oggetto = new pre($i,"","",$ruolo,"",$p,$n_c,$costo,$t,$d,$f,$v);
        $preno = $oggetto;
        $id_prenotazione=$i;
        $nome_file=$f;
        return $preno;
      }
    }
  }

  function creaForm(){
    if($_SESSION['ruolo']=="operatore"){
      $copie=0;
      $pagine=0;
      $richiedente="";
      $A4="";
      $A3="";

      $o = isset($_GET['id']) ? prendidati() : "";

      if(isset($_GET['id']) && !empty($o)){
        $copie = $o -> get_copie();
        $pagine = $o -> get_pagine();
        $richiedente = $o -> get_ruolo();
        $tipo = $o -> get_formato();
        if($tipo=="A4"){
          $A4="checked";
        }else{
          $A3="checked";
        }
      }


      $ris ="<center><h1 id='stampa'>Stampa</h1></center><br><form class='form-style-9' method='POST' action='' enctype='multipart/form-data'>
        <ul>
          <li>
            <input type='number' value='$pagine' name='pagine' min='1' class='field-style field-split align-left' placeholder='Pagine' />
            <input type='number' value='$copie' name='copie' min='1' class='field-style field-split align-right' placeholder='Copie' />
          </li>
          <li>
            <input type='text' name='richiedente' class='field-style field-split align-left' placeholder='Richiedente' value='$richiedente' />
          </li>
          <li>
            <div class='radio-group'>
              <label>
                <input type='radio' value='A3' name='tipo' $A3>
                <label>A3<label>
                <span></span>
              </label>
              <label>
                <input type='radio' value='A4' name='tipo' $A4>
                <label>A4<label>
                <span></span>
              </label>
            </div>
          </li>
          <li>
            <input type='submit' name='conferma' value='Conferma' class='field-style field-full align-none'/>
          </li>
        </ul>
      </form>";

      /*  "<form method='POST' action=''>
        <label>Pagine</label>
        <input type='number' value='$pagine' name='pagine' min='1'><br>

        <label>Copie</label>
        <input type='number' value='$copie' name='copie' min='1'><br>

        <label>Richiedente</label>
        <input type='text' value='$richiedente' name='richiedente'><br>

        <div class='radio-group'>
          <label>
            <input type='radio' value='A3' name='tipo' $A3>
            <label>A3<label>
            <span></span>
          </label>
          <label>
            <input type='radio' value='A4' name='tipo' $A4>
            <label>A4<label>
            <span></span>
          </label>
        </div>
        <input type='submit' name='conferma'>
      </form>";*/

      echo $ris;
    }else{
      echo "<html>
      <a href='../../index.php'>
      <h1>Non puoi accedere a questa pagina


      </html>";
    }
  }

if(check()){

?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Stampa</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styleForm.css">
  </head>
  <body>
    <?php creaForm() ?>
  </body>
</html>
<?php }
else {
  echo "<html>
  <a href='../../index.php'>
  <h1>Non puoi accedere a questa pagina


  </html>";
} ?>
