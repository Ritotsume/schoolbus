<div class="side-body">

  <?php
  $bairroObj = new ModelEnderecos;
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  $id_bairro = filter_input(INPUT_GET, 'param', FILTER_VALIDATE_INT);

  if(isset($dados) && !empty($dados)):
    unset($dados['search_form'], $dados['telefone']);

    $bairroObj->UpdateBairro($id_bairro, $dados);
    if($bairroObj->getResult()):
      echo  "<div class='alert alert-success alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-check-circle'></span></strong> Bairro <b>{$dados['bairros_nome']}</b> atualizado com sucesso.
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
    <span class="title">Cadastro</span>
    <div class="description">Cadastro de bairros.</div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="card-title">
        Atenção! Todos os campos são de preenchimento obrigatório.
      </div>
    </div>
    <div class="card-body">

      <?php
      if(isset($id_bairro) && !empty($id_bairro)):
        $bairro = $bairroObj->getBairro($id_bairro);

        if($bairro):
          ?>

          <div class="form-group">
            <label for="bairros_nome" class="col-md-3 control-label">Bairro</label>
            <div class="col-md-5">
              <input type="text" name="bairros_nome" id="bairros_nome" placeholder="Centro"
              class="form-control" value="<?= isset($dados['bairros_nome']) ? $dados['bairros_nome'] : $bairro[0]['bairros_nome']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="tb_cidade_cidade_id" class="col-md-3 control-label">Cidade</label>
            <div class="col-md-4">
              <select class="form-control" name="tb_cidade_cidade_id" id="tb_cidade_cidade_id">
                <option value="">Selecione...</option>
                <?php
                $readerlog = new ModelEnderecos;
                $readerlog->getCidades();
                if ($readerlog->getRowCount() > 0):
                  foreach ($readerlog->getResult() as $options):
                    if (($options['cidade_id'] == $dados['tb_cidade_cidade_id']) ||
                    ($options['cidade_id'] == $bairro[0]['cidade_id'])):
                    echo "<option value=\"{$options['cidade_id']}\" selected=\"selected\">{$options['cidade_nome']}</option>";
                  else:
                    echo "<option value=\"{$options['cidade_id']}\">{$options['cidade_nome']}</option>";
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
      <strong><span class='fa fa-info-circle'></span></strong> Nada encontrado. Certifique-se de informar um bairro para atualizar.
      </div>";
    endif;
    ?>

  </div>
</div>
</div>
