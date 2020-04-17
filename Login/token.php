<?php
session_start();

function generateToken($user,$pass){
  $token=md5($user,$pass,rand(0,100000));
  setcookie("token", $token, time() + (60 * 30), "/");
  $_SESSION["token"]=$_COOKIE[token];
  return $token;
}



?>
