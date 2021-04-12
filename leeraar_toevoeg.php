<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="js/leeraar_toevoeg.js" charset="utf-8"></script>
  </head>
  <body>
    <form action="php/leeraar_toevoegen_verwerk.php" method="post">
      <select name="leraren" id="leraar">
          <?php
            require "php/config.inc.php";

            $sql = "SELECT * FROM leraren";

            $result = mysqli_query($mysqli, $sql);

            foreach($result as $rs)
            {
              echo "<option value='".$rs['LeraarID']."'>".$rs['Voornaam']." ".$rs['Achternaam']."</option>";
            }
           ?>
      </select><br><br>
      <select name="vakken" id="vak">
          <?php
            require "php/config.inc.php";

            $sql = "SELECT * FROM vakken";

            $result = mysqli_query($mysqli, $sql);

            foreach($result as $rs)
            {
              echo "<option value='".$rs['VakID']."'>".$rs['VakNaam']."</option>";
            }
           ?>
      </select><br><br>
      <input type="submit" name="submit" id="submit" value="Leraar aan vak toevoegen">
    </form>
    <div id="result">

    </div>
  </body>
</html>
