<?php

//login gegevens


//login gegevens
$db_hostname = 'localhost';
$db_username = 'root';
$db_password = '';
$db_database = 'cijfer_portaal';

error_reporting(E_ERROR | E_PARSE );

//database connectie
$mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

?>
