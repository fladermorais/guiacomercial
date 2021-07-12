$('#categoria').change(function(){
  
  var categoria = $('#categoria').val();
  // console.log(categoria);
  $.get("subcategoria/"+categoria, function(response){
    // console.log(response);
    $('#subcategoria').empty()
    for(i=0; i< response.length; i++){
      $('#subcategoria').append("<option value='"+response[i].id+"'>"+response[i].nome+"</option>")
    }
  })
})

$(document).ready(function(){
  var cat = $('#categoria').val();
  
  $.get("subcategoria/"+cat, function(response){
    // console.log(response);
    var sub = $('#sub_ativa').val();
    $('#subcategoria').empty()
    for(i=0; i< response.length; i++){
      if(response[i].id == sub){
        var status = "selected";
      } else {
        var status = "";
      }
      $('#subcategoria').append("<option " + status + " value='"+response[i].id+"'>"+response[i].nome+"</option>")
    }
  })
})