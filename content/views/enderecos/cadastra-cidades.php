<div class="side-body">

  <?php
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  if(isset($dados) && !empty($dados)):
    $cadastra = new ModelEnderecos;
    unset($dados['search_form'], $dados['telefone']);

    $request = md5(implode($dados));

    if(isset($_SESSION['last_request']) && $_SESSION['last_request']== $request):
      echo "<div class='alert alert-warning alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-warning'></span></strong> Cidade <b>{$dados['cidade_nome']}</b> já está cadastrado.
      <a href='". HOME ."enderecos/cidades'><span class='label label-warning'>Confira!</span></a>
      </div>";
    else:
      $_SESSION['last_request']  = $request;
      $cadastra->CriaCidade($dados);
      if($cadastra->getResult()):
        echo  "<div class='alert alert-success alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-check-circle'></span></strong> Cidade <b>{$dados['cidade_nome']}</b> cadastrada com sucesso.
        </div>";
      else:
        echo  "<div class='alert alert-warning alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-exclamation-circle'></span></strong> Erro ao cadastrar cidade. Verifique e tente novamente.
        </div>";
        unset($_SESSION['last_request']);
      endif;
    endif;
  endif;
  ?>

  <div class="page-title">
    <span class="title">Cadastro</span>
    <div class="description">Cadastro de cidades.</div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="card-title">
        Atenção! Todos os campos são de preenchimento obrigatório.
      </div>
    </div>
    <div class="card-body">

      <div class="form-group">
        <label for="cidade_nome" class="col-md-3 control-label">Cidade</label>
        <div class="col-md-5">
          <input type="text" name="cidade_nome" id="cidade_nome" placeholder="São Mateus"
          class="form-control" value="<?= isset($dados['cidade_nome']) ? $dados['cidade_nome'] : ''; ?>" />
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
                if (($options['cidade_uf'] == $dados['cidade_uf'])):
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
          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-download"></i> Gravar</button>
        </div>
      </div>

    </div>
  </div>
</div>
