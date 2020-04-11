<?php

$user=$_POST[text];
$pass=$_POST[password];

auth();

function auth(){
  if($user=="Giulio"&&$pass=="cacca"){
    header('Location: https://www.youtube.it');
    exit;
}








?>
