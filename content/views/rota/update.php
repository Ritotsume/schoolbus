<div class="side-body">
  <?php
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  $idRota = filter_input(INPUT_GET, 'param', FILTER_DEFAULT);
  $param = filter_input(INPUT_GET, 'ref', FILTER_VALIDATE_INT);

  if (isset($dados) && !empty($dados)):
    if (isset($dados['editar'])):
      unset($dados['search_form'], $dados['editar'], $dados['telefone']);
      $uprota = new ModelRotas();

      $uprota->ModelUpdate($idRota, $dados);
      if ($uprota->getResult()):
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
  endif;

  if (isset($idRota) && !empty($idRota)):
    $readrota = new ModelRotas();
    $dataRota = $readrota->getRota($idRota);
    if ($dataRota):
      ?>

      <div class="page-title">
        <span class="title">Atualização de dados cadastrais</span>
        <div class="description">Atualizando dados de rotas.</div>
      </div>

      <div class="card">
        <div class="card-header">
          <div class="card-title">
            Atenção! TODOS os campos são de preenchimento obrigatório.
          </div>
        </div>
        <div class="card-body">

          <div class="form-group">
            <label for="rota_inicio" class="col-md-3 control-label">Início do trajeto</label>
            <div class="col-md-3">
              <select name="rota_inicio" class="form-control" id="rota_inicio" required="required">
                <option value="">Selecione...</option>
                <?php
                $rotaInicio = new ModelEnderecos;
                $rotaInicio->getLogradouros();
                if($rotaInicio->getResult()){
                  foreach($rotaInicio->getResult() as $inicio){
                    if(($inicio['logradouro_id'] == $dataRota[0]['rota_saida']) ||
                    ($inicio['logradouro_id'] == $dados['rota_inicio'])){
                      echo "<option value='{$inicio['logradouro_id']}' selected='selected'>{$inicio['logradouro_nome']} - {$inicio['logradouro_cep']}</option>";
                    }else{
                      echo "<option value='{$inicio['logradouro_id']}'>{$inicio['logradouro_nome']} - {$inicio['logradouro_cep']}</option>";
                    }
                  }
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="rota_fim" class="col-md-3 control-label">Fim do trajeto</label>
            <div class="col-md-3">
              <select name="rota_fim" class="form-control" id="rota_fim" required="required">
                <option value="">Selecione...</option>
                <?php
                $rotaFim = clone $rotaInicio;
                $rotaFim->getLogradouros();
                if($rotaFim->getResult()){
                  foreach($rotaFim->getResult() as $fim){
                    if(($fim['logradouro_id'] == $dataRota[0]['rota_chegada']) ||
                    ($fim['logradouro_id'] == $dados['rota_fim'])){
                      echo "<option value='{$fim['logradouro_id']}' selected='selected'>{$fim['logradouro_nome']} - {$fim['logradouro_cep']}</option>";
                    }else{
                      echo "<option value='{$fim['logradouro_id']}'>{$fim['logradouro_nome']} - {$fim['logradouro_cep']}</option>";
                    }
                  }
                }
                ?>
              </select>
            </div>
          </div>

          <hr />

          <div class="form-group">
            <label for="" class="col-md-3 control-label">Escolas</label>
            <div class="col-md-7">
              <?php
              $escolasCad = json_decode($dataRota[0]['rota_instituicoes'], true);
              $escolasData = new ModelInstituicao;
              $escolasData->getInstituicoes(1);
              if($escolasData->getResult()){
                $escolas = $escolasData->getResult();
                for($x = 0; $x < count($escolasData->getResult()); $x++){
                  if(key_exists($x, $escolasCad) && ($escolas[$x]['instituicao_id'] == $escolasCad[$x])){
                    echo "<input type='checkbox' name='escolas[]' value='{$escolas[$x]['instituicao_id']}' "
                    ."checked='checked' /> {$escolas[$x]['instituicao_nome']}<br />";
                  }else{
                    echo "<input type='checkbox' name='escolas[]' value='{$escolas[$x]['instituicao_id']}' "
                    ." /> {$escolas[$x]['instituicao_nome']}<br />";
                  }
                }
              }
              ?>
            </div>
          </div>

          <hr />

          <div class="form-group">
            <label for="rota_veiculo" class="col-md-3 control-label">Veículo</label>
            <div class="col-md-4">
              <select class="form-control" name="rota_veiculo" id="rota_veiculo" required="required">
                <option value="">Selecione</option>
                <?php
                $stat = 1;
                $veiculos = new ModelVeiculo;
                $veiculos->getVeiculos($stat);
                if ($veiculos->getResult()){
                  foreach ($veiculos->getResult() as $veiculo){
                    $description = $veiculo['veiculo_placa'] . ' - ' . $veiculo['veiculo_marca'] . ' - ' . $veiculo['veiculo_modelo'];
                    if(($veiculo['veiculo_id'] == $dataRota[0]['tb_veiculos_veiculo_id']) ||
                    ($veiculo['veiculo_id'] == $dados['rota_veiculo'])){
                      echo "<option value=\"{$veiculo['veiculo_id']}\" selected='selected'>{$description}</option>";
                    }else{
                      echo "<option value=\"{$veiculo['veiculo_id']}\">{$description}</option>";
                    }
                  }
                }
                ?>
              </select>
            </div>
          </div>

          <hr />

          <div class="form-group">
            <label for="" class="col-md-3 control-label">Período</label>
            <div class="col-md-8">
              <div class="col-md-4">
                <div class="input-group">
                  <div class="input-group-addon">Início</div>
                  <input type="date" name="inicio" class="form-control" placeholder="<?= date('d/m/Y'); ?>"
                  value="<?= isset($dados['inicio']) ? date('d/m/Y', strtotime($dados['inicio'])) : date('d/m/Y', strtotime($dataRota[0]['rota_inicio'])); ?>" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="input-group">
                  <div class="input-group-addon">Fim</div>
                  <input type="date" name="fim" class="form-control" placeholder="<?= date('d/m/Y', strtotime('+1 year')); ?>"
                  value="<?= isset($dados['fim']) ? date('d/m/Y', strtotime($dados['fim'])) : date('d/m/Y', strtotime($dataRota[0]['rota_fim'])); ?>" />
                </div>
              </div>
            </div>
          </div>

          <hr />

          <div class="form-group">
            <label for="observacoes" class="col-md-3 control-label">Observações</label>
            <div class="col-md-4">
              <textarea class="form-control" name="observacoes" id="observacoes" required="required"><?= isset($dados['observacoes']) ? $dados['observacoes'] : $dataRota[0]['rota_observacoes']; ?></textarea>
            </div>
          </div>

          <hr />

          <div class="form-group">
            <label for="" class="col-xs-3"></label>
            <div class="col-xs-2">
              <button type="submit" class="btn btn-success btn-block" name="editar"><i class="fa fa-download"></i> Atualizar</button>
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
  </div>
</div>
