<div class="side-body">

  <?php
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  if(isset($dados) && !empty($dados)):
    $cadastra = new ModelMotorista();
    unset($dados['search_form'], $dados['telefone']);

    $request = md5(implode($dados));

    if(isset($_SESSION['last_request']) && $_SESSION['last_request']== $request):
      echo "<div class='alert alert-warning alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-warning'></span></strong> Motorista <b>{$dados['motorista_nome']}</b> já está cadastrado(a).
      <a href='". HOME ."motorista'><span class='label label-warning'>Confira!</span></a>
      </div>";
    else:
      $_SESSION['last_request']  = $request;
      $cadastra->ModelCreator($dados);
      if($cadastra->getRowCount() > 0):
        echo  "<div class='alert alert-success alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-check-circle'></span></strong> Motorista <b>{$dados['motorista_nome']}</b> cadastrado(a) com sucesso.
        </div>";
      else:
        echo  "<div class='alert alert-warning alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-exclamation-circle'></span></strong> Erro ao cadastrar aluno. Verifique e tente novamente.
        </div>";
      endif;
    endif;
  endif;
  ?>

  <div class="page-title">
    <span class="title">Cadastro</span>
    <div class="description">Cadastro de motorista.</div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="card-title">
        Atenção! Campos com (*) são de preenchimento obrigatório.
      </div>
    </div>
    <div class="card-body">

      <div class="form-group">
        <label for="motorista_nome" class="col-md-3 control-label">Nome*</label>
        <div class="col-md-5">
          <input type="text" name="motorista_nome" id="motorista_nome" placeholder="Nome do motorista"
          class="form-control" value="<?= isset($dados['motorista_nome']) ? $dados['motorista_nome'] : ''; ?>" required="required" />
        </div>
      </div>

      <div class="form-group">
        <label for="motorista_sobrenome" class="col-md-3 control-label">Sobrenome*</label>
        <div class="col-md-5">
          <input type="text" name="motorista_sobrenome" id="motorista_sobrenome" placeholder="Sobrenome do motorista"
          class="form-control" value="<?= isset($dados['motorista_sobrenome']) ? $dados['motorista_sobrenome'] : ''; ?>" required="required" />
        </div>
      </div>

      <div class="form-group">
        <label for=motorista_rg"" class="col-md-3 control-label">RG*</label>
        <div class="col-md-3">
          <input type="text" name="motorista_rg" id="motorista_rg" placeholder="RG do motorista"
          class="form-control" value="<?= isset($dados['motorista_rg']) ? $dados['motorista_rg'] : ''; ?>" required="required" />
        </div>
      </div>

      <div class="form-group">
        <label for="motorista_cpf" class="col-md-3 control-label">CPF*</label>
        <div class="col-md-3">
          <input type="text" name="motorista_cpf" id="motorista_cpf" placeholder="CPF do motorista"
          pattern="^[0-9]{3}[.][0-9]{3}[.][0-9]{3}[-][0-9]{2}$" title="Deve ser no formato xxx.xxx.xxx-xx"
          class="form-control" value="<?= isset($dados['motorista_cpf']) ? $dados['motorista_cpf'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="motorista_tel" class="col-md-3 control-label">Telefone</label>
        <div class="col-md-2">
          <input type="tel" class="form-control" name="motorista_tel" id="motorista_tel" placeholder="Telefone"
          value="<?= isset($dados['motorista_tel']) ? $dados['motorista_tel'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="motorista_cel" class="col-md-3 control-label">Celular</label>
        <div class="col-md-2">
          <input type="tel" class="form-control" name="motorista_cel" id="motorista_cel" placeholder="Celular"
          value="<?= isset($dados['motorista_cel']) ? $dados['motorista_cel'] : ''; ?>" />
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
        <label for="motorista_end_numero" class="col-md-3 control-label">Número</label>
        <div class="col-md-2">
          <input type="text" class="form-control" name="motorista_end_numero" id="motorista_end_numero" placeholder="Número da casa"
          value="<?= isset($dados['motorista_end_numero']) ? $dados['motorista_end_numero'] : ''; ?>" />
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
