<?php
    session_start();

if (!empty($_POST["username"]) & !empty($_POST["password"])) {
  $user=$_POST["username"];
  $pass=$_POST["password"];
}else if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    $user=$_COOKIE["username"];
    $pass=$_COOKIE["password"];
}

auth();



function auth(){
  if($user="ciao" && $pass="1234"){
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
