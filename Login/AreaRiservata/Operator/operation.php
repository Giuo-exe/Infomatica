<?php
  session_start();
  include "../connection.php";
  include "../check.php";
  include "services.php";


    function createButtons(){

      $id = $_GET['id'];

      $ris = "<button class='stampa' onclick='Stampa($id)'>
                <image src='img/stamp.svg'></image>
              </button>
              <button class='delete' onclick='Cancella($id)'>
                <image src='img/delete.svg'></image>
              </button>";
      $ris.= !empty($_GET['file']) ? "<button class='stampa'>
                                        <image src='img/download.svg'></image>
                                      </button>" : "";
      echo $ris;
    }

    if(isset($_GET["delete"])){
      $id = $_GET['id'];

      if(eliminaProgrammazione($id)){
        header("Location: manage.php");
      }
    }

if(check()){
 ?>

<html>
  <body>

    <?php createButtons(); ?>

    <script>
    //$copie,$pagine,$costo,$note,$richiedente,$id_prenotazione,$operatore,$data
      function Stampa(id){
        var r = confirm("Sei sicuro di voler Stampare?");
        if (r == true) {
          document.location.href="stampa.php?id="+id;
        }
      }

      function Cancella(id){
        if (confirm("Sei sicuro di voler eliminare questa programmazione?")) {
          document.location.href="operation.php?delete=si&id="+id;
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


  </html>";}
 ?>
