<?php
session_start();
include "check.php";

function it($giorno){
  if($giorno==0){
    $giorno=7;
  }else{
    $giorno=$giorno-1;
  }

}

function crea_calendario($month, $year){


  $DaysOfWeek = array('Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato');

  $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

  $numberDays = date('t',$firstDayOfMonth);

  $dateComponents = getdate($firstDayOfMonth);

  $monthName = $dateComponents['month'];

  $dayOfWeek = $dateComponents['wday'];

  $dateToday = date('Y-m-d');

  $calendar = "<table class='table table-bordered' style='width:100%'>";
  $calendar.="<center><h2>$monthName $year</h2></center>";

  //$calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m',mktime(0,0,0,$month-1,1,$year))."&year=".date('Y',mktime(0,0,0,$month-1,1,$year))."'>Previous Month</a>";
  //$calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m',mktime(0,0,0,$month+1,1,$year))."&year=".date('Y',mktime(0,0,0,$month+1,1,$year))."'>Next Month</a><center>";



  $calendar.="<tr>";

/*  foreach ($dayOfWeek as $key => $day) {
    //$calendar.="<th class='header'>'{$key} => {$day}'</th>";
  }*/


  foreach($DaysOfWeek as $day) {
    $calendar .= "<th class='header'><h4>$day</h4></th>";
  }

  $calendar.= "</tr><tr>";

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
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Calendario</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/styleCalendar.css">
    </head>
    <body>
      <header>
        <nav>
          <div class="logo">
            <h2>Sala Stampa</h2>
          </div>
        </nav>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?php
            $dateComponents = getdate();
            $month = $dateComponents['mon'];
            $year = $dateComponents['year'];
            echo crea_calendario($month,$year);
            ?>
          </div>
        </div>
      </div>

    </body>
  </html>
  <?php
}
  else{
    echo $_SESSION["token"]."    ".$_COOKIE["token"];
    echo "<html>
    <a href='../index.php'>
    <h1>Non puoi accedere a questa pagina


    </html>";
  }


?>
