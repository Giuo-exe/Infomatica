<?php

function eliminaProgrammazione($id){
  $sql="DELETE from prenotazione WHERE id_prenotazione='$id'";
    $conn=connect();
        if ($conn->query($sql) === TRUE) {
          $conn->close();
          return true;
        } else {
          echo "Errore nella query: " . $conn->error;
        }

    $conn->close();
    return false;
}

function eliminaStampa($id){
  $sql="DELETE from stampa WHERE id_stampa='$id'";
    $conn=connect();
        if ($conn->query($sql) === TRUE) {
          $conn->close();
          return true;
        } else {
          echo "Errore nella query: " . $conn->error;
        }

    $conn->close();
    return false;
}

function eliminaFile($id){
  $sql="DELETE from file WHERE nome='$id'";
    $conn=connect();
        if ($conn->query($sql) === TRUE) {
          $conn->close();
          return true;
        } else {
          echo "Errore nella query: " . $conn->error;
        }

    $conn->close();
    return false;
}

function aggiungiStampa($copie,$pagine,$tipo,$costo,$richiedente,$operatore,$data){
  $sql="Insert into stampa(n_copie,pagine,tipo,costo,richiedente,operatore,date)
    values('$copie','$pagine','$tipo','$costo','$richiedente','$operatore','$data')";
    $conn=connect();
        if ($conn->query($sql) === TRUE) {
          $conn->close();
          return true;
        } else {
          echo "Errore nella query: " . $conn->error;
        }
    $conn->close();
    return false;
}


//da chiarire
function visualizzaStampa(){
  $sql = "SELECT FROM stampa s join programmazione pr join persona p on s.id=";
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
      $n=$tupla['nome'];
      $c=$tupla['cognome'];
      $r=$tupla['ruolo'];
      $cl=$tupla['classe'];
      $p=$tupla['pagine'];
      $n_c=$tupla['n_copie'];
      $costo=$tupla['costo'];
      $f=$tupla['tipo'];
      $d=$tupla['date'];
      $oggetto = new pre($n,$c,$r,$cl,$p,$n_c,$costo,$f,$d);
      $preno[] = $oggetto;
    }
    return $preno;
  }

}


 ?>
