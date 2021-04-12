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
      console.log("Data is toegevoegd");
    });
  });
});
