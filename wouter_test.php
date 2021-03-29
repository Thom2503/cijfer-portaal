<?php

$query = "SELECT * FROM cijfer WHERE student.klas = <iets> AND VAK = <iets>";//<= DEZE QUERY WERKT NIET

//pak alle cijfers van de studenten die in een klas zitten en voor een speciaal vak
//als je het gemiddelde voor een speciale toets wilt, moeten we iets aanpassen in de database

//om een gemiddelde uit te rekenen, moeten we het totale delen door de "hoeveelheid"

$totaalcijfer = 0; //<= dit is het totale

$delen = 0; //<= dit is de "hoeveelheid"

while(iets){//loopen door gegevens
    $totaalcijfer =+ $rij['cijfer'];//doe het cijfer bij het totale

    $delen =+ 1;//Hoevaak hebben we er iets bij gedaan? Dat houden we hier bij (dit is de "hoeveelheid")
}

$uitkomst = $totaalcijfer/$delen; //MaTh!!

echo "$uitkomst is het gemiddelde!"; //laat het zien

?>
