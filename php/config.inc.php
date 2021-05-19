<?php
$db_host = 'localhost';
$db_naam = 'root';
$db_pass = '';
$db_db = 'cijfer_portaal';

//login gegevens
//$db_host = 'localhost';
//$db_naam= 'dbberoeps33';
//$db_pass = 'a3q%SN%V23NGV!';
//$db_db = '_beroeps33';

error_reporting(E_ERROR | E_PARSE );

$mysqli = mysqli_connect($db_host, $db_naam, $db_pass, $db_db);
?>
