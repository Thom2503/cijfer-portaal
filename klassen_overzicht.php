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

     // $sql = "SELECT v.VakNaam, v.VakID, l.LeraarID, l.Voornaam, l.Achternaam, vk.VakID, vk.KlasID, vl.Vak_ID, vl.Leraar_ID
     // from vakken as v, leraren as l, vak_klas as vk, vak_leraar as vl WHERE l.LeraarID = 1 AND vl.Leraar_ID = 1  ";

     $sql = "SELECT l.LeraarID, l.Voornaam, l.Achternaam, vl.Vak_ID, vl.Leraar_ID, v.VakNaam, v.VakID
     from leraren as l, vak_leraar as vl, vakken as v WHERE l.LeraarID = 1 AND vl.Leraar_ID = l.LeraarID AND vl.vak_ID = v.VakID ";

     $result = mysqli_query($mysqli, $sql);

     foreach ($result as $rs)
     {
  ?>

 <div class="tab">
   <button class="tablinks" onclick="openCity(event, '<?php echo $rs['VakNaam'] ?>')"><?php echo $rs['VakNaam'] ?></button>
 </div>

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
         <tr>
         </tr>
         <tr>
         </tr>
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
