<?php
  session_start();
  include "../connection.php";
  include "../pre.php";
  include "services.php";

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
      $data = date("Y-m-d h:i:s");


      if(aggiungiStampa($copie,$pagine,$tipo,$costo,$richiedente,$operatore,$data)){
        echo "Inserimento riuscito";

        header("refresh:2; url=../index.php");
      }else{
        echo "Inserimento non riuscito";
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
      echo "";
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

      if(isset($_GET['id'])){
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


      $ris ="<form method='POST' action=''>
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
      </form>";

      echo $ris;
    }else{
      echo "Non puoi accedere a questa pagina";
    }
  }

  function giungiStampa(){
  }

?>

<html>
  <?php creaForm() ?>
</html>
