<?php

require "php/config.inc.php";
session_start();

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

        $querytwee = "INSERT INTO `cijfer`(`CijferID`, `Vak_ID`, `Naam_Toets`, `Cijfer`, `Periode_ID`, `Student_ID`) VALUES (NULL,'$vak','$naamtoets','$cijfer','$periode','$id')";

        $resultaattwee = mysqli_query($mysqli, $query);

        if (mysqli_num_rows($resultaattwee) == 0){
            echo "Helaas konden we student $id niet toevoegen.";
        } else {
            echo "We hebben student $id toegevoegd!<br>";
            echo "De query was " . $querytwee . "<br>";
        }
    }
}

//echo "We hebben iets toegevoegd"; ^^

?>
