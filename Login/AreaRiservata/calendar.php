<?php
session_start();
include "check.php";

function crea_calendario($month, $year){
  $DaysOfWeek = array('Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato','Domenica');

  $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

  $numberDays = date('t',$firstDayOfMonth);

  $dateComponents = getdate($firstDayOfMonth);

  $monthName = $dateComponents['month'];

  $dayOfWeek = $dateComponents['wday'];

  $dateToday = date('Y-m-d');

  $calendar = "<table class='table table-bordered' style='width:100%'>";
  $calendar.="<center><h2>$monthName $year</h2></center>";

  $calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m',mktime(0,0,0,$month-1,1,$year))."&year=".date('Y',mktime(0,0,0,$month-1,1,$year))."'>Previous Month</a>";
  $calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m',mktime(0,0,0,$month+1,1,$year))."&year=".date('Y',mktime(0,0,0,$month+1,1,$year))."'>Next Month</a><center>";

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
      $calendar.="<td class='today'><a href='prenotazione.php?day=$currentDay&month=$month'><h4>$currentDay</h4>";
    }else{
      $calendar.="<td><a href='prenotazione.php?day=$currentDay&month=$month'><h4>$currentDay</h4>";
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
      <title>Navbar</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/style.css">
      <style>
        table, th, td {
          border: 0.5px solid #CCD4D4;
          border-collapse: collapse;
        }
        table{
          padding: 30px;
          table-layout: fixed;
        }

        td{
          width: 33%;
        }

        h4{
          margin: 0;
          padding: 0;
          color: #191919;
          font-size: 22px;
        }

        td h4{
          margin: 0;
          padding: 0;
          color: #191919;
          font-size: 18px;
          text-transform: uppercase;
        }

        .today{
          background: yellow;
        }


        th, td {
          padding: 15px;
          text-align: center;
        }

        table .a{
          display: block;
          text-decoration: none;
        }
      </style>
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
    <a href='https://www.youtube.com/watch?v=bfDnnG2Rcwg&has_verified=1'>
    <h1>Non puoi accedere a questa pagina
    <h1>Torna a fanculo


    </html>";}


?>
