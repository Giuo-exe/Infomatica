<?php
session_start();
include "check.php";
include "pre.php";
include "connection.php";

function prendidati($day,$month,$year){
  $sql = "SELECT p.nome, p.cognome, p.ruolo, p.classe, pr.n_copie, pr.costo, pr.date FROM persona p join prenotazione pr WHERE MONTH(pr.date)=$month and YEAR(pr.date)=$year and DAY(pr.date)=$day";
  $conn=connect();
  $records=$conn->query($sql);

  $prenotati = Array();

  if ( $records == TRUE) {
      //echo "<br>Query eseguita!";
  } else {
    die("Errore nella query: " . $conn->error);
  }
  //gestisco gli eventuali dati estratti dalla query
  if($records->num_rows == 0){
    echo "la query non ha prodotto risultato";
  }else{
    while($tupla=$records-> fetch_assoc()){
      $n=$tupla['nome'];
      $c=$tupla['cognome'];
      $r=$tupla['ruolo'];
      $cl=$tupla['classe'];
      $n_c=$tupla['n_copie'];
      $costo=$tupla['costo'];
      $d=$tupla['date'];
      $oggetto = new pre($n,$c,$r,$cl,$n_c,$costo,$d);
      $prenotati[] = $oggetto;
    }
    echo count($prenotati)."<br>";
    echo $prenotati[0] -> get_nome();
    echo date("h:i", strtotime($prenotati[0] -> get_nome()));
  }
  return $prenotati;
}

function prenotazioni(){


  if(isset($_GET['day'])&&isset($_GET['month'])&&isset($_GET['year'])){
    $day=$_GET['day'];
    $month=$_GET['month'];
    $year=$_GET['year'];
    $prenotati = prendidati($day,$month,$year);
    $ruolo=$_SESSION['ruolo'];

    $orari = array("7:45","8:00","8:15","8:30","8:45",
                  "9:00","9:15","9:30","9:45",
                  "10:00","10:15","10:30","10:45",
                  "11:00","11:15","11:30","11:45",
                  "12:00","12:15","12:30","12:45",
                  "13:00","13:15","13:30");

    $ris = $ruolo == "studente" ? 1 : 0;
    $griglia="";

    for($i=$ris;$i<count($orari);$i++){
      $trovato = false;
      $app=-1;

      if($prenotati!=null){
        for($j=0;$j<count($prenotati);$j++){
          $orario = $prenotati[$j] -> get_orario();
          $or = date("h:i", strtotime($orario));

          if($or == $orari[$i]){
            $trovato = TRUE;
            $app = $j;
          }
        }
      }

      if(!$trovato){
        $griglia.="<a href='formp.php'>";
      }

      $griglia.="<div class='zoom'>";

      $griglia.="<div class='box'>";

      if($trovato){
        $app1 = $prenotati[$app] -> get_nome();
        $app2 = $prenotati[$app] -> get_cognome();
        $app3 = $prenotati[$app] -> get_classe();
        $app4 = $prenotati[$app] -> get_ruolo();
        $griglia.="<h4>$app1 $app2   $app3   $app4</h4>";
      }

      $griglia.="<h2>$orari[$i]</h2>";

      $griglia.="</div></div>";

      if(!$trovato){
        $griglia.="</a>";
      }
    }
  }
  echo $griglia;
}


if(check()){
  ?>
  <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Navbar</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/stylePrenotation.css">
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
        <?php
          prenotazioni();
        ?>
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
