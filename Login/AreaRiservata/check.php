<?php

function check(){
  if(isset($_COOKIE["token"])){
    if($_SESSION["token"]==$_COOKIE["token"])
    return true;
  }
  return false;
}


?>
