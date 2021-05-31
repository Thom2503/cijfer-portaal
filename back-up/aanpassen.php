<?php

//hier moet een zoekbalk komen

//hier moet een tabel komen met al de cijfers
//als je er op klikt, moet de div leeggemaakt worden en moeten de cijfers te zien zijn.

//als je op de toetsnaam klikt, moet je de div "vervangen" met de tabel van de studenten en de cijfers die je kan aanpassen

?>
<!-- <html>
<head>
    <title>Aanpassen</title>
    <style>

    </style>
    <script src="aanpassen.js"></script>
</head>
<body>

<div id="resultaat">
    <a href="javascript:eenfunctie();">test</a>-->
    <!-- <p>Dit is een easter egg!</p>
</div>

<div id="paginaeen">
    <script>
        (function (){
            Laatpaginaeenzien();
        })();
    </script>
</div>


</body>
</html> -->

<?php
session_start();

if($_SESSION['Leraar'] < 0)
{
  header("location: index.php");
}
 ?>
<!DOCTYPE html>
 <html>
 <head>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Aanpassen</title>
 <script defer src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <script src="js/aanpassen.js"></script>
<link rel="stylesheet" href="css/homepage.css">
 <style>
 .middle{
   text-align: center;
   margin:0 auto;
   height: 200px;
   width: 100px;
   padding-top: 15%;
 }
 table {
   width: 22em;
   margin-left: -2.2em;
 }
 #toetsnaam {
   width: 20em;
 }
 </style>
 </head>
 <body>
   <nav class="navbar navbar-light bg-light navbar-fixed-top" role="navigation" id="navbar_top">
       <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="#">Cijferportaal</a>
       </div>
       <div class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-left">

         </ul>
         <ul class="nav navbar-nav navbar-right">
           <li><a href="#"><?php echo $_SESSION['Voornaam']." ".$_SESSION['Achternaam'] ?></a></li>
           <li><a href="loguit.php">Logout</a></li>
         </ul>
       </div>
     </nav>

     <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:10%">
       <h3 class="w3-bar-item"></h3>
       <a href="cijfer_toevoegen.php" class="w3-bar-item w3-button">Cijfer Toevoegen</a>
       <a href="aanpassen.php" class="w3-bar-item w3-button">Cijfer Aanpassen</a>
       <a href="klassen_overzicht.php" class="w3-bar-item w3-button">Overzicht klassen</a>
       <a href="leeraar_toevoeg.php" class="w3-bar-item w3-button">Vak voor leraar</a>
       <a href="vak_toevoegen.php" class="w3-bar-item w3-button">Vak Toevoegen</a>


     </div>
     <div class="middle">
       <div id="resultaat">
           <!--<a href="javascript:eenfunctie();">test</a>-->
           <p>Dit is een easter egg!</p>
       </div>

       <div id="paginaeen">
           <script>
               (function (){
                   Laatpaginaeenzien();
               })();
           </script>
       </div>
     </div>

 </body>
 </html>
