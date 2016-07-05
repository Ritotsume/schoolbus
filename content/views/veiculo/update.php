<div class="side-body">
  <?php
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  $idVeiculo = filter_input(INPUT_GET, 'param', FILTER_VALIDATE_INT);
  $param = filter_input(INPUT_GET, 'ref', FILTER_DEFAULT);

  if (isset($dados) && !empty($dados)):
    unset($dados['search_form'], $dados['telefone']);
    $upescola = new ModelVeiculo();

    $upescola->ModelUpdate($idVeiculo, $dados);
    if ($upescola->getResult()):
      echo  "<div class='alert alert-success alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-check-circle'></span></strong> Dados atualizados com sucesso.
      </div>";
    else:
      echo  "<div class='alert alert-warning alert-dismissible' role='alert'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      <strong><span class='fa fa-exclamation-circle'></span></strong> Aconteceram erros, portanto, nenhum dado foi atualizado.
      </div>";
    endif;
  endif;

  if (isset($idVeiculo) && !empty($idVeiculo)):
    $read = new ModelVeiculo;
    $read->getVeiculo($idVeiculo);
    if ($read->getResult()):
      ?>
      <div class="page-title">
        <span class="title">Atualização de dados cadastrais</span>
        <div class="description">Atualizando dados de veículo.</div>
      </div>

      <div class="card">
        <div class="card-header">
          <div class="card-title">
            Atenção! Campos com (*) são de preenchimento obrigatório.
          </div>
        </div>
        <div class="card-body">

          <div class="form-group">
            <label for="veiculo_placa" class="col-xs-3 control-label">Placa*</label>
            <div class="col-xs-2">
              <input type="text" name="veiculo_placa" id="veiculo_placa" placeholder="Placa do veículo" class="form-control" required="required"
              value="<?= isset($dados['veiculo_placa']) ? $dados['veiculo_placa'] : $read->getResult()[0]['veiculo_placa']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="veiculo_marca" class="col-xs-3 control-label">Marca*</label>
            <div class="col-xs-3">
              <input type="text" name="veiculo_marca" id="veiculo_marca" placeholder="Marca do veículo" class="form-control" required="required"
              value="<?= isset($dados['veiculo_marca']) ? $dados['veiculo_marca'] : $read->getResult()[0]['veiculo_marca']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="veiculo_modelo" class="col-xs-3 control-label">Modelo*</label>
            <div class="col-xs-3">
              <input type="text" name="veiculo_modelo" id="veiculo_modelo" placeholder="Modelo do veículo" class="form-control" required="required"
              value="<?= isset($dados['veiculo_modelo']) ? $dados['veiculo_modelo'] : $read->getResult()[0]['veiculo_modelo']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="veiculo_poltronas" class="col-xs-3 control-label">Poltronas*</label>
            <div class="col-xs-2">
              <input type="text" name="veiculo_poltronas" id="veiculo_poltronas" placeholder="Quantidade de assentos do veículo" class="form-control"
              value="<?= isset($dados['veiculo_poltronas']) ? $dados['veiculo_poltronas'] : $read->getResult()[0]['veiculo_poltronas']; ?>" required="required" />
            </div>
          </div>

          <div class="form-group">
            <label for="veiculo_ano" class="col-xs-3 control-label">Ano</label>
            <div class="col-xs-2">
              <input type="text" name="veiculo_ano" id="veiculo_ano" placeholder="Ano de fabricação e ano do modelo" class="form-control"
              pattern="^[0-9]{4}[/][0-9]{4}$" title="Deve estar nesse formato xxxx/xxxx"
              value="<?= isset($dados['veiculo_ano']) ? $dados['veiculo_ano'] : $read->getResult()[0]['veiculo_ano']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="veiculo_agregado" class="col-xs-3 control-label">Tipo de contrato*</label>
            <div class="col-xs-3">
              <select name="veiculo_agregado" id="veiculo_agregado" class="form-control" required="required">
                <option value="">Selecione...</option>
                <option value="1" <?= (isset($dados['veiculo_agregado']) && $dados['veiculo_agregado'] == 1) || $read->getResult()[0]['veiculo_agregado'] == 1 ? 'selected="selected"' : ''; ?>>Agregado</option>
                <option value="0" <?= (isset($dados['veiculo_agregado']) && $dados['veiculo_agregado'] == 0) || $read->getResult()[0]['veiculo_agregado'] == 0 ? 'selected="selected"' : ''; ?>>Prefeitura - Município</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="veiculo_kms" class="col-xs-3 control-label">Kms rodados</label>
            <div class="col-xs-3">
              <input type="text" name="veiculo_kms" id="veiculo_kms" placeholder="Kms rodados" class="form-control"
              value="<?= isset($dados['veiculo_kms']) ? $dados['veiculo_kms'] : $read->getResult()[0]['veiculo_kms']; ?>" />
            </div>
          </div>

          <div class="form-group">
            <label for="" class="col-xs-3 control-label"></label></label>
            <div class="col-xs-2">
              <button type="submit" class="btn btn-success btn-block"><i class="fa fa-download"></i> Atualizar</button>
            </div>
          </div>

        </div>
      </div>
      <?php
    else:
      ADSError('Não foram encontrados dados relacionados...', CRAZY_INFOR);
    endif;
  else:
    ADSError('Parametro del nao encontrado', CRAZY_INFOR);
  endif;
  ?>
</div>
