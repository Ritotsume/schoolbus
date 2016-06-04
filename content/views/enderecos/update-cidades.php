<div class="side-body">

  <?php
  $cidadeObj = new ModelEnderecos;
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  $id_cidade = filter_input(INPUT_GET, 'param', FILTER_VALIDATE_INT);

  if(isset($dados) && !empty($dados)):
    unset($dados['search_form'], $dados['telefone']);

    $cidadeObj->UpdateCidade($id_cidade, $dados);
    if($cidadeObj->getResult()):
      echo  "<div class='alert alert-success alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-check-circle'></span></strong> Cidade <b>{$dados['cidade_nome']}</b> atualizada com sucesso.
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
    <div class="description">Atualizar cadastro de cidades.</div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="card-title">
        Atenção! Todos os campos são de preenchimento obrigatório.
      </div>
    </div>
    <div class="card-body">

      <?php
      if(isset($id_cidade) && !empty($id_cidade)):
        $cidade = $cidadeObj->getCidade($id_cidade);
        if($cidade):
          ?>

          <div class="form-group">
            <label for="cidade_nome" class="col-md-3 control-label">Cidade</label>
            <div class="col-md-5">
              <input type="text" name="cidade_nome" id="cidade_nome" placeholder="São Mateus"
              class="form-control" value="<?= isset($dados['cidade_nome']) ? $dados['cidade_nome'] : $cidade[0]['cidade_nome']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="cidade_uf" class="col-md-3 control-label">UF</label>
            <div class="col-md-4">
              <select class="form-control" name="cidade_uf" id="cidade_uf">
                <option value="">Selecione...</option>
                <?php
                $readerlog = new ModelEnderecos;
                $readerlog->getCidades();
                if ($readerlog->getRowCount() > 0):
                  foreach ($readerlog->getResult() as $options):
                    if (($options['cidade_uf'] == $dados['cidade_uf']) ||
                    $options['cidade_uf'] == $cidade[0]['cidade_uf']):
                    echo "<option value=\"{$options['cidade_uf']}\" selected=\"selected\">{$options['cidade_uf']}</option>";
                  else:
                    echo "<option value=\"{$options['cidade_uf']}\">{$options['cidade_uf']}</option>";
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
        <strong><span class='fa fa-info-circle'></span></strong> Nada foi encontrado.
        </div>";
      endif;
    else:
      echo  "<div class='alert alert-info alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-info-circle'></span></strong> Nada foi encontrado. Certifique-se de ter informado uma cidade para atualizar.
      </div>";
    endif;
    ?>

  </div>
</div>
</div>
