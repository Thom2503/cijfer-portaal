<?php

session_start();

if($_SESSION['Leraar'] == 0)
{
  header("location: index.php");
}

if (isset($_POST['submitknop'])){
    //pak hier al de dingen en stuur hem naar iets toe

    require "php/config.inc.php";

//Pak de sessies op

    $naamtoets = $_SESSION['naamtoets'];
    $klas = $_SESSION['naamklas'];
    $vak = $_SESSION['vak'];
    $periode = $_SESSION['periode'];

//welke klas is het?

//Loop dan door de gegevens heen
    $query = "SELECT * FROM `studenten`, `klassen` WHERE studenten.Klas_ID = klassen.KlasID AND klassen.KlasNaam = '$klas'";


    $resultaat = mysqli_query($mysqli, $query);
//voor elke leerling, stop het in de data base

    if (mysqli_num_rows($resultaat) == 0){
        echo "Er zitten geen studenten in deze klas.";
    } else {
        while ($rij = mysqli_fetch_array($resultaat)){
            $id = $rij['StudentID'];
            $cijfer = $_POST[$id];

            //echo "\$_POST[" . $id . "]";

            //$querytwee = "INSERT INTO `cijfer`(`CijferID`, `Vak_ID`, `Naam_Toets`, `Cijfer`, `Periode_ID`, `Student_ID`) VALUES (NULL,'$vak','$naamtoets','$cijfer','$periode','$id')";
            $querytwee = "INSERT INTO `cijfer`(`CijferID`, `Vak_ID`, `Naam_Toets`, `Cijfer`, `Student_ID`) VALUES (NULL,'$vak','$naamtoets','$cijfer','$id')";

            $resultaattwee = mysqli_query($mysqli, $querytwee);

            if ($resultaattwee == TRUE){
                celebrate();
            } else {
                echo "Helaas konden we student $id niet toevoegen.";
            }
        }
    }

//echo "We hebben iets toegevoegd"; ^^

}

function celebrate(){
    static $called = false;
    if (!$called){
        $called = true;
        //zet hier je code neer
        echo "<div id='bowser'>";
        echo "<p> Het is gelukt!</p>";
        echo "</div>";
    }
}

?>
<!-- <html>
    <head>
        <script defer src="js/javascript.js"></script>
    </head>

    <body>

    </body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cijfer Toevoegen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script defer src="js/javascript.js"></script>
<link rel="stylesheet" href="css/homepage.css">
</head>
<style>
.middle{
  text-align: center;
  margin:0 auto;
  height: 200px;
  width: 100px;
  padding-top: 15%;
}
</style>
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
      <div class="middle">
        <div id="toetsnaam">
            <p>Hoe heet de toets?</p>
            <input type="text" id="naamtoets" onkeyup="laatklaszien()" onkeydown="wipevak()">
        </div>

        <div id="klas">
            <!--
            <select id="klassen" onchange="laatvakzien(); wipeperiode()">
                <option value="I2B2">I2B2</option>
                <option value="I2B1">I2B1</option>
            </select>
            -->
        </div>

        <div id="vak">
            <!--
            <select id="vakken" onchange="laatperiodezien(); wipecijfers()">
                <option>Kies een vak</option><option value="Nederlands">Nederlands</option>
                <option value="Rekenen">Rekenen</option>
            </select>
            -->
        </div>

        <div id="periode">
            <!--<select name="periode" id="selecteerperiode" onchange="laatperiodezien(); wipecijfers">
                <option name="1">Periode 1</option>
                <option name="2">Periode 2</option>
                <option name="3">Periode 3</option>
                <option name="4">Periode 4</option>
            </select>-->
        </div>

        <div id="cijfers">

        </div>

        <div id="resultaat">

        </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

      <script>
      function wipevak(){
          document.getElementById('vak').innerHTML = "";
          wipeperiode();
      }

      function wipeperiode(){
          document.getElementById('periode').innerHTML = "";
          wipecijfers();
      }

      function wipecijfers(){
          document.getElementById('cijfers').innerHTML = "";
      }

      (function (){
          console.log("We zijn nu aan het aftellen!");
          setTimeout(wipebowser, 5000);
      })();

      function wipebowser(){
          var bowser = document.getElementById("bowser");
          console.log("We gaan nu bowser verwijderen");
          if (bowser){
              bowser.remove();
          }
      }
      </script>

</body>
</html>
