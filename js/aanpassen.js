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

function zoekentoets()
{
    // Maak een XHR object
    var xmlHttp = InitAJAX();

    document.getElementById('tabel').innerHTML = "";

    // Lees de inhoud van het formulierveld
    var zoektekst = document.getElementById('zoekbalk').value;

    // Maak de URL voor het AJAX request
    var url = 'php/aanpassen_verwerk.php?zoektekst=' + zoektekst;

    // Wat moet er gebeuren bij statuswijzigingen?
    xmlHttp.onreadystatechange = function ()
    {
        // Is het request al helemaal klaar en OK?
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            // Lees de tekst die is ontvangen
            var result = xmlHttp.responseText;

            // Plaats de tekst in de pagina
            document.getElementById("tabel").innerHTML = result;
        }
    };

    // Verstuur het request
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function Laatpaginaeenzien()
{
    // Maak een XHR object
    var xmlHttp = InitAJAX();

    // Lees de inhoud van het formulierveld
    //var zoektekst = document.getElementById('zoekbalk').value;

    document.getElementById("resultaat").innerHTML = "";

    // Maak de URL voor het AJAX request
    var url = '../laatzien.php?laatpaginaeenzien=TRUE';

    // Wat moet er gebeuren bij statuswijzigingen?
    xmlHttp.onreadystatechange = function ()
    {
        // Is het request al helemaal klaar en OK?
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            // Lees de tekst die is ontvangen
            var result = xmlHttp.responseText;

            // Plaats de tekst in de pagina
            document.getElementById("paginaeen").innerHTML = result;
        }
    };

    // Verstuur het request
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function laatpaginatweezien(toetsnaam, klasnaam){
    // Maak een XHR object
    var xmlHttp = InitAJAX();

    // Lees de inhoud van het formulierveld
    //var zoektekst = document.getElementById('zoekbalk').value;

    document.getElementById("paginaeen").innerHTML = "";

    // Maak de URL voor het AJAX request
    var url = '../laatzien.php?toetsnaam=' + toetsnaam + '&klasnaam=' + klasnaam;

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
    };

    // Verstuur het request
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function updatecijfer(studentid){
    // Maak een XHR object
    var xmlHttp = InitAJAX();

    // Lees de inhoud van het formulierveld
    //var zoektekst = document.getElementById(studentid).value;

    var cijfer = document.getElementById(studentid).value;

    // Maak de URL voor het AJAX request
    //var url = 'laatzien.php?toetsnaam=' + toetsnaam + '&klasnaam=' + klasnaam;
    var url = '../laatzien.php?studentid=' + studentid + '&cijfer=' + cijfer;

    // Wat moet er gebeuren bij statuswijzigingen?
    xmlHttp.onreadystatechange = function ()
    {
        // Is het request al helemaal klaar en OK?
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            // Lees de tekst die is ontvangen
            var result = xmlHttp.responseText;

            // Plaats de tekst in de pagina
            document.getElementById("uitput").innerHTML = result;
        }
    };

    // Verstuur het request
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}
