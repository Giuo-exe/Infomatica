<?php
    session_start();

    $CookiesTime = 60;



  if (!empty($_POST["username"]) & !empty($_POST["password"])) {
    $user=$_POST["username"];
    $pass=md5($_POST["password"]);
      EstraiDati();
  }else if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    $user=$_COOKIE["username"];
    $pass=md5($_COOKIE["password"]);
      EstraiDati();
  }

  function EstraiDati(){
    include "connection.php";
    $sql = "SELECT username,password from persona";
    echo "diomorto";
    $records=$conn->query($sql);
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
				$u=$tupla['username'];
				$p=$tupla['password'];
			}
      auth();
		}
  }

  function auth(){
    if($user=$u && $pass=$p){
      settacookie($user,$pass);
      createToken($user,$pass);
      header("Location: AreaRiservata\index.php");
    }
  }

  function settacookie($username,$password){
    if(!isset($_COOKIE["username"]) && !isset($_COOKIE["password"])) {
      setcookie("username", $username, time() + ($CookiesTime), "/");
      setcookie("password", $password, time() + ($CookiesTime), "/");
    }
  }

  function createToken($user,$pass){
    $random=rand(0,100000);
    $token=md5($user.$pass.$random);
    setcookie("token", $token, time() + ($CookiesTime), "/");
    $_SESSION["token"]=$_COOKIE["token"];
  }

?>
