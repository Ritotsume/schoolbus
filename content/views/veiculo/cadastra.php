<div class="side-body">

  <?php
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  if(isset($dados) && !empty($dados)):
    $cadastra = new ModelVeiculo();
    unset($dados['search_form'], $dados['telefone']);

    $request = md5(implode($dados));

    if(isset($_SESSION['last_request']) && $_SESSION['last_request']== $request):
      echo "<div class='alert alert-warning alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-warning'></span></strong> Veículo <b>{$dados['veiculo_placa']}</b> já está cadastrado.
      <a href='". HOME ."veiculo'><span class='label label-warning'>Confira!</span></a>
      </div>";
    else:
      $_SESSION['last_request']  = $request;
      $cadastra->ModelCreator($dados);
      if($cadastra->getRowCount() > 0):
        echo  "<div class='alert alert-success alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-check-circle'></span></strong> Veículo <b>{$dados['veiculo_placa']}</b> cadastrado com sucesso.
        </div>";
      else:
        echo  "<div class='alert alert-warning alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-exclamation-circle'></span></strong> Erro ao cadastrar <b>{$dados['veiculo_placa']}</b>. Verifique e tente novamente.
        </div>";
      endif;
    endif;
  endif;
  ?>

  <div class="page-title">
    <span class="title">Cadastro</span>
    <div class="description">Cadastro de veículo.</div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="card-title">
        Atenção! Campos com (*) são de preenchimento obrigatório.
      </div>
    </div>
    <div class="card-body">

      <div class="form-group">
        <label for="veiculo_placa" class="col-md-3 control-label">Placa*</label>
        <div class="col-md-2">
          <input type="text" name="veiculo_placa" id="veiculo_placa" placeholder="Placa do veículo"
          class="form-control" value="<?= isset($dados['veiculo_placa']) ? $dados['veiculo_placa'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="veiculo_marca" class="col-md-3 control-label">Marca*</label>
        <div class="col-md-3">
          <input type="text" name="veiculo_marca" id="veiculo_marca" placeholder="Marca do veículo"
          class="form-control" value="<?= isset($dados['veiculo_marca']) ? $dados['veiculo_marca'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="veiculo_modelo" class="col-md-3 control-label">Modelo*</label>
        <div class="col-md-2">
          <input type="text" name="veiculo_modelo" id="veiculo_modelo" placeholder="Modelo do veículo"
          class="form-control" value="<?= isset($dados['veiculo_modelo']) ? $dados['veiculo_modelo'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="veiculo_poltronas" class="col-md-3 control-label">Poltronas*</label>
        <div class="col-md-2">
          <input type="text" name="veiculo_poltronas" id="veiculo_poltronas" placeholder="Quantidade de assentos do veículo"
          class="form-control" value="<?= isset($dados['veiculo_poltronas']) ? $dados['veiculo_poltronas'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="veiculo_ano" class="col-md-3 control-label">Ano</label>
        <div class="col-md-3">
          <input type="date" name="veiculo_ano" id="veiculo_ano" placeholder="Ano de fabricação e ano do modelo"
          pattern="^[0-9]{4}[/][0-9]{4}$" title="Deve estar nesse formato xxxx/xxxx"
          class="form-control" value="<?= isset($dados['veiculo_ano']) ? $dados['veiculo_ano'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="veiculo_agregado" class="col-md-3 control-label">Tipo de contrato*</label>
        <div class="col-md-3">
          <select class="form-control" name="veiculo_agregado" id="veiculo_agregado" required="required">
            <option value="">Selecione...</option>
            <option value="1" <?= isset($dados['veiculo_agregado']) && $dados['veiculo_agregado'] == 1 ? 'selected="selected"' : ''; ?>>Agregado</option>
            <option value="2" <?= isset($dados['veiculo_agregado']) && $dados['veiculo_agregado'] == 2 ? 'selected="selected"' : ''; ?>>Prefeitura - Município</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="veiculo_kms" class="col-md-3 control-label">Kms rodados</label>
        <div class="col-md-2">
          <input type="text" name="veiculo_kms" id="veiculo_kms" placeholder="Quantidade de km rodados"
          class="form-control" value="<?= isset($dados['veiculo_kms']) ? $dados['veiculo_kms'] : ''; ?>" />
        </div>
      </div>

      <div class="form-group">
        <label for="" class="col-md-3 control-label"></label>
        <div class="col-md-2">
          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-download"></i> Gravar</button>
        </div>
      </div>

    </div>
  </div>
</div>
