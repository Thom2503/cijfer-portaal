<?php

//hier komt een systeem dat er voor zorgt dat je alleen de opgevraagde cijfers ziet

require "config.inc.php";

$zoektekst = $_GET['zoektekst'];

//echo "Zoektekst is \"" . $zoektekst . "\".";

if (strlen($zoektekst) == 0){
    $query = "SELECT DISTINCT(`Naam_Toets`) FROM `cijfer`";

    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) == 0){
        echo "We hebben niks gevonden";
    } else {
        echo "<table>";
        while ($rij = mysqli_fetch_array($result)){
            //hier komt dan de rij en zo
            echo "<tr><td>" . $rij['Naam_Toets'] . "</td><td>" . $rij['KlasNaam'] . "</td><td><p><a href=\"javascript:laatpaginatweezien('" . $rij['Naam_Toets'] . "', '" . $rij['KlasNaam'] . "');\">Een link</a></p></td></tr>";
        }
        echo "</table>";
    }
} else {
    $query = "SELECT DISTINCT(`Naam_Toets`), klassen.KlasNaam FROM `cijfer`, `klassen`, `studenten` WHERE klassen.KlasID = studenten.Klas_ID AND studenten.StudentID = cijfer.Student_ID AND `Naam_Toets` LIKE '%$zoektekst%'";

    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) == 0){
        echo "Er zijn geen toetsen met die naam!";
    } else {
        echo "<table>";
        while ($rij = mysqli_fetch_array($result)){
            echo "<tr><td>" . $rij['Naam_Toets'] . "</td><td>" . $rij['KlasNaam'] . "</td><td><p><a href=\"javascript:laatpaginatweezien('" . $rij['Naam_Toets'] . "', '" . $rij['KlasNaam'] . "');\">Een link</a></p></td></tr>";
        }
        echo "</table>";
    }
}

?>
