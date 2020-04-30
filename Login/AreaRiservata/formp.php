<?php
  session_start();

  include "connection.php";

  $username = $_SESSION['username'];
  echo $username;
  $day=$_GET['day'];
  $month=$_GET['month'];
  $year=$_GET['year'];
  $time=$_GET['time'];

  $date="$year-$month-$day $time:00";


  if(isset($_POST['conferma'])){
    if(isset($_POST['note'])&&isset($_POST['copie'])&&isset($_POST['pagine'])&&isset($_POST['tipo'])){
      echo "cane";
      $note = $_POST['note'];
      $copie = $_POST['copie'];
      $pagine = $_POST['pagine'];
      $tipo = $_POST['tipo'];
      $costo=00.00;

      if($tipo="A3")
        $costo = $copie * $pagine * 0.10;
      else if($tipo="A4")
        $costo = $copie * $pagine * 0.05;

        echo $costo;

      $sql="Insert into prenotazione(n_copie,costo,note,richiedente,date,tipo,pagine)
        values('$copie','$costo','$note','$username','$date','$tipo','$pagine')";
        $conn=connect();
            if ($conn->query($sql) === TRUE) {
              echo "Dati Inseriti";

                header("refresh:2; url=index.php");

            } else {
              echo "Errore nella query: " . $conn->error;
            }

        $conn->close();

  }else{
    echo "<h1>Devi inserire tutti i dati!<h1>";
  }
}
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Prenota</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styleform.css">
</head>
<body>
  <div id='stars'></div>
  <div id='stars2'></div>
  <div id='stars3'></div>
  <form method='POST' action=''>
    Pagine<input type='number' name='pagine' min='0'><br>
    Note Aggiuntive<input type='text' name='note'><br>
    Classe<input type='text' value=<?php echo $_SESSION['classe'];?> name='classe'><br>
    Copie<input type='number' name='copie' min='0'><br>
    <div class='radio-group'>
      <label>
        <input type='radio' value='A3' name='tipo'>
        A3
        <span></span>
      </label>
      <label>
        <input type='radio' value='A4' name='tipo'>
        A4
        <span></span>
      </label>
    </div>
    <input type='submit' name='conferma'>
  </form>
</body>

</html>
