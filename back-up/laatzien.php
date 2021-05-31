<?php

require "php/config.inc.php";

session_start();

if (isset($_GET['toetsnaam']) && isset($_GET['klasnaam'])){
//if (isset($_GET['toetsnaam'])){
    $toetsnaam = $_GET['toetsnaam'];
    $klasnaam = $_GET['klasnaam'];

    echo "<p id='toetsnaam'>Je hebt op " . $toetsnaam . " geklikt</p>";

    $_SESSION['NaamToets'] = $toetsnaam;

    echo "<a href='javascript:Laatpaginaeenzien();'>Terug</a>";

    $query = "SELECT cijfer.Naam_Toets, studenten.StudentID, studenten.Voornaam, studenten.Achternaam, cijfer.Cijfer FROM `cijfer`, `studenten` WHERE cijfer.Naam_Toets = '$toetsnaam' AND cijfer.Student_ID = studenten.StudentID";

    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) == 0) {
        echo "Er zitten geen studenten in deze klas!";
    } else {
        //echo "<form action='' method='post'>";
        echo "<table>";
        echo "<tr><th colspan='2'>Naam</th><th>Cijfer</th></tr>";
        while ($rij = mysqli_fetch_array($result)) {
            echo "<tr>
                    <td>" . $rij['Voornaam'] . "</td>
                    <td>" . $rij['Achternaam'] . "</td>
                    <td><input type='number' onchange='updatecijfer(" . $rij['StudentID'] . ")' id='" . $rij['StudentID'] . "' value='" . $rij['Cijfer'] . "' min='1' max='10' step='0.1'</td>
                    </tr>";
        }
        echo "</table>";
        echo "<div id='uitput'></div>";
        //echo "<input type='submit' value='Pas Aan!' name='submitnaam'>";
        //echo "</form>";
    }
} elseif($_GET['laatpaginaeenzien'] == TRUE) {
    echo "<input type='text' onkeyup='zoekentoets()' id='zoekbalk'>";

    echo "<div id='tabel'>";


//hier komt ook een tabel

    $query = "SELECT DISTINCT(`Naam_Toets`), klassen.KlasNaam FROM `cijfer`, `klassen`, `studenten` WHERE klassen.KlasID = studenten.Klas_ID AND studenten.StudentID = cijfer.Student_ID";

    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) == 0) {
        echo "We hebben niks gevonden";
    } else {
        echo "<table>";
        while ($rij = mysqli_fetch_array($result)) {
            //hier komt dan de rij en zo
            echo "<tr><td>" . $rij['Naam_Toets'] . "</td><td>" . $rij['KlasNaam'] . "</td><td><p><a href=\"javascript:laatpaginatweezien('" . $rij['Naam_Toets'] . "', '" . $rij['KlasNaam'] . "');\">Een link</a></p></td></tr>";
        }
        echo "</table>";
    }

    echo "</div>";
} elseif (isset($_GET['studentid']) && isset($_GET['cijfer'])){
    $cijfer = $_GET['cijfer'];
    if ($cijfer >0 && $cijfer < 11){
        $toetsnaam = $_SESSION['NaamToets'];

        $id = $_GET['studentid'];

        //maak nu de query
        $query = "UPDATE `cijfer` SET `Cijfer`='$cijfer' WHERE `Student_ID` = '$id' AND `Naam_Toets` = '$toetsnaam'";

        //$result = mysqli_query($mysqli, $query);

        if (mysqli_query($mysqli, $query)){
            echo "We hebben het aangepast!";
        } else {
            echo mysqli_error($mysqli);
        }
    } else {
        echo "Het cijfer moet tussen een en de tien zitten!";
    }

}

?>
