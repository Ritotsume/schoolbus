/**
*
*/

$(document).ready(function () {
  $(".sidebar a").on('click', function () {
    //        alert($(this).text());
    //        $(".content-geral").fadeOut();
  });
});

function esconder(ele, local) {
  var keys = $(ele).find('span').attr('dataStr');
  var texto = '';
  //var confirma = window.confirm("Deseja apagar esse registro?");
  bootbox.confirm('Deseja apagar esse registro?', function(resp){
    if(resp){
      $.ajax({
        url: './ajax/model' + local + '.ajax.php',
        data: keys,
        beforeSend: function (xhr) {

        },
        success: function (data) {
          texto = data;
        },
        complete: function(){
          bootbox.alert(texto, function(){
            location.href = "http://localhost/schoolbus/" + local;
          });
        }
      });
    }
  });
}

function atualizarAjax(ele)
{
  var keys = $(ele).find('span').attr('dataStr');
  $.ajax({
    url: './ajax/update.ajax.php',
    data: keys,
    beforeSend: function (xhr) {

    },
    success: function (data) {
      $("#content-data-escola").html(data).fadeIn();
    }
  });
}

function removeI(ele)
{
  var box = $(ele).closest(".tel-div");

  if (box.text() === null) {
    alert('nulo');
  }

  box.fadeOut();
}

function redireciona(ele){
  var hh = $(ele).find('span').attr('dataStr');
  location.href = hh;
}

function progresso(ele, maxvalue){

}

function modals(title, content){
  bootbox.dialog({
    title: title,
    message: content,
    buttons: {
      'Ok': {
        className: 'btn-primary',
        callback: function(){}
      }
    },
    callback: function(){}
  });
}

function addPhone(ele)
{
  var telefone = $(ele).prev('input[name=telefone]').val();
  var novoInput = '<div class="tel-div"><input type="text" name="telefone_numero[]" value="' + telefone + '" readonly="readonly" /><button type="button" class="btn-input-tel" onclick="removeI(this)"><i class="fa fa-minus-circle"></i></button></div>';
  $("#telefones").append(novoInput).fadeIn();
}

function toggleTheme()
{
  if($('body').hasClass('theme') && localStorage.getItem('theme') === "dark"){
    localStorage.clear();
    localStorage.setItem("theme", "light");
    location.reload();
  }else{
    localStorage.clear();
    localStorage.setItem("theme", "dark");
    location.reload();
  }
}
