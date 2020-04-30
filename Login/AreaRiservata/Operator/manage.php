<?php
session_start();

include "check.php";
include "../connection.php";
include "../pre.php";

$preno = Array();

function prendidati($day,$month,$year){

  $sql = "SELECT p.nome, p.cognome, p.ruolo, p.classe, pr.n_copie, pr.costo, pr.date FROM persona p join prenotazione pr on p.username=pr.richiedente WHERE MONTH(pr.date)=$month and YEAR(pr.date)=$year and DAY(pr.date)=$day";
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
      $preno[] = $oggetto;
    }
    return $preno;
  }
}

function dhn(){

  $Attributi = Array("Nome","Cognome","Ruolo","Classe","Pagine","Copie","Costo","Data");

  $tabella = "<table class='table table-bordered' style='width:100%'>";

  foreach($Attributi as $a) {
    $tabella .= "<th class='header'><h4>$a</h4></th>";
  }

  $tabella.= "</tr><tr>";

  if($dayOfWeek > 0){
    for($k=0;$k<$dayOfWeek;$k++){
      $calendar.="<td></td>";
    }
  }

  $currentDay = 1;

  $month = str_pad($month, 2,"0", STR_PAD_LEFT);

  while($currentDay <= $numberDays){
  //  $calendar.="<a href='book.php?day='$currentDay'&month='$month>";
    // se la settima colonna è stata raggiung inzia una nuova $remainingDays
    if($dayOfWeek == 7){
      $dayOfWeek = 0;
      $calendar.="</tr><tr>";
    }

    $currentDayRel = str_pad($currentDay, 2,"0", STR_PAD_LEFT);
    $date = "$year-$month-$currentDayRel";
    if($dateToday==$date){
      $calendar.="<td class='today'><a href='prenotazione.php?day=$currentDay&month=$month&year=$year'><h4>$currentDay</h4>";
    }else{
      $calendar.="<td><a href='prenotazione.php?day=$currentDay&month=$month&year=$year'><h4>$currentDay</h4>";
    }

    /*$dayname = stroloer(date('l',strtotime($date)));
    $eventNum = 0;
    $today = $date==date('T-m-d')? "today" : "";
    if(date<date('T-m-d')){
      $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>N/A</button>";
    }else{
      $calendar.="<td class='today'><h4>$currentDay</h4> <a href='book.php?date=".$date."' class='btn btn-success btn-xs'>Book</a>";
    }*/


    $calendar.="</a></td>";


    //incremento il contatore
    $currentDay++;
    $dayOfWeek++;
  }

  //completamento della riga nell'ultima settimana del mese se necessario

  if($dayOfWeek !=7){
    $remainingDays = 7-$dayOfWeek;
    for($i=0;$i<$remainingDays;$i++){
      $calendar.="<td></td>";
    }
  }

  $calendar.="</tr>";
  $calendar.="</table>";

  echo $calendar;
}

if(check()){
?>
  <html>
  </html>
<?php
}
?>
