<?php

$mysqli = "";

require "config.inc.php";

session_start();
//=====================================================================================================
if (isset($_GET['naamtoets'])){
    //Als je de naam invult, laat dan de klas zien

    //sla de toetsnaam op
    $naamtoets = $_GET['naamtoets'];

    //echo "We slaan nu " . $naamtoets . " op als /$/_SESSION[/'naamtoets/']!<br>";

    $_SESSION['naamtoets'] = $naamtoets;
    //einde sla toetsnaam op

    //echo "Nu gaan we de klassen opvragen!<br>";

    //nu moet je je klas selecteren
    $query = "SELECT * FROM `klassen`";

    $resultaat = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($resultaat) == 0){
        echo "Er zijn geen klassen!";
    } else {
        echo "<select id='klassen' onchange='laatvakzien(); wipeperiode()'>";
        echo "<option>Kies een klas!</option>";
        while ($rij = mysqli_fetch_array($resultaat)){
            echo "<option value='" . $rij['KlasNaam'] . "'>" . $rij['KlasNaam'] . "</option>";
        }
        echo "</select>";
    }
    //Dit triggert dit VV
}
//=====================================================================================================
if (isset($_GET['naamklas'])){
    //als je de klas invult, laat dan het vak zien

    //sla de klasnaam op
    $naamklas = $_GET['naamklas'];

    //echo "We slaan nu " . $naamklas . " op als /$/_SESSION[/'naamklas/']!<br>";

    $_SESSION['naamklas'] = $naamklas;

    //einde klasnamen opslaan
    //nu moeten we de periode selecteren

    //echo "Nu gaan we de vakken laten zien!<br>";

    $query = "SELECT * FROM `vakken`";

    $resultaat = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($resultaat) == 0){
        echo "Er zijn geen vakken!";
    } else {
        //hier moeten de vakken komen
        //echo "<select id='vakken' onchange='laatperiodezien(); wipecijfers()'>";
        echo "<select id='vakken' onchange='laatcijferszien(); wipecijfers()'>";
        echo "<option>Kies een vak</option>";
        while ($rij = mysqli_fetch_array($resultaat)){
            echo "<option value='" . $rij['VakID'] . "'>" . $rij['VakNaam'] . "</option>";
        }
        echo "</select>";
    }
    //Dit triggert dit VV
}
//=====================================================================================================
if (isset($_GET['periode'])){
    //als je het vak hebt ingevuld, laat dan de periode zien
    //sla de vak op
    $vak = $_GET['periode'];

    //echo "We slaan nu " . $vak . " op als /$/_SESSION[/'vak/']!<br>";

    $_SESSION['vak'] = $vak;
    //einde vak opslaan

    //echo "Nu laten we de periode zien!<br>";

    echo "<select name='periode' id='selecteerperiode' onchange='laatcijferszien()'>";
    echo "<option>Selecteer een periode</option>";
    for ($i = 1; $i <= 4; $i++){
        echo "<option value='" . $i . "' >Periode " . $i . "</option>";
    }
    echo "</select>";
}
//=====================================================================================================
if (isset($_GET['cijfers'])){
    //sla de periode op
    $periode = $_GET['cijfers'];

    //echo "We slaan nu " . $periode . " op als /$/_SESSION[/'periode/']!<br>";

    $_SESSION['vak'] = $periode;
    //einde periode opslaan

    $naamtoets = $_SESSION['naamtoets'];
    $klas = $_SESSION['naamklas'];
    $vak = $_SESSION['vak'];
    $periode = $_SESSION['periode'];

    $query = "SELECT * FROM `studenten`, `klassen` WHERE studenten.Klas_ID = klassen.KlasID AND klassen.KlasNaam = '$klas'";

    $resultaat = mysqli_query($mysqli, $query);

    //echo $query;

    if (mysqli_num_rows($resultaat) < 1){
        echo "Er zitten geen studenten in deze klas.";
    } else {
        //<form action='cijferstoevoegen.php' method='post'>
        echo "<form action='' method='post'>
                <table>
                <tr>
                    <th colspan='2'>Naam</th>
                    <th>Cijfer</th>
                </tr>";
        while ($rij = mysqli_fetch_array($resultaat)){
            echo "<tr>";
            echo "<td>" . $rij['Voornaam'] . " </td>";
            echo "<td>" . $rij['Achternaam'] . "</td>";
            echo "<td><input type='number' name='" . $rij['StudentID'] . "' min='1' max='10' step='0.1' value='6'></td>";
            echo "</tr>";
        }

        echo "<input type='submit' name='submitknop'>Voeg toe!</input></form>";
        //echo "<button onclick='cijferstoevoegen()'>Voeg toe!</button>";
        echo "</table></form>";

        $_SESSION['uitvoeren'] = false;
    }
}

?>
