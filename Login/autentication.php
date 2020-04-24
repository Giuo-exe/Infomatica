<?php
    session_start();

    function dosomething(){
    include "connection.php";
    $user="";
    $pass="";

  if (!empty($_POST["username"]) & !empty($_POST["password"])) {
    $user=$_POST["username"];
    $pass=md5($_POST["password"]);
      EstraiDati($user,$pass);
  }else if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    $user=$_COOKIE["username"];
    $pass=md5($_COOKIE["password"]);
      EstraiDati($user,$pass);
  }

  function EstraiDati($user,$pass){
    $sql = "SELECT persona.* FROM persona";
    $conn=connect();
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
      auth($u,$p,$user,$pass);
		}
  }

  function auth($u,$p,$user,$pass){
    if($user==$u && $p==$pass){
      settacookie($user,$pass);
      createToken($user,$pass);
      header("Location: AreaRiservata\index.php");
    }
  }

  function settacookie($username,$password){
    if(!isset($_COOKIE["username"]) && !isset($_COOKIE["password"])) {
      setcookie("username", $username, time() + (60 * 30), "/");
      setcookie("password", $password, time() + (60 * 30), "/");
    }
  }

  function createToken($user,$pass){
    $random=rand(0,100000);
    $token=md5($user.$pass.$random);
    setcookie("token", $token, time() + (60 * 30), "/");
    $_SESSION["token"]=$_COOKIE["token"];
  }

?>
