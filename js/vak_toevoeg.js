$(document).ready(function() {
  $("#submit").click(function() {
    var vak = $("#vakNaam").val();
    var leerlijn = $("#leerlijnen").val();

    console.log(leraar);
    console.log(vak);

    $.ajax({
      url: "/php/vak_toevoeg_verwerk.php",
      method: "POST",
      data: {
        'vak': vak,
        'leelijn': leerlijn
      }
    }).done(function(data) {
      console.log("Data is toegevoegd");
    });
  });
});
