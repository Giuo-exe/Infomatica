<?php
session_start();

include "check.php";
include "../connection.php";
include "../pre.php";

$preno = Array();

function prendidati(){
  $ownuser= $_SESSION['username'];
  $sql = $_SESSION['ruolo'] == "operatore" ? "SELECT p.nome,p.cognome,p.ruolo,p.classe,pr.pagine,pr.n_copie,pr.costo,pr.tipo,pr.date,pr.id_prenotazione,pr.nome_file,pr.note from persona p join prenotazione pr on p.username=pr.richiedente ORDER BY pr.date" : "SELECT p.nome,p.cognome,p.ruolo,p.classe,pr.pagine,pr.n_copie,pr.costo,pr.tipo,pr.date,pr.id_prenotazione,pr.nome_file,pr.note from persona p join prenotazione pr on p.username=pr.richiedente WHERE pr.richiedente = '$ownuser' ORDER BY pr.date";
  $conn=connect();
  $records=$conn->query($sql);

  if ( $records == TRUE) {
      //echo "<br>Query eseguita!";
  } else {
    die("Errore nella query: " . $conn->error);
  }
  //gestisco gli eventuali dati estratti dalla query
  if($records->num_rows == 0){
    echo "Non ci sono righe da Mostrare";
  }else{
    if($records){
      while($tupla=$records-> fetch_assoc()){
        $i=$tupla['id_prenotazione'];
        $n=$tupla['nome'];
        $c=$tupla['cognome'];
        $r=$tupla['ruolo'];
        $cl=$tupla['classe'];
        $p=$tupla['pagine'];
        $n_c=$tupla['n_copie'];
        $costo=$tupla['costo'];
        $t=$tupla['tipo'];
        $d=$tupla['date'];
        $f=$tupla['nome_file'];
        $v=$tupla['note'];
        $oggetto = new pre($i,$n,$c,$r,$cl,$p,$n_c,$costo,$t,$d,$f,$v);
        $preno[] = $oggetto;
      }
      return $preno;
    }else{
      echo "<h1>Non c'è niente da Mostrare</h1>";
    }
  }

}

function tabella(){
  $prenotazioni=prendidati();
  $oggi = date("Y-m-d");     //date("h:i", strtotime(
  if(!empty($prenotazioni)){

    $Attributi = Array("Nome","Cognome","Note","Ruolo","Classe","Pagine","Copie","Formato","Costo","Data");


    $tabella = "<table class='content-table'>";

    $tabella.= "<thead><tr>";

    foreach($Attributi as $a) {
      $tabella .= "<th class='header'><h4>$a</h4></th>";
    }

    $tabella.= "</tr></thead>";

    $oggi=true;

    $tabella.="<tbody>";


    foreach($prenotazioni as $a){

      $now = $a -> get_orario();
      $nowbutdate = date("Y-m-d", strtotime($now));
      $or="";

      if(strtotime(date($nowbutdate)) < strtotime(date("Y-m-d"))){
        $or = "<h4 id='passato'>Giorni passati</h4>";
      }else if(strtotime(date($nowbutdate)) == strtotime(date("Y-m-d"))){
        $or = "<h4 id='oggi'>".date("H:i", strtotime($now))."</h4>";
      }else{
        $or = "<h4 id='futuro'>Prossimamente</h4>";
      }

      $id = $a -> get_id();
      $file = $a -> get_file();

      // $or = date("Y-m-d", strtotime($now) < date("Y-m-d") ? "<h4 id: '#passato' >Giorni passati</h4>" : (date("Y-m-d", strtotime($now) == date("Y-m-d")) ? "<h4 id='oggi'>".date("h:i:sa", strtotime($now))."</h4>" : "<h4 id='futuro'>Prossimamente</h4>"));

      $tabella.="<tr data-href='operation.php?id=$id&file=$file'>
        <td>".$a -> get_nome()."</td>".
        "<td>".$a -> get_cognome()."</td>".
        "<td>".$a -> get_note()."</td>".
        "<td>".$a -> get_ruolo()."</td>".
        "<td>".$a -> get_classe()."</td>".
        "<td>".$a -> get_pagine()."</td>".
        "<td>".$a -> get_copie()."</td>".
        "<td>".$a -> get_formato()."</td>".
        "<td>".$a -> get_costo()." €</td>".
        "<td>".$or."</td>";  //.date("h:i", strtotime($a -> get_orario()))
      $tabella.="</tr>";
    }
    $tabella.="</tbody>";
    $tabella.="</table>";
    echo $tabella;
  }

}

if(check()){
?>
  <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Prenotazioni</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
      <center><h1 id="oggi">Prenotazioni</h1></center>
      <?php tabella();?>
      <script>
        document.addEventListener("DOMContentLoaded", () => {
          const rows = document.querySelectorAll("tr[data-href]");

          rows.forEach(row =>{
            row.addEventListener("click", () =>{
              window.location.href = row.dataset.href;
            });
          });
        });
      </script>
    <body>
  </html>
<?php
}else{
  echo "<html>
  <a href='../../index.php'>
  <h1>Non puoi accedere a questa pagina


  </html>";
}
?>
