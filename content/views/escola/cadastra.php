<div class="side-body">
  <?php
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  if(isset($dados) && !empty($dados)):
    $cadastra = new ModelInstituicao();
    unset($dados['search_form'], $dados['telefone']);
    $cadastra->ModelCreator($dados);
    if($cadastra->getRowCount() > 0):
      echo  "<div class='alert alert-success alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-check-circle'></span></strong> Escola <b>{$dados['instituicao_nome']}</b> cadastrada com sucesso.
      </div>";
    else:
      echo  "<div class='alert alert-warning alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-exclamation-circle'></span></strong> Erro ao cadastrar aluno. Verifique e tente novamente.
      </div>";
    endif;
  endif;
  ?>

  <div class="page-title">
    <span class="title">Cadastro</span>
    <div class="description">Cadastro de escola.</div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="card-title">
        Atenção! Campos com (*) são de preenchimento obrigatório.
      </div>
    </div>
    <div class="card-body">

      <div class="form-group">
        <label for="instituicao_nome" class="col-xs-3 control-label">Nome</label>
        <div class="col-xs-5">
          <input type="text" class="form-control" name="instituicao_nome" id="instituicao_nome" placeholder="EMEF Água Salgada"
          value="<?= isset($dados['instituicao_nome']) ? $dados['instituicao_nome'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="instituicao_razao" class="col-xs-3 control-label">Razão</label>
        <div class="col-xs-5">
          <input type="text" class="form-control" name="instituicao_razao" id="instituicao_razao" placeholder="EMEF Água Salgada"
          value="<?= isset($dados['instituicao_razao']) ? $dados['instituicao_razao'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group has-feedback">
        <label for="telefone" class="col-xs-3 control-label">Telefone</label>
        <div class="col-xs-3">
          <div class="input-group">
            <input type="number" class="form-control" name="telefone" id="telefone"
            placeholder="(27)3333-3333" />
            <span class="input-group-addon"><i class="fa fa-plus-circle"></i></span>
          </div>
          <!-- <button type="button" class="btn-input-tel" id="btn-telefone-add" data-phone="add"><i class="fa fa-plus-circle"></i></button> -->
        </div>
      </div>

      <div class="form-group">
        <label for="instituicao_email" class="col-xs-3 control-label">Email</label>
        <div class="col-xs-5">
          <input type="email" class="form-control" name="instituicao_email" id="instituicao_email" placeholder="teste@exemplo.com.br"
          value="<?= isset($dados['instituicao_email']) ? $dados['instituicao_email'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="instituicao_cnpj" class="col-xs-3 control-label">CNPJ</label>
        <div class="col-xs-3">
          <input type="number" class="form-control" name="instituicao_cnpj" id="instituicao_cnpj" placeholder="23.123.123/0001-00"
          value="<?= isset($dados['instituicao_cnpj']) ? $dados['instituicao_cnpj'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="tb_logradouros_logradouro_id" class="col-xs-3 control-label">Endereço</label>
        <div class="col-xs-4">
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
      </div>

      <div class="form-group">
        <label for="instituicao_numero" class="col-xs-3 control-label">Número</label>
        <div class="col-xs-2">
          <input type="number" class="form-control" name="instituicao_numero" id="instituicao_numero" placeholder="123"
          value="<?= isset($dados['instituicao_numero']) ? $dados['instituicao_numero'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="instituicao_diretor" class="col-xs-3 control-label">Diretor</label>
        <div class="col-xs-5">
          <input type="text" class="form-control" name="instituicao_diretor" id="instituicao_diretor" placeholder="Juvenal Antena"
          value="<?= isset($dados['instituicao_diretor']) ? $dados['instituicao_diretor'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="" class="col-xs-3 control-label">Telefones</label>
        <div class="col-xs-3">
          <div id="telefones" class=""></div>
        </div>
      </div>

      <div class="form-group">
        <label for="" class="col-xs-3 control-label"></label>
        <div class="col-xs-3">
          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-download"></i> Gravar</button>
        </div>
      </div>

    </div>
  </div>
