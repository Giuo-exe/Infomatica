<?php
session_start();
include "check.php";
include "pre.php";
include "connection.php";
include "operator/services.php";

$preno = Array();

function prendidati($day,$month,$year){

  $sql = "SELECT p.nome, p.cognome, p.ruolo, p.classe, pr.n_copie, pr.costo, pr.date, pr.pagine, pr.tipo, pr.id_prenotazione,pr.nome_file FROM persona p join prenotazione pr on p.username=pr.richiedente WHERE MONTH(pr.date)=$month and YEAR(pr.date)=$year and DAY(pr.date)=$day";
  $conn = connect();
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
      $id=$tupla['id_prenotazione'];
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
      $oggetto = new pre($id,$n,$c,$r,$cl,$p,$n_c,$costo,$t,$d,$f,"");
      $preno[] = $oggetto;
    }
    return $preno;
  }
}

function prenotazioni(){
  if(isset($_GET['day'])&&isset($_GET['month'])&&isset($_GET['year'])){
    $day=$_GET['day'];
    $month=$_GET['month'];
    $year=$_GET['year'];
    $prenotati = Array();
    $prenotati = prendidati($day,$month,$year);

    $ruolo=$_SESSION['ruolo'];

    $orari = array("07:45","08:00","08:15","08:30","08:45",
                  "09:00","09:15","09:30","09:45",
                  "10:00","10:15","10:30","10:45",
                  "11:00","11:15","11:30","11:45",
                  "12:00","12:15","12:30","12:45",
                  "13:00","13:15","13:30");

    $ris = $ruolo == "studente" ? 1 : 0;
    $griglia="";

    for($i=$ris;$i<count($orari);$i++){
      $trovato = false;
      $app=0;
      $j=0;

      if($prenotati!=null){
        while($j<count($prenotati)&&!$trovato){
          $orario = $prenotati[$j] -> get_orario();
          $or = date("h:i", strtotime($orario));

          if($or == $orari[$i]){
            $trovato = TRUE;
            $app = $j;
          }
          $j++;
        }
      }

      if(!$trovato){
        $time = $orari[$i];
        $griglia.="<a href='formp.php?day=$day&month=$month&year=$year&time=$time'>";
      }

      $griglia.="<div class='zoom'>";

      $griglia.="<div class='box'>";

      if($trovato){
        $prenotati[$app] -> get_nome();
        $app1 = $prenotati[$app] -> get_nome();
        $app2 = $prenotati[$app] -> get_cognome();
        $app3 = $prenotati[$app] -> get_classe();
        $app4 = $prenotati[$app] -> get_ruolo();
        $griglia.="<h4>$app1 $app2   $app3   $app4</h4>";

        $user = $_SESSION["username"];
        $ora = $prenotati[$app] -> get_orario();
        $griglia.="<i class='fas fa-trash' onclick='eliminaProgrammazione($user,$ora)'></i>";
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
            <h3>Sala Stampa</h3>
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
    echo "<html>
    <a href='../index.php'>
    <h1>Non puoi accedere a questa pagina


    </html>";}


?>
