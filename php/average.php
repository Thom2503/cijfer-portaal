<?php
  function calculateAvg($id, $vakId) //$id is die van de student en $vakId spreekt voor zich
  {
    require "config.inc.php";

    $query = "SELECT * FROM cijfer WHERE Student_ID = ".$id." AND Vak_ID = ".$vakId." ";//<= DEZE QUERY WERKT NIET

    //pak alle cijfers van de studenten die in een klas zitten en voor een speciaal vak
    //als je het gemiddelde voor een speciale toets wilt, moeten we iets aanpassen in de database

    $result = mysqli_query($mysqli, $query);

    //om een gemiddelde uit te rekenen, moeten we het totale delen door de "hoeveelheid"

    $totaalcijfer = 0; //<= dit is het totale

    $delen = 0; //<= dit is de "hoeveelheid"

    foreach ($result as $rij)
    {//loopen door gegevens
        $totaalcijfer += $rij['Cijfer'];//doe het cijfer bij het totale

        $delen += 1;//Hoevaak hebben we er iets bij gedaan? Dat houden we hier bij (dit is de "hoeveelheid")
    }

    $uitkomst = $totaalcijfer / $delen; //MaTh!!

    return $uitkomst; //laat het zien
  }

  function calculateAvgClass($id, $vakId) //$id is die van de student en $vakId spreekt voor zich
  {
    require "config.inc.php";

    $query = "SELECT DISTINCT cijfer FROM cijfer, studenten WHERE klas_ID = ".$id." AND Vak_ID = ".$vakId." ";//<= DEZE QUERY WERKT NIET

    //pak alle cijfers van de studenten die in een klas zitten en voor een speciaal vak
    //als je het gemiddelde voor een speciale toets wilt, moeten we iets aanpassen in de database

    $result = mysqli_query($mysqli, $query);

    //om een gemiddelde uit te rekenen, moeten we het totale delen door de "hoeveelheid"

    $totaalcijfer = 0; //<= dit is het totale

    $delen = 0; //<= dit is de "hoeveelheid"

    foreach ($result as $rij)
    {//loopen door gegevens
        $totaalcijfer += $rij['cijfer'];//doe het cijfer bij het totale

        $delen += 1;//Hoevaak hebben we er iets bij gedaan? Dat houden we hier bij (dit is de "hoeveelheid")
    }

    $uitkomst = $totaalcijfer / $delen; //MaTh!!

    return $uitkomst; //laat het zien
  }

 ?>
