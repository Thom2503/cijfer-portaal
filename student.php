<?php
  session_start();

  $uuid = $_GET['id'];

  require "php/config.inc.php";
  require "php/average.php";
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Studentpagina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klassen Overzicht</title>
  <script defer src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="css/homepage.css">
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
      <div class="middle" style="position: relative; top: 50px; width: 90%; margin-right: -1em;">
        <?php
          $sql = "SELECT s.StudentID, s.Voornaam, s.Achternaam, c.Cijfer, k.KlasNaam, v.VakNaam, c.Vak_ID, c.Naam_Toets
          FROM studenten as s, klassen as k, cijfer as c, vakken as v
          WHERE s.StudentID = c.Student_ID AND s.Klas_ID = k.KlasID AND v.VakID = c.Vak_ID AND s.StudentUUID = '$uuid'";

          //SELECT c.Vak_ID, c.Cijfer, v.VakNaam, c.Naam_Toets, c.Student_ID FROM cijfer as c, vakken as v
          //SELECT DISTINCT s.StudentID, s.Voornaam, s.Achternaam, k.KlasNaam FROM vakken as v, klassen as k, studenten as s WHERE s.StudentID = 1 AND k.KlasID = 1

          $result = mysqli_query($mysqli, $sql);

          if (!$result)
          {
            echo "Kon geen resultaten vinden! Probeer het later opnieuw.";
          } else
          {
            //lees de gegevens uit
            $row = mysqli_fetch_array($result);
            ?>
              <h2><?php echo $row['Voornaam']." ".$row['Achternaam'] ?></h2>

              <em><?php echo $row['KlasNaam'] ?></em>
              <h4>Laatste cijfers:</h4>
              <table border="1">
                <thead>
                  <tr>
                    <td>Vak</td>
                    <td>Toetsnaam</td>
                    <td>Cijfer</td>
                  </tr>
                </thead>
                <tbody>
                  <!-- Om de laatste cijfers te kunnen krijgen van de student -->
                  <?php $sqli = "SELECT s.StudentID, s.Voornaam, s.Achternaam, c.Cijfer, k.KlasNaam, v.VakNaam, c.Vak_ID, c.Naam_Toets
                  FROM studenten as s, klassen as k, cijfer as c, vakken as v
                  WHERE s.StudentID = c.Student_ID AND s.Klas_ID = k.KlasID AND v.VakID = c.Vak_ID AND s.StudentID = ".$row['StudentID'];
                  //SELECT DISTINCT c.Vak_ID, c.Cijfer, s.StudentID, v.VakNaam, c.Naam_Toets
                  //FROM cijfer as c, studenten as s, vakken as v WHERE s.StudentID = 1 AND c.Student_ID = 1
                  $rs = mysqli_query($mysqli, $sqli);
                  foreach($rs as $rij)
                  {
                  ?>
                  <tr>
                    <td><?php echo $rij['VakNaam'] ?></td>
                    <td><?php echo $rij['Naam_Toets'] ?></td>
                    <td><?php echo $rij['Cijfer'] ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
              <h4>Cijfers gemiddeld</h4>
              <table border="1">
                  <thead>
                    <tr>
                      <td>Vak</td>
                      <td>Cijfer (gemiddeld)</td>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Om het gemiddelde cijfer te krijgen van elk vak -->
                    <?php $sqlC = "SELECT DISTINCT s.StudentID, s.Voornaam, s.Achternaam, c.Cijfer, k.KlasNaam, v.VakNaam, c.Vak_ID, c.Naam_Toets
                    FROM studenten as s, klassen as k, cijfer as c, vakken as v
                    WHERE s.StudentID = c.Student_ID AND s.Klas_ID = k.KlasID AND v.VakID = c.Vak_ID AND s.StudentID = ".$row['StudentID'];
                    $resultaat = mysqli_query($mysqli, $sqlC);

                    //$r = $resultaat->fetch_assoc();
                    $gemiddelden = Array();
                    foreach($resultaat as $r)
                    {
                      $naam = $r['VakNaam'];
                      array_push($gemiddelden, $naam);
                      $uniek = array_unique($gemiddelden);
                     ?>
                      <tr>
                        <td><?php echo $r['VakNaam'] ?></td>
                        <td><?php echo calculateAvg($r['StudentID'], $r['Vak_ID']); ?></td>
                      </tr>
                    </tbody>
                <?php }?>
                </table>
            <?php
          }
         ?>
         <button type="button" id="print_to_pdf" name="button">Download cijfers</button>
      </div>
  </body>
  <script type="text/javascript">
  document.getElementById('print_to_pdf').onclick = function () {
     var element = document.getElementsByTagName('body')[0]
     html2pdf().from(element).toPdf().save('cijfers.pdf')
   }
  </script>
</html>
