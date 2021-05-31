<?php
session_start();

if($_SESSION['Leraar'] == 0)
{
  header("location: index.php");
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vak toevoegen</title>
    <script defer src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/homepage.css">
    <script defer src="js/vak_toevoeg.js" charset="utf-8"></script>
  </head>
  <body>
    <nav class="navbar navbar-light bg-light navbar-fixed-top" role="navigation" id="navbar_top">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Cijferportaal</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><?php echo $_SESSION['Voornaam']." ".$_SESSION['Achternaam'] ?></a></li>
            <li><a href="loguit.php">Logout</a></li>
          </ul>
        </div>
      </nav>

      <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:10%">
        <h3 class="w3-bar-item"></h3>
        <a href="cijfer_toevoegen.php" class="w3-bar-item w3-button">Cijfer Toevoegen</a>
        <a href="aanpassen.php" class="w3-bar-item w3-button">Cijfer Aanpassen</a>
        <a href="klassen_overzicht.php" class="w3-bar-item w3-button">Overzicht klassen</a>
        <a href="leeraar_toevoeg.php" class="w3-bar-item w3-button">Vak voor leraar</a>
        <a href="vak_toevoegen.php" class="w3-bar-item w3-button">Vak Toevoegen</a>


      </div>
      <div class="middle" style="position: relative; top: 100px; width: 90%; margin-right: -1em;">
        <form action="php/vak_toevoeg_verwerk.php" method="post">
          Naam vak: <br>
          <input type="text" name="vakNaam" id="vakNaam"> <br><br>
          Leerlijn: <br>
          <select name="leerlijnen" id="lerlijnen">
              <?php
                require "php/config.inc.php";

                $sql = "SELECT * FROM leerlijnen";

                $result = mysqli_query($mysqli, $sql);

                foreach($result as $rs)
                {
                  echo "<option value='".$rs['LeerlijnID']."'>".$rs['LeerlijnNaam']."</option>";
                }
               ?>
          </select><br><br>
          <input type="submit" name="submit" id="submit" value="Vak toevoegen">
        </form>
        <div id="result">

        </div>
     </div>
  </body>
</html>
