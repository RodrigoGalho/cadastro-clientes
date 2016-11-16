function mascara(o,f){
  v_obj=o
  v_fun=f
  setTimeout("execmascara()",1)
}

function execmascara(){
  v_obj.value=v_fun(v_obj.value)
}

function msoNumeros(v){
  return v.replace(/\D/g,"");
}

function mtelefone(v){
  v=v.replace(/\D/g,"")                 
  v=v.replace(/^(\d\d)(\d)/g,"($1) $2") 
  v=v.replace(/(\d{4})(\d)/,"$1-$2")    
  return v;
}

function mcep(v){
  v=v.replace(/\D/g,"")                    
  v=v.replace(/(\d{5})(\d)/,"$1-$2")       
  return v
}

$(document).ready(function(){
  
  var num = 2;
  $("#add-telefone").click(function() {
    $("#telefones").append('<br><input class="form-control" type="text" name="telefone[]" id="itelefone' + num + '" maxlength="14" onkeypress="mascara(this,mtelefone)">');
  });

  $("#cidade option").hide();

  $("#estado").change(function(){
    $("#cidade option").hide();
    $("#cidade").val('');
    
    if($('this').val() != ""){
      $(".uf-" + $("#estado").val()).show();
    }
  
  });


  $('#search').keyup(function() {
        searchTable($(this).val());
  });
  
});

function searchTable(inputVal) {
var table = $('#searchTable');
table.find('tr').each(function(index, row) {
    var allCells = $(row).find('td');
    if (allCells.length > 0) {
          var found = false;
          allCells.each(function(index, td) {
                var regExp = new RegExp(inputVal, 'i');
                if (regExp.test($(td).text())) {
                      found = true;
                      return false;
                }
          });
          if (found == true)
                $(row).show();
          else
                $(row).hide();
    }
});
}

