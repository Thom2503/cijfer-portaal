<?php
  require "config.inc.php";

  $vak = htmlentities($_POST['vakNaam'], ENT_QUOTES);
  $leerlijn = htmlentities($_POST['leerlijnen'], ENT_QUOTES);

  if (empty($leerlijn) || empty($vak))
  {
    echo "Je hebt een veld leeg gelaten";
    exit;
  }

  $query = "INSERT INTO `vakken` (`VakNaam`, `Leerlijn_ID`) VALUES (?, ?)";

  $stmt = mysqli_prepare($mysqli, $query);

  mysqli_stmt_bind_param($stmt, 'si', $vak, $leerlijn);

  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);

  if ($result)
  {
    echo "FOUT";
    header("location: ../vak_toevoegen.php");
  } else
  {
    echo "OK";
    header("location: ../vak_toevoegen.php");
  }
 ?>
