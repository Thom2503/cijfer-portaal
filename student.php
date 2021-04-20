<?php
  session_start();
  require "php/config.inc.php";
  require "php/average.php";
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Studentpagina</title>
  </head>
  <body>

    <?php
      $sql = "SELECT DISTINCT s.StudentID, s.Voornaam, s.Achternaam, k.KlasNaam, v.VakNaam, v.VakID, c.Cijfer
      FROM vakken as v, klassen as k, studenten as s, cijfer as c
      WHERE s.StudentID = 1 AND c.Student_ID = 1 AND k.KlasID = 1 ";

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
                <td>Cijfer</td>
              </tr>
            </thead>
            <tbody>
              <!-- Om de laatste cijfers te kunnen krijgen van de student -->
              <?php $sqli = "SELECT DISTINCT c.Vak_ID, c.Cijfer, s.StudentID, v.VakNaam
              FROM cijfer as c, studenten as s, vakken as v WHERE s.StudentID = 1 AND c.Student_ID = 1  ";
              $rs = mysqli_query($mysqli, $sqli);
              foreach($rs as $rij)
              {
              ?>
              <tr>
                <td><?php echo $rij['VakNaam'] ?></td>
                <?php if ($rij['Cijfer'] > 0): ?>
                  <td><?php echo $rij["Cijfer"]//echo calculateAvg($rij['StudentID'], $rij['Vak_ID']) ?></td>
                <?php else: ?>
                  <td>Student doet dit vak niet</td>
                <?php endif ?>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          <table border="1">
              <thead>
                <tr>
                  <td>Vak</td>
                  <td>Cijfer (gemiddeld)</td>
                </tr>
              </thead>
              <tbody>
                <!-- Om het gemiddelde cijfer te krijgen van elk vak -->
                <?php $sqlC = "SELECT DISTINCT Cijfer, Vak_ID, Student_ID, VakNaam FROM cijfer, vakken WHERE Student_ID = 1  ";
                $resultaat = mysqli_query($mysqli, $sqlC);

                foreach($resultaat as $r)
                {
                 ?>
                <tr>
                  <td><?php echo $r['VakNaam'] ?></td>
                  <td><?php echo calculateAvgClass($row['StudentID'], $row['VakID']); ?></td>
                </tr>
              </tbody>
              <?php } ?>
            </table>
        <?php
      }
     ?>
  </body>
</html>
