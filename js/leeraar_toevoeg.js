$(document).ready(fucntion() {
  $("#submit").click(function() {
    var leraar = $("#leraar").val();
    var vak = $("#vak").val();

    $.ajax({
      url: "../php/leeraar_toevoeg_verwerk.php",
      method: "POST",
      data: {
        'leraar': leraar,
        'val': vak
      }
    }).done(function(data) {
      if (data == "OK") {
        window.location.href = "../klassen_overzicht.php";
      } else {
        window.location.href = "../klassen_overzicht.php?fout=Er is iets fout gegaan";
      }
    }).fail(function() {
      window.alert("Er is iets fout gegaan met het verbinden met AJAX");
    });
  });
});
