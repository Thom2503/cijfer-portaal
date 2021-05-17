<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
<link rel="stylesheet" href="css/homepage.css">
</head>
<style>
.middle{
  text-align: center;
  margin:0 auto;
  height: 200px;
  width: 100px;
  padding-top: 20%;
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
            <li><a href="#about">Naam:</a></li>
            <li><a href="#contact">Logout</a></li>
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
        <div style="color: #dedede">
          dwadwadadsadakwoak dsoap doas odajoddwapdksad <br><br>
        </div>
       <form method="post" action="" autocomplete="off">
         <table border="0">
           <tr>
             <td>Gebruikersnaam:
             <input type="text" name="Gebruikersnaam"></td>
           </tr>
           <tr>
             <td>Wachtwoord:
             <input type="password" name="Wachtwoord"></td>
           </tr>
         </table>
         <!-- <div class="g-recaptcha" data-sitekey="6LcofOMZAAAAANKmaEQK6a7ibpewlD9Mt2pP_0fj" required></div> -->
        <br/>
        <td><input type="submit" name="submit" value="Login"></td>

       </form>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

<?php
session_start();

require 'config.inc.php';

if (isset($_POST['submit']))
{
    $regex = '/^[0-9]+[a-zA-Z]+$/i';

    $gebruikersnaam = $_POST['Gebruikersnaam'];
    $wachtwoord = $_POST['Wachtwoord'];
        $username = $gebruikersnaam;
        $username = mysqli_real_escape_string($mysqli, $username);

        $password = $wachtwoord;
        $password = mysqli_real_escape_string($mysqli, $password);
        $password = hash("sha512", $password);

        if (preg_match($regex, $username))
        {
            $query1 = "SELECT * FROM leraren WHERE
                      GebruikersID = '$username' AND Wachtwoord = '$password'";
                 //check connectie met de database en voer de query uit
                 $resultaat1 = mysqli_query($mysqli, $query1);

                 if (!$resultaat1)
                 {
                     printf("Error: %s\n", mysqli_error($mysqli));
                     exit();
                 }

                 if (mysqli_num_rows($resultaat1) > 0)
                 {
                     //pakt de user uit de database
                     $gebruiker1 = mysqli_fetch_array($resultaat1);
                     //koppelt de session aan de gebruiker
                     $_SESSION['Leraar'] = $gebruiker1['LeraarID'];
                     $_SESSION['Voornaam'] = $gebruiker1['Voornaam'];
                     $_SESSION['Achternaam'] = $gebruiker1['Achternaam'];
                     header("Location:klassen_overzicht.php");
                 }
                 else
                 {
                     echo "<p align='center'>Naam en/of wachtwoord zijn onjuist ingevoerd!";
                     echo "<p><a href='inloggen.php'>ga terug</a></p>";
                 }
        }
        else
        {
            $query = "SELECT * FROM studenten WHERE
                      Gebruikersnaam = '$username' AND Wachtwoord = '$password'";
                 //check connectie met de database en voer de query uit
                 $resultaat = mysqli_query($mysqli, $query);

                 if (!$resultaat)
                 {
                     printf("Error: %s\n", mysqli_error($mysqli));
                     exit();
                 }

                 if (mysqli_num_rows($resultaat) > 0)
                 {
                     //pakt de user uit de database
                     $gebruiker = mysqli_fetch_array($resultaat);
                     //koppelt de session aan de gebruikersnaam
                     $_SESSION['Student'] = $gebruiker['StudentUUID'];
                     $_SESSION['Voornaam'] = $gebruiker['Voornaam'];
                     $_SESSION['Achternaam'] = $gebruiker['Achternaam'];
                     header("Location:student.php?id=".$gebruiker['StudentUUID']);
                 }
                 else
                 {
                     echo "<p align='center'>Naam en/of wachtwoord zijn onjuist ingevoerd!</p>";
                     echo "<p><a href='inloggen.php'>ga terug</a></p>";
                 }
        }
}
?>

</body>
</html>
