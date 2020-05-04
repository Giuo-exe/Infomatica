<?php

$file = $_GET['file'];
$file_url = '../caricamenti/'.$file;
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
readfile($file_url);

?>
