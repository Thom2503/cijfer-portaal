<?php
  require "config.inc.php";

  $leraar = htmlentities($_POST['leraren'], ENT_QUOTES);
  $vak = htmlentities($_POST['vakken'], ENT_QUOTES);

  if (empty($vak) || empty($vak))
  {
    echo "Je hebt een veld leeg gelaten";
    exit;
  }

  $query = "INSERT INTO `vak_leraar`(`vak_ID`, `Leraar_ID`) VALUES (?, ?)";

  $stmt = mysqli_prepare($mysqli, $query);

  mysqli_stmt_bind_param($stmt, 'ii', $vak, $leraar);

  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);

  if ($result)
  {
    echo "FOUT";
    header("location: ../leeraar_toevoeg.php");
  } else
  {
    echo "OK";
    header("location: ../leeraar_toevoeg.php");
  }
 ?>
