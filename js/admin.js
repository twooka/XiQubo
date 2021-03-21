

$("#create").on("click", create);
$("#fetch").on("click", fetch);
$("#update").on("click", update);


function fetch(){
  var id = Number($("#id").value);

  $.ajax({
    url:  "php/fetch.be.php",
    type: "GET",
    data: {
            "idgara": idgara
          },
    success: function (result) {
      let data = JSON.parse(request.responseText);
      $("#nome").val(data.nome);
      $("#numsq").val(data.numsq);
      $("#squadre").val(data.squadre);
      $("#numprob").val(data.numprob);
      $("#problemi").val(data.problemi);
      $("#orario").val(data.orario);
      $("#durata").val(data.durata);
    }
  });

};

function update(){
   $.ajax({
     url:     "php/update.be.php",
     method:  "POST",
     data:    {
                 id:        Number($("#id").val()),
                 nome:      $("#nome").val(),
                 numsq:     $("#numsq").val(),
                 squadre:   $("#squadre").val(),
                 numprob:   $("#numprob").val(),
                 problemi:  $("#problemi").val(),
                 orario:    $("#orario").val(),
                 durata:    $("#durata").val()
               }
     });
};
