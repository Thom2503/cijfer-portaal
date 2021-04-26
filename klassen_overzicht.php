<!DOCTYPE html>
 <html>
 <head>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <script defer src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
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
     require "php/average.php";

     //sql query de where clause hoeft alleen aangepast te worden bij l.leraalID die dan automatisch bij het inloggen te doen.
     // $sql = "SELECT l.LeraarID, l.Voornaam, l.Achternaam, vl.Vak_ID, vl.Leraar_ID, v.VakNaam, v.VakID
     // from leraren as l, vak_leraar as vl, vakken as v WHERE l.LeraarID = 1 AND vl.Leraar_ID = l.LeraarID AND vl.vak_ID = v.VakID ";
     $sql = "SELECT l.Voornaam, l.Achternaam, vl.Leraar_ID, v.VakNaam, vk.KlasID, vk.VakID
     from leraren as l, vak_leraar as vl, vakken as v, vak_klas as vk
     WHERE l.LeraarID = 1 AND vl.Leraar_ID = l.LeraarID AND vl.vak_ID = v.VakID AND vl.vak_ID = vk.VakID  ";


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
       WHERE vk.KlasID = s.Klas_ID AND vk.VakID = ".$rs['VakID']."  AND k.KlasID =".$rs['KlasID'];

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
           <td><?php echo calculateAvg($klasData['StudentID'], $rs['VakID']) ?></td>
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
             <td><?php echo calculateAvgClass($rs['KlasID'], $rs['VakID']) ?></td>
           </tr>
         </tbody>
       </table>
     <button type="button" id="print_to_pdf" name="button">Download cijfers</button>
 </div>
 <?php
}
?>
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
