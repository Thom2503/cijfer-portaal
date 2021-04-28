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
   <title>Klassen Overzicht</title>
 <script defer src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/homepage.css">
 <style>
 /* body {font-family: Arial;} */

 /* Style the tab */
 .tab {
   overflow: hidden;
   border: 1px solid #ccc;
   background-color: #f1f1f1;
 }

 /* Style the buttons inside the tab */
 .tab button {
   background-color: inherit;
   float: left;
   border: none;
   outline: none;
   cursor: pointer;
   padding: 14px 16px;
   transition: 0.3s;
   font-size: 17px;
 }

 /* Change background color of buttons on hover */
 .tab button:hover {
   background-color: #ddd;
 }

 /* Create an active/current tablink class */
 .tab button.active {
   background-color: #ccc;
 }

 /* Style the tab content */
 .tabcontent {
   display: none;
   padding: 6px 12px;
   border: 1px solid #ccc;
   border-top: none;
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
       <a href="#" class="w3-bar-item w3-button">Cijfer Toevoegen</a>
       <a href="klassen_overzicht.php" class="w3-bar-item w3-button">Overzicht klassen</a>
       <a href="leeraar_toevoeg.php" class="w3-bar-item w3-button">Vak voor leraar</a>
       <a href="vak_toevoegen.php" class="w3-bar-item w3-button">Vak Toevoegen</a>


     </div>
     <div class="middle" style="position: relative; top: 50px; width: 90%; margin-right: -1em;">
       <?php

         require "php/config.inc.php";
         require "php/average.php";

         //sql query de where clause hoeft alleen aangepast te worden bij l.leraalID die dan automatisch bij het inloggen te doen.
         // $sql = "SELECT l.LeraarID, l.Voornaam, l.Achternaam, vl.Vak_ID, vl.Leraar_ID, v.VakNaam, v.VakID
         // from leraren as l, vak_leraar as vl, vakken as v WHERE l.LeraarID = 1 AND vl.Leraar_ID = l.LeraarID AND vl.vak_ID = v.VakID ";
         $sql = "SELECT DISTINCT l.Voornaam, l.Achternaam, vl.Leraar_ID, v.VakNaam, vk.KlasID, vl.vak_ID
         from leraren as l, vak_leraar as vl, vakken as v, vak_klas as vk
         WHERE vl.Vak_ID = v.VakID AND vl.Leraar_ID = l.LeraarID AND l.LeraarID =".$_SESSION['Leraar'];


         $result = mysqli_query($mysqli, $sql);

         if (!$result)
         {
           echo "Error";
         }

         foreach ($result as $rs)
         {
           ?>
           <div class="tab">
             <button class="tablinks" onclick="openTab(event, '<?php echo $rs['VakNaam'] ?>')"><?php echo $rs['VakNaam'] ?></button>
           </div>
           <?php
           $klas = "SELECT DISTINCT s.StudentID, s.StudentUUID, s.Voornaam, s.Achternaam, s.Klas_ID, k.KlasNaam, vk.VakID
           FROM studenten as s, vak_klas as vk, klassen as k
           WHERE vk.KlasID = s.Klas_ID AND vk.VakID = ".$rs['vak_ID']."  AND k.KlasID =".$rs['KlasID'];

           $res = mysqli_query($mysqli, $klas);

      ?>

     <div id="<?php echo $rs['VakNaam'] ?>" class="tabcontent">
       <h2><?php echo $rs['VakNaam'] ?></h2>
       <table border="1">
           <thead>
             <tr>
               <td>Naam</td>
               <td>Achternaam</td>
               <td>Klas</td>
               <td>Cijfer (gemiddeld)</td>
             </tr>
           </thead>
           <tbody>
               <?php
               foreach ($res as $klasData)
               {
                 ?>
              <tr>
               <td><a href="student.php?id=<?php echo $klasData['StudentUUID'] ?>"><?php echo $klasData['Voornaam'] ?></a></td>
               <td><?php echo $klasData['Achternaam'] ?></td>
               <td><?php echo $klasData['KlasNaam'] ?></td>
               <td><?php echo calculateAvg($klasData['StudentID'], $rs['vak_ID']) ?></td>
              </tr>
             <?php } ?>
           </tbody>
         </table>
         <table border="1">
             <thead>
               <tr>
                 <td>Klascijfer (gemiddeld)</td>
               </tr>
             </thead>
             <tbody>
               <tr>
                 <td><?php echo calculateAvgClass($rs['KlasID'], $rs['vak_ID']) ?></td>
               </tr>
             </tbody>
           </table>
         <button type="button" id="print_to_pdf" name="button">Download cijfers</button>
     </div>
     <?php
    }
    ?>
     </div>
 <script>
 function openTab(evt, tabName) {
   var i, tabcontent, tablinks;
   tabcontent = document.getElementsByClassName("tabcontent");
   for (i = 0; i < tabcontent.length; i++) {
     tabcontent[i].style.display = "none";
   }
   tablinks = document.getElementsByClassName("tablinks");
   for (i = 0; i < tablinks.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" active", "");
   }
   document.getElementById(tabName).style.display = "block";
   evt.currentTarget.className += " active";
 }

 document.getElementById('print_to_pdf').onclick = function () {
  var element = document.getElementsByTagName('body')[0]
  html2pdf().from(element).toPdf().save('cijfers.pdf')
}
 </script>

 </body>
 </html>
