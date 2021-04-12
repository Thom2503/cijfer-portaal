$(document).ready(function() {
  $("#submit").click(function() {
    var leraar = $("#leraar").val();
    var vak = $("#vak").val();

    console.log(leraar);
    console.log(vak);

    $.ajax({
      url: "/php/leeraar_toevoeg_verwerk.php",
      method: "POST",
      data: {
        'leraar': leraar,
        'val': vak
      }
    }).done(function(data) {
      if (data == "OK") {
        $("#result").text("Het is goed gegaan");
      } else {
        $("#result").text("Er is iets fout gegaan tijdens het toevoegen!");
      }
    }).fail(function() {
      alert("Er is iets fout gegaan met het verbinden met AJAX");
    });
  });
});
