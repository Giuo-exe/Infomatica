<?php
  session_start();
  include "../connection.php";
  include "../check.php";
  include "services.php";


    function createButtons(){

      $id = $_GET['id'];

      $ris = $_SESSION['ruolo']=="operatore" ? (!isset($_GET['stamp']) ? "<button class='stampa' onclick='Stampa($id)'>
                                                  <span>Stampa</span>
                                                </button>" : "") : "";


                  $ris.= isset($_GET['stamp']) ? "<button class='delete' onclick='CancellaStampa($id)'>
                                                    <span>Elimina Stampa</span>
                                                  </button>" :
                                                  "<button class='delete' onclick='Cancella($id)'>
                                                    <span>Elimina Stampa</span>
                                                  </button>";
      echo $ris;
    }

    function Controlla(){
      $ris = !empty($_GET['file']) ? true : false;
      return $ris;
    }

    if(isset($_GET["delete"])){
      $id = $_GET['id'];
      $nome_file;
      $sql = "SELECT nome_file FROM prenotazione where id_prenotazione='$id'";
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
          $nome_file = $tupla['nome_file'];
          unlink("../caricamenti/$nome_file");
        }
      }

      if(eliminaProgrammazione($id)){
        eliminaFile($nome_file);
        header("refresh:2; url= manage.php");
      }
    }

    if(isset($_GET["stampa"])){

      $id = $_GET['id'];

      if(eliminaStampa($id)){
        header("refresh:2; url=../index.php");
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
    <link rel="stylesheet" href="css/styleButton.css">
    <style>
    body{
      position: fixed;
      top:30%;
      left:20%;
    }
    button {

      display: inline-block;
      margin: 10px;
       font-size: 18px;
       border: 2px solid #AD235E;
       border-radius: 15px;
       width: 300px;
       height: 300px;
    }

    span{
      text-size: 50;

    }
    </style>
  </head>
  <body>

    <?php createButtons(); ?>

    <?php if(Controlla()){?>
      <a href=download.php?file=<?php echo $_GET['file']?>>
        <button class='stampa'>
          <span>Scarica File</span>
        </button>
      </a>
    <?php  }?>

    <script>
    //$copie,$pagine,$costo,$note,$richiedente,$id_prenotazione,$operatore,$data
      function Stampa(id){
        var r = confirm("Sei sicuro di voler Stampare?");
        if (r == true) {
          document.location.href="stampa.php?&id="+id;
        }
      }

      function Cancella(id){
        if (confirm("Sei sicuro di voler eliminare questa programmazione?")) {
          document.location.href="operation.php?delete=si&id="+id;
        }
      }
      function CancellaStampa(id){
        if (confirm("Sei sicuro di voler eliminare questa Stampa?")) {
          document.location.href="operation.php?stampa=si&id="+id;
        }
      }

      function Download(){
        if (confirm("Sei sicuro di voler scaricare il file?")) {
          document.location.href="operation.php?download=si";
        }
      }

    </script>
  </body>
<html>

<?php
}else{
  echo "<html>
  <a href='../../index.php'>
  <h1>Non puoi accedere a questa pagina


  </html>";
}
 ?>
