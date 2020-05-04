<?php
include "connection.php";

if(isset($_POST['username'])&&isset($_POST['nome'])
&&isset($_POST['cognome'])&&isset($_POST['password'])
&&isset($_POST['conpassword'])&&isset($_POST['ruolo'])
&&isset($_POST['classe'])&&isset($_POST['email'])){

  $email = $_POST['email'];
  $username = $_POST['username'];
  $nome = $_POST['nome'];
  $cognome = $_POST['cognome'];
  $password = md5($_POST['password']);
  $conpassword = md5($_POST['conpassword']);
  $ruolo = $_POST['ruolo'];
  $classe = $_POST['classe'];
  $trovato=false;

  if($password == $conpassword){
    $user = prendidati();
    if($user!=null){
      $i=0;
      while(!$trovato&&$i<count($user)){

        $trovato = $user[$i]==$username ? true : false;
        $i=$i+1;
      }
    }
    if(!$trovato){
    $sql="Insert into persona(username,password,nome,cognome,email,ruolo,classe)
      values('$username','$password','$nome','$cognome','$email','$ruolo','$classe')";
      $conn=connect();
          if ($conn->query($sql) === TRUE) {
            echo "Dati Inseriti";

          header("refresh:3; url=index.php");

          } else {
            echo "Errore nella query: " . $conn->error;
          }

      $conn->close();

    }else{
      echo "<a href='Register.php'>
              <h1>Username gia presente</h1>
            </a>";
    }
    }else{
      echo "<a href='Register.php'>
              <h1>Password diverese</h1>
            </a>";
    }
  }else{
    echo "<a href='Register.php'>
            <h1>Devi inserire tutti i dati!<h1>
          </a>";
  }

  function prendidati(){
    $user = array();
    $sql = "SELECT p.username FROM persona p";
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
				$u=$tupla['username'];
        $user[]=$u;
			}
		}
    return $user;
  }
?>
