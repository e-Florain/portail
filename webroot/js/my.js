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