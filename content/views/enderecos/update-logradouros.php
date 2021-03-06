<div class="side-body">

  <?php
  $atualiza = new ModelEnderecos;
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  $id_logradouro = filter_input(INPUT_GET, 'param', FILTER_VALIDATE_INT);

  if(isset($dados) && !empty($dados)):
    unset($dados['search_form'], $dados['telefone']);

    $atualiza->UpdateLogradouro($id_logradouro, $dados);
    if($atualiza->getResult()):
      echo  "<div class='alert alert-success alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-check-circle'></span></strong> Logradouro <b>{$dados['logradouro_nome']}</b> atualizado com sucesso.
      </div>";
    else:
      echo  "<div class='alert alert-warning alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-exclamation-circle'></span></strong> Erro ao atualizar. Verifique e tente novamente.
      </div>";
      unset($_SESSION['last_request']);
    endif;
  endif;
  ?>

  <div class="page-title">
    <span class="title">Atualização</span>
    <div class="description">Atualização de logradouros.</div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="card-title">
        Atenção! Todos os campos são de preenchimento obrigatório.
      </div>
    </div>
    <div class="card-body">

      <?php
      if(isset($id_logradouro) && !empty($id_logradouro)):
        $logradouroObj = clone $atualiza;
        $logradouro = $logradouroObj->getLogradouro($id_logradouro);
        if($logradouro):
          ?>

          <div class="form-group">
            <label for="logradouro_nome" class="col-md-3 control-label">Nome</label>
            <div class="col-md-5">
              <input type="text" name="logradouro_nome" id="logradouro_nome" placeholder="Av. Juca Silva"
              class="form-control" value="<?= isset($dados['logradouro_nome']) ? $dados['logradouro_nome'] : $logradouro[0]['logradouro_nome']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="logradouro_cep" class="col-md-3 control-label">CEP</label>
            <div class="col-md-3">
              <input type="text" name="logradouro_cep" id="logradouro_cep" placeholder="29930-000"
              class="form-control" value="<?= isset($dados['logradouro_cep']) ? $dados['logradouro_cep'] : $logradouro[0]['logradouro_cep']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="tb_bairros_bairros_id" class="col-md-3 control-label">Bairro</label>
            <div class="col-md-4">
              <select class="form-control" name="tb_bairros_bairros_id" id="tb_bairros_bairros_id">
                <option value="">Selecione...</option>
                <?php
                $readerlog = new ModelEnderecos;
                $readerlog->getBairros();
                if ($readerlog->getRowCount() > 0):
                  foreach ($readerlog->getResult() as $options):
                    if (($options['bairros_id'] == $dados['tb_bairros_bairros_id']) ||
                    ($options['bairros_id'] == $logradouro[0]['tb_bairros_bairros_id'])):
                    echo "<option value=\"{$options['bairros_id']}\" selected=\"selected\">{$options['bairros_nome']}</option>";
                  else:
                    echo "<option value=\"{$options['bairros_id']}\">{$options['bairros_nome']}</option>";
                  endif;
                endforeach;
              endif;
              ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="" class="col-md-3 control-label"></label>
          <div class="col-md-3">
            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-download"></i> Atualizar</button>
          </div>
        </div>

        <?php
      else:
        echo  "<div class='alert alert-info alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-info-circle'></span></strong> Nada encontrado.
        </div>";
      endif;
    else:
      echo  "<div class='alert alert-info alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-info-circle'></span></strong> Nada encontrado. Certifique-se de informar um logradouro para atualizar.
      </div>";
    endif;
    ?>

  </div>
</div>
</div>
