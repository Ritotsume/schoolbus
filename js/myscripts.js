/**
*
*/

$(document).ready(function () {

  $('.datatable').DataTable({
    "language": {
      "url": "./lib/js/dt-table-pt-br.json"
    },
    dom: 'Bfrtip',
    buttons:[
      {
        extend: 'print',
        text: 'Imprimir',
        exportOptions: {
          columns: ':not(:last-child)'
        }
      }
    ]
  });

  $('button[data-cadastrar]').on('click', function(){
    var local = $(this).attr('data-cadastrar');
    var inputs = $('input');
    var selects = $('select');
    var data_dt = {};
    var indice = null;
    var valor = null;
    var msgboot = null;
    var msg_data = null;
    $(inputs).each(function(index, el) {
      indice = $(this).attr('name');
      valor = $(this).val();
      data_dt[indice] = valor;
    });

    $(selects).each(function(index, el) {
      indice = $(this).attr('name');
      valor = $(this).val();
      data_dt[indice] = valor;
    });

    data_dt = JSON.stringify(data_dt);
    var data_dois = {json:data_dt};

    $.ajax({
      url: '../ajax/model'+ local +'.ajax.php',
      data: data_dois,
      type: 'POST',
      beforeSend: function(){
        msgboot = bootbox.dialog({
          title: '',
          message: '<span><i class="fa fa-spin fa-fulse"></i> Gravando informações...</span>'
        });
      },
      success: function(data){
        msgboot.modal('hide');
        msg_data = data;
      },
      complete: function(st){
        bootbox.alert({
          message: msg_data,
          callback: function(ex){
            bootbox.hideAll();
            location.href = location.origin + '/schoolbus/' + local;
          }
        });
      },
      error: function(err){
        bootbox.alert('erro: ');
      }
    });
  });
});

var deleteReg = function() {
  jQuery('.delete-reg').on('click', function(){
    var keys = $(this).attr('dataStr');
    var local = $(this).attr('data-local');
    var texto = '';
    bootbox.confirm('Deseja alterar esse registro?', function(resp){
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
  });
}
deleteReg();

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

$('#btn-telefone-add').on('click', function(){
  console.log($(this).attr('data-phone'));
});

// function addPhone(ele)
// {
//   var telefone = $(ele).prev('input[name=telefone]').val();
//   var novoInput = '<div class="tel-div"><input type="text" name="telefone_numero[]" value="' + telefone + '" readonly="readonly" /><button type="button" class="btn-input-tel" onclick="removeI(this)"><i class="fa fa-minus-circle"></i></button></div>';
//   // $("#telefones").append(novoInput).fadeIn();
//
// }

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

var fecharItem = function()
{
  $('.fecha-item').on('click', function(){
    $(this).closest('li').fadeOut();
    $(this).closest('li').find('input').remove();
  });
}

var appendLogradouros = function()
{
  $('.add-logradouros').on('click', function(){
    var selectText = $('#tb_logradouros_logradouro_id > option:selected').text();
    var selectValue = $('#tb_logradouros_logradouro_id > option:selected').val();
    // var selectValue = $('#tb_logradouros_logradouro_id').val();
    var textareaValue = $('#ref').val();

    $('#list-group-logradouros > #list-rota').append('<li class="list-group-item list-group-item-success"><span class="badge fecha-item">remover</span><h4 class="list-group-item-heading"><i class="fa fa-map-signs"></i> '+ selectText +'</h4>'+
    '<p class="list-group-item-text">'+ textareaValue +'</p>'+
    '<input type="hidden" name="caminhos[]" value="'+ selectValue +'" />'+
    '<input type="hidden" name="observacoes[]" value="'+ textareaValue +'" /></li>');
    fecharItem();
  });

  $('.add-escolas').on('click', function(){
    var selectText = $('#escolas > option:selected').text();
    var selectValue = $('#escolas > option:selected').val();

    $('#list-group-logradouros > #list-escolas').append('<li class="list-group-item list-group-item-warning"><span class="badge fecha-item">remover</span><h4 class="list-group-item-heading"><i class="fa fa-institution"></i> '+ selectText +'</h4>'+
    '<input type="hidden" name="escolas[]" value="'+ selectValue +'" /></li>');
    fecharItem();
  });
}
fecharItem();
appendLogradouros();

var printForm = function(){
  $('.print-form').on('click', function(){
    var form = $('form').find('div');

    tela_impressao = window.open('about:blank');

    tela_impressao.document.write(form);
    tela_impressao.window.print();
    tela_impressao.window.close();
  });
}
printForm();
