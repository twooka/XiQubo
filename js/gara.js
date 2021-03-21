$("#btn").on("click", reload);
var countDownDate = new Date().getTime()/1000;
var startDate = new Date().getTime()/1000;
var idgara;



$(document).ready(reload);


function reload() {
  $.ajax({
    url:  "php/jury.be.php",
    type: "GET",
    data: {
            "id": idgara,
            "ordered": 1
          },
    success: function (result) {
      countDownDate =  JSON.parse(result).countDownDate;
      startDate = JSON.parse(result).startDate;
      let ranking_data = JSON.parse(result);
      renderTable(ranking_data);
    }
  });
};


var now = new Date().getTime()/1000;
// Update the count down every 1 second
var x = setInterval(function() {
  now = new Date().getTime()/1000;
  var distance = countDownDate - now;
  if(startDate>now){
    $("#clock").html("La gara non è ancora iniziata");
    return;
  }
  if(distance < 5*60 && now<countDownDate+10){
    reload();
  }
  if (distance < 0) {
    $("#clock").html("La gara è terminata");
    return;
  }
  var hours = Math.floor((distance % ( 60 * 60 * 24)) / ( 60 * 60));
  var minutes = Math.floor((distance % ( 60 * 60)) /  60);
  var seconds = Math.floor((distance % ( 60)));
  $("#clock").html(hours + "h " + minutes + "m " + seconds + "s ");
}, 1000);


//chooses color
function getColor(i){
  if(i==1){
    return "green";
  }else if(i==-1){
    return "red";
  }else{
    return "white";
  }
}


function renderTable(ranking_data){
  $("#nascosto").html("");

  //RETRIEVE DATA
  var jollies = ranking_data.jollies;
  var solved = ranking_data.solved;
  var ranking = ranking_data.ranking;
  var deltabonus = ranking_data.deltabonus;


  //CREATE RANKING TABLE
  let tb = jQuery("<tbody>", {id: "classifica"});
  for (let i=0; i<ranking.length; i++) {
    let row = jQuery("<tr>");
    row.append(jQuery("<th>").text(i+1));
    row.append(jQuery("<th>").text(ranking[i].name));
    row.append(jQuery("<th>").text(ranking[i].scoressum));
    for (let j = 0; j<(ranking[i].scores).length; j++) {
      //CHANGES COLOR DEPENDING ON JOLLY
      row.append(jQuery("<th>", {class: getColor(solved[ranking[i].id][j]).toString() +((jollies[ranking[i].id]==j) ? " jolly":"") }).append(ranking[i].scores[j]));
    }
    tb.append(row);
  }
  $("#classifica").replaceWith(tb);

  //CREATE TABLE HEADER
  let hd = jQuery("<thead>", {id: "testa"});
  let numrow = jQuery("<tr>");
  let pointsrow = jQuery("<tr>");
  for(let i=0; i<3; i++)  numrow.append(jQuery("<td>"));
  for(var i = 0; i<deltabonus.length;i++) numrow.append(jQuery("<th>").text(i+1));
  pointsrow.append(jQuery("<th>").text("n°"));
  pointsrow.append(jQuery("<th>").text("Squadra"));
  pointsrow.append(jQuery("<th>").text("Punti"));
  for (var i =0; i<deltabonus.length; i++) {
    pointsrow.append(jQuery("<th>").text(deltabonus[i]));
  }
  hd.append(numrow);
  hd.append(pointsrow);
  $("#testa").replaceWith(hd);


  //CHECK IF RANKING SHOULD BE HIDDEN
  if(countDownDate-now<5*60 && now<countDownDate){
    $("#nascosto").html("La classifica è nascosta!");
    $("#classifica").html("");
    $("#testa").html("");
    return;
  }
}
