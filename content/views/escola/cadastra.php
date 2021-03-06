<div class="side-body">
  <?php
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  if(isset($dados) && !empty($dados)):
    $cadastra = new ModelInstituicao();
    unset($dados['search_form'], $dados['telefone']);

    $request = md5(implode($dados));

    if(isset($_SESSION['last_request']) && $_SESSION['last_request']== $request):
      echo "<div class='alert alert-warning alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-warning'></span></strong> A escola <b>{$dados['instituicao_nome']}</b> já está cadastrada.
      <a href='". HOME ."escola'><span class='label label-warning'>Confira!</span></a>
      </div>";
    else:
      $_SESSION['last_request']  = $request;
      $cadastra->ModelCreator($dados);
      if($cadastra->getRowCount() > 0):
        echo  "<div class='alert alert-success alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-check-circle'></span></strong> Escola <b>{$dados['instituicao_nome']}</b> cadastrada com sucesso.
        </div>";
      else:
        echo  "<div class='alert alert-warning alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-exclamation-circle'></span></strong> Erro ao cadastrar escola <b>{$dados['instituicao_nome']}</b>. Verifique e tente novamente.
        </div>";
        var_dump($cadastra->getResult());
      endif;
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
        <label for="instituicao_nome" class="col-md-3 control-label">Nome*</label>
        <div class="col-md-5">
          <input type="text" class="form-control" name="instituicao_nome" id="instituicao_nome" placeholder="Nome da escola"
          value="<?= isset($dados['instituicao_nome']) ? $dados['instituicao_nome'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="instituicao_razao" class="col-md-3 control-label">Razão*</label>
        <div class="col-md-5">
          <input type="text" class="form-control" name="instituicao_razao" id="instituicao_razao" placeholder="Razão Social da escola"
          value="<?= isset($dados['instituicao_razao']) ? $dados['instituicao_razao'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="instituicao_cnpj" class="col-md-3 control-label">CNPJ*</label>
        <div class="col-md-3">
          <input type="text" class="form-control" name="instituicao_cnpj" id="instituicao_cnpj" placeholder="CNPJ da escola"
          value="<?= isset($dados['instituicao_cnpj']) ? $dados['instituicao_cnpj'] : ''; ?>"
          pattern="^[0-9]{2}[.][0-9]{3}[.][0-9]{3}[/][0-9]{4}[-][0-9]{2}$" />
        </div>
      </div>

      <div class="form-group">
        <label for="instituicao_tel" class="col-md-3 control-label">Telefone</label>
        <div class="col-md-2">
          <input type="tel" class="form-control" name="instituicao_tel" id="instituicao_tel" placeholder="Telefone"
          value="<?= isset($dados['instituicao_tel']) ? $dados['instituicao_tel'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="instituicao_cel" class="col-md-3 control-label">Celular</label>
        <div class="col-md-2">
          <input type="tel" class="form-control" name="instituicao_cel" id="instituicao_cel" placeholder="Celular"
          value="<?= isset($dados['instituicao_cel']) ? $dados['instituicao_cel'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="instituicao_email" class="col-md-3 control-label">Email</label>
        <div class="col-md-5">
          <input type="email" class="form-control" name="instituicao_email" id="instituicao_email" placeholder="Email da escola"
          value="<?= isset($dados['instituicao_email']) ? $dados['instituicao_email'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="tb_logradouros_logradouro_id" class="col-md-3 control-label">Endereço*</label>
        <div class="col-md-4">
          <select class="form-control" name="tb_logradouros_logradouro_id" id="tb_logradouros_logradouro_id" required="required">
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
        <label for="instituicao_numero" class="col-md-3 control-label">Número</label>
        <div class="col-md-2">
          <input type="text" class="form-control" name="instituicao_numero" id="instituicao_numero" placeholder="Número do prédio ou casa"
          value="<?= isset($dados['instituicao_numero']) ? $dados['instituicao_numero'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="instituicao_diretor" class="col-md-3 control-label">Diretor</label>
        <div class="col-md-5">
          <input type="text" class="form-control" name="instituicao_diretor" id="instituicao_diretor" placeholder="Diretor da escola"
          value="<?= isset($dados['instituicao_diretor']) ? $dados['instituicao_diretor'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="" class="col-md-3 control-label"></label>
        <div class="col-md-3">
          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-download"></i> Gravar</button>
        </div>
      </div>

    </div>
  </div>
</div>
