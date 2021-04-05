<!DOCTYPE html>
 <html>
 <head>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <style>
 body {font-family: Arial;}

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
   <?php
     session_start();

     require "php/config.inc.php";

     //sql query de where clause hoeft alleen aangepast te worden bij l.leraalID die dan automatisch bij het inloggen te doen.
     // $sql = "SELECT l.LeraarID, l.Voornaam, l.Achternaam, vl.Vak_ID, vl.Leraar_ID, v.VakNaam, v.VakID
     // from leraren as l, vak_leraar as vl, vakken as v WHERE l.LeraarID = 1 AND vl.Leraar_ID = l.LeraarID AND vl.vak_ID = v.VakID ";
     $sql = "SELECT l.LeraarID, l.Voornaam, l.Achternaam, vl.Vak_ID, vl.Leraar_ID, v.VakNaam, v.VakID, vk.KlasID, vk.VakID
     from leraren as l, vak_leraar as vl, vakken as v, vak_klas as vk
     WHERE l.LeraarID = 1 AND vl.Leraar_ID = l.LeraarID AND vl.vak_ID = v.VakID AND vl.vak_ID = vk.VakID ";


     $result = mysqli_query($mysqli, $sql);

     foreach ($result as $rs)
     {
       ?>
       <div class="tab">
         <button class="tablinks" onclick="openCity(event, '<?php echo $rs['VakNaam'] ?>')"><?php echo $rs['VakNaam'] ?></button>
       </div>
       <?php
       $klas = "SELECT DISTINCT s.StudentID, s.Voornaam, s.Achternaam, s.Klas_ID, vk.KlasID
       FROM studenten as s, vak_klas as vk WHERE s.Klas_ID = ".$rs['VakID']." AND vk.KlasID = s.Klas_ID ";

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
           <td>Cijfer</td>
         </tr>
       </thead>
       <tbody>
           <?php
           foreach ($res as $klasData)
           { ?>
          <tr>
           <td><?php echo $klasData['Voornaam'] ?></td>
           <td><?php echo $klasData['Achternaam'] ?></td>
           <td><?php echo $klasData['KlasID'] ?></td>
           <td>6.8</td>
          </tr>
         <?php } ?>
       </tbody>
     </table>
 </div>
 <?php
}
?>
 <script>
 function openCity(evt, cityName) {
   var i, tabcontent, tablinks;
   tabcontent = document.getElementsByClassName("tabcontent");
   for (i = 0; i < tabcontent.length; i++) {
     tabcontent[i].style.display = "none";
   }
   tablinks = document.getElementsByClassName("tablinks");
   for (i = 0; i < tablinks.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" active", "");
   }
   document.getElementById(cityName).style.display = "block";
   evt.currentTarget.className += " active";
 }
 </script>

 </body>
 </html>
