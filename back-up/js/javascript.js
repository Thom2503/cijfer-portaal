function InitAJAX()
{
    var objxml;
    var IEtypes = ["Msxml2.XMLHTTP.6.0", "Msxml2.XMLHTTP.3.0", "Microsoft.XMLHTTP"];

    try
    {
        // Probeer het eerst op de "moderne" standaardmanier
        objxml = new XMLHttpRequest();
    }
    catch (e)
    {
        // De standaardmanier werkte niet, probeer oude IE manieren
        for (var i = 0; i < IEtypes.length; i++)
        {
            try
            {
                objxml = new ActiveXObject(IEtypes[i]);
            }
            catch (e)
            {
                continue;
            }
        }
    }

    // Lever het XHR object op
    return objxml;
}

function laatklaszien()
//Je hebt de naam van de toets ingevuld, nu laten we de klas zien
{
    // Maak een XHR object
    var xmlHttp = InitAJAX();

    var naamtoets = document.getElementById("naamtoets").value;

    //URL Maken
    var url = 'php/toevoegen.php?naamtoets=' +  naamtoets;

    // Wat moet er gebeuren bij statuswijzigingen?
    xmlHttp.onreadystatechange = function ()
    {
        // Is het request al helemaal klaar en OK?
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            // Lees de tekst die is ontvangen
            var result = xmlHttp.responseText;

            // Plaats de tekst in de pagina
            document.getElementById("klas").innerHTML = result;
        }
    }

    // Verstuur het request
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function laatvakzien()
//Je hebt de klas ingevuld, nu laten we het vak zien
{
    // Maak een XHR object
    var xmlHttp = InitAJAX();

    var naamklas = document.getElementById("klassen").value;

    //URL Maken
    var url = 'php/toevoegen.php?naamklas=' +  naamklas;

    // Wat moet er gebeuren bij statuswijzigingen?
    xmlHttp.onreadystatechange = function ()
    {
        // Is het request al helemaal klaar en OK?
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            // Lees de tekst die is ontvangen
            var result = xmlHttp.responseText;

            // Plaats de tekst in de pagina
            document.getElementById("vak").innerHTML = result;
        }
    }

    // Verstuur het request
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function laatperiodezien()
//Je hebt de klas ingevuld, nu laten we het vak zien
{
    // Maak een XHR object
    var xmlHttp = InitAJAX();

    var periode = document.getElementById("vakken").value;

    //URL Maken
    var url = 'php/toevoegen.php?periode=' +  periode;

    // Wat moet er gebeuren bij statuswijzigingen?
    xmlHttp.onreadystatechange = function ()
    {
        // Is het request al helemaal klaar en OK?
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            // Lees de tekst die is ontvangen
            var result = xmlHttp.responseText;

            // Plaats de tekst in de pagina
            document.getElementById("periode").innerHTML = result;
        }
    }

    // Verstuur het request
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function laatcijferszien()
//Je hebt de klas ingevuld, nu laten we het vak zien
{
    // Maak een XHR object
    var xmlHttp = InitAJAX();

    var vakken = document.getElementById("vakken").value;

    //URL Maken
    var url = 'php/toevoegen.php?cijfers=' +  vakken;

    // Wat moet er gebeuren bij statuswijzigingen?
    xmlHttp.onreadystatechange = function ()
    {
        // Is het request al helemaal klaar en OK?
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            // Lees de tekst die is ontvangen
            var result = xmlHttp.responseText;

            // Plaats de tekst in de pagina
            document.getElementById("cijfers").innerHTML = result;
        }
    }

    // Verstuur het request
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

/*

   _______   _ ____             ______
  / ____(_) (_) __/__  _____   /_  __/___  ___ _   ______  ___  ____ ____  ____
 / /   / / / / /_/ _ \/ ___/    / / / __ \/ _ \ | / / __ \/ _ \/ __ `/ _ \/ __ \
/ /___/ / / / __/  __/ /       / / / /_/ /  __/ |/ / /_/ /  __/ /_/ /  __/ / / /
\____/_/_/ /_/  \___/_/       /_/  \____/\___/|___/\____/\___/\__, /\___/_/ /_/
      /___/                                                  /____/

 */
/*
function cijferstoevoegen()
//Je hebt de klas ingevuld, nu laten we het vak zien
{
    // Maak een XHR object
    var xmlHttp = InitAJAX();

    //URL Maken
    var url = "cijferstoevoegen.php";

    // Wat moet er gebeuren bij statuswijzigingen?
    xmlHttp.onreadystatechange = function ()
    {
        // Is het request al helemaal klaar en OK?
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            // Lees de tekst die is ontvangen
            var result = xmlHttp.responseText;

            // Plaats de tekst in de pagina
            document.getElementById("resultaat").innerHTML = result;
        }
    }

    // Verstuur het request
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}
*/
