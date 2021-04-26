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
  </head>
  <body>

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
          <h4>Laast gehaalde cijfers:</h4>
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
              WHERE s.StudentID = c.Student_ID AND s.Klas_ID = k.KlasID AND v.VakID = c.Vak_ID AND s.StudentID = 1";
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
                <?php $sqlC = "SELECT s.StudentID, s.Voornaam, s.Achternaam, c.Cijfer, k.KlasNaam, v.VakNaam, c.Vak_ID, c.Naam_Toets
                FROM studenten as s, klassen as k, cijfer as c, vakken as v
                WHERE s.StudentID = c.Student_ID AND s.Klas_ID = k.KlasID AND v.VakID = c.Vak_ID AND s.StudentID = 1  ";
                $resultaat = mysqli_query($mysqli, $sqlC);

                foreach($resultaat as $r)
                {
                 ?>
                <tr>
                  <td><?php echo $r['VakNaam'] ?></td>
                  <td><?php echo calculateAvgClass($r['StudentID'], $r['Vak_ID']); ?></td>
                </tr>
              </tbody>
              <?php } ?>
            </table>
        <?php
      }
     ?>
     <button type="button" id="print_to_pdf" name="button">Download cijfers</button>
  </body>
  <script type="text/javascript">
  document.getElementById('print_to_pdf').onclick = function () {
     var element = document.getElementsByTagName('body')[0]
     html2pdf().from(element).toPdf().save('cijfers.pdf')
   }
  </script>
</html>
