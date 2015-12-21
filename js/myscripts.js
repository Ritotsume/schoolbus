/**
*
*/

$(document).ready(function () {
  $(".sidebar a").on('click', function () {
    //        alert($(this).text());
    //        $(".content-geral").fadeOut();
  });

  //$(".button-i").on('click', function (e) {
    //e.stopPropagation();
    //e.defaultPrevented();
    //var telefone = $("input[name=telefone]").val();
    //var novoInput = '<div class="label-input tel-div"><input type="text" name="telefone_numero[]" value="' + telefone + '" readonly="readonly" /><i class="fa fa-minus-circle text-theme" onclick="removeI(this)"></i></div>';
    //$("#telefones").append(novoInput).fadeIn();
  //});


  /* LISTENER DA MODAL PARA O BOTAO - INFOR */
  var modal = $('#modal-infor');
  var botao = $('#modal-infor').find(".bt-modal");
  console.log(modal);
  console.log(botao);
  document.getElementsByClassName('bt-modal')[0].addEventListener('click', function(){
    console.log(true);
  });
});

function esconder(ele, local) {
  var keys = $(ele).find('span').attr('dataStr');

  var confirma = window.confirm("Deseja apagar esse registro?");

  if(confirma){
    $.ajax({
      url: './ajax/model' + local + '.ajax.php',
      data: keys,
      beforeSend: function (xhr) {

      },
      success: function (data) {
        alert("Registro deletado com sucesso!!!");
        location.href = "http://localhost/schoolbus/" + local;
        //            $("#msg-escola").html(data).fadeIn();
        //            console.log(data);
      }
    });
  }
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

function modals(tipo){
  var modal = $(tipo);
  var botao = $(tipo).find(".bt-modal");
  console.log(modal);
  console.log(botao);



  modal.fadeIn();
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
