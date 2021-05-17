<?php

session_start();

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
<html>
    <head>
        <script defer src="js/javascript.js"></script>
    </head>

    <body>
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
