document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    var options;
    var instances = M.Datepicker.init(elems, options);
    
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.datepicker').datepicker(
      {'format': 'yyyy-mm-dd'}
    );
  });

  $(document).ready(function(){
    $('select').formSelect();
  });

  $(document).ready(function(){
    $('.tooltipped').tooltip();
  });

  $(".dropdown-trigger").dropdown();

  $(document).ready(function(){
    $('.modal').modal();
  });
  
  $(document).ready(function(){
    /*ajax: {
      url: '/associations/search',
      dataType: 'json'

    }*/
    $.getJSON( "/associations/search", function( data ) {
      var obj = {};
      for(var i in data)
      {
        for (var x in data[i]) {
          if (x == "name") {
            obj[data[i][x]] = null;
          }
        }
      }
      auto(obj)
      });
  });

function auto(data_arr){
  $("#asso").autocomplete({
      data: data_arr,
      minLength: 1
  });
}

function filter(controller) {
  var reg = /\/trash\:(\w+)/;
  var resultat = reg.test(window.location.href);
  var url = "/"+controller+"/index_ajax/";
  if (resultat) {
    var trasharg = RegExp.$1;
    url = url+"trash:"+trasharg; 
  } else {
    url = url+"trash:false"; 
  }
  var str = $("#filter_"+controller+"_text").val();
  url = url+"/str:"+str;

  url=url+"/years:";
  $('.check'+controller+'Years').each(function(i, obj) {
    if (this.checked) {
      url=url+this.name+";";
    }
  });
  //console.log(url);

  $.get(url)
    .done(function( data ) {
      //console.log( "Data Loaded: " + data );
      var reg = /(Adhérents[ pros]*);(true|false);(\d+);(.*)/s;
      //console.log(data)
      var resultat = reg.test(data);
      console.log(resultat);
      var strhtml = "";
      if (RegExp.$2 == "false") {
        strhtml = RegExp.$1+" ("+RegExp.$3+")";
      }
      if (RegExp.$2 == "true") {
        strhtml = RegExp.$1+" effacés ("+RegExp.$3+")";
      }
      var strhtml2=RegExp.$4;
      //console.log(strhtml2);
      $("#nbadhs").html(strhtml);
      $("#results").html(strhtml2);
      //window.location.href = "index.php";
  });
}


$("#filter_Adhs_text").keyup(function() {
  filter("Adhs");
});

$('.checkAdhsYears:checkbox').on('change', function() {
  filter("Adhs");
});

$("#filter_Adhpros_text").keyup(function() {
  filter("Adhpros");
});

$('.checkAdhprosYears:checkbox').on('change', function() {
  filter("Adhpros");
});