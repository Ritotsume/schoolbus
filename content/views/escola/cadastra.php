<?php
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($dados) && !empty($dados)):
  if (isset($dados['cadastrar'])):
    //$telefones['telefone_numero'] = $dados['telefone_numero'];
    unset($dados['search_form'], $dados['cadastrar'], $dados['telefone'], $dados['telefone_numero']);
    $cadescola = new ModelInstituicao();
    $xpg = 1;
    $cadescola->ModelCreator($dados);
    if ($cadescola->getRowCount()):
      //if($xpg):
      ?>
      <script type="text/javascript">
      bootbox.alert('Escola cadastrada com sucesso!!', function(ex){
        location.href = "<?= HOME; ?>escola";
      });
      </script>
      <?php
      //fazer loop dos telefones
      // $telefones['telefone_tipo'] = 'fixo';
      // $telefones['tb_instiuicoes_instituicao_id'] = $cadescola->getLastId();
      // foreach ($telefones['telefone_numero'] as $telefone):
      //   $insert = new Create();
      //   //$insert->Inserter('tb_telefones_instituicao', $telefone);
      // var_dump($telefones, $telefone);
      // endforeach;
    else:
      ?>
      <script type="text/javascript">
      bootbox.alert('Erro ao cadastrar escola.', function(ex){
      });
      </script>
      <?php
    endif;
  endif;
endif;
?>

<div class="row">
  <div class="form-group col-md-6">
    <label for="instituicao_nome" class="">Nome</label>
    <input type="text" class="form-control" name="instituicao_nome" id="instituicao_nome" placeholder="EMEF Água Salgada"
    value="<?= isset($dados['instituicao_nome']) ? $dados['instituicao_nome'] : ''; ?>" />
  </div>
  <div class="form-group col-md-6">
    <label for="instituicao_razao" class="">Razão</label>
    <input type="text" class="form-control" name="instituicao_razao" id="instituicao_razao" placeholder="EMEF Água Salgada"
    value="<?= isset($dados['instituicao_razao']) ? $dados['instituicao_razao'] : ''; ?>" />
  </div>
</div>
<div class="row">
  <div class="form-group col-md-4">
    <label for="telefone" class="">Telefone</label>
    <div class="label-input">
      <input type="text" class="form-control" name="telefone" id="telefone" placeholder="(27)3333-3333" />
      <button type="button" class="btn-input-tel" onclick="addPhone(thisno)"><i class="fa fa-plus-circle"></i></button>
    </div>
  </div>
  <div class="form-group col-md-4">
    <label for="instituicao_email" class="">Email</label>
    <input type="email" class="form-control" name="instituicao_email" id="instituicao_email" placeholder="teste@exemplo.com.br"
    value="<?= isset($dados['instituicao_email']) ? $dados['instituicao_email'] : ''; ?>" />
  </div>
  <div class="form-group col-md-4">
    <label for="instituicao_cnpj" class="">CNPJ</label>
    <input type="text" class="form-control" name="instituicao_cnpj" id="instituicao_cnpj" placeholder="23.123.123/0001-00"
    value="<?= isset($dados['instituicao_cnpj']) ? $dados['instituicao_cnpj'] : ''; ?>" />
  </div>
</div>
<div class="row">
  <div class="form-group col-md-6">
    <label for="tb_logradouros_logradouro_id" class="">Endereço</label>
    <select class="form-control" name="tb_logradouros_logradouro_id" id="tb_logradouros_logradouro_id">
      <option value="">Selecione...</option>
      <?php
      $readerlog = new Read;
      $readerlog->Reader('tb_logradouros', 'inner join tb_bairros on '
      . 'tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id');
      if ($readerlog->getRowCount() > 0):
        foreach ($readerlog->getResult() as $options):
          if (($options['logradouro_id'] == $dados['tb_logradouros_logradouro_id'])):
            echo "<option value=\"{$options['logradouro_id']}\" selected=\"selected\">{$options['logradouro_nome']} -- "
            . "{$options['bairros_nome']}</option>";
          else:
            echo "<option value=\"{$options['logradouro_id']}\">{$options['logradouro_nome']} -- "
            . "{$options['bairros_nome']}</option>";
          endif;
        endforeach;
      endif;
      ?>
    </select>
  </div>
  <div class="form-group col-md-2">
    <label for="instituicao_numero" class="">Número</label>
    <input type="text" class="form-control" name="instituicao_numero" id="instituicao_numero" placeholder="123"
    value="<?= isset($dados['instituicao_numero']) ? $dados['instituicao_numero'] : ''; ?>" />
  </div>
  <div class="form-group col-md-4">
    <label for="instituicao_diretor" class="">Diretor</label>
    <input type="text" class="form-control" name="instituicao_diretor" id="instituicao_diretor" placeholder="Juvenal Antena"
    value="<?= isset($dados['instituicao_diretor']) ? $dados['instituicao_diretor'] : ''; ?>" />
  </div>
</div>
<div class="row">
  <div class="form-group col-md-4">
    <div id="telefones" class="item-2">
      <label for="" class="">Telefones</label>
    </div>
  </div>
</div>
