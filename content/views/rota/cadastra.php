<div class="side-body">
  <?php
  if(isset($_SESSION['schoolbus_login']) && !empty($_SESSION['schoolbus_login']))
  {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $rotas = array();

    $read = new Read();
    if(isset($dados) && !empty($dados)):
      $cadastra = new ModelRotas();
      unset($dados['search_form'], $dados['telefone'], $dados['caminho_ref'], $dados['tb_logradouros_logradouro_id'], $dados['escolas_select']);
      // $rotas[$dados['tb_logradouros_logradouro_id']] = $dados['tb_logradouros_logradouro_id'];

      $cadastra->ModelCreator($dados);
      if($cadastra->getResult()):
        echo  "<div class='alert alert-success alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-check-circle'></span></strong> Rota cadastrada com sucesso.
        </div>";
      else:
        echo  "<div class='alert alert-warning alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong><span class='fa fa-exclamation-circle'></span></strong> Erro ao cadastrar rota. Verifique e tente novamente.
        </div>";
      endif;
      // var_dump($dados);
    endif;
    ?>

    <div class="page-title">
      <span class="title">Cadastro de Rotas</span>
      <div class="description">Formulário para cadastro de rotas no sistema.</div>
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
                  echo "<option value='{$inicio['logradouro_id']}'>{$inicio['logradouro_nome']} - {$inicio['logradouro_cep']}</option>";
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
                  echo "<option value='{$fim['logradouro_id']}'>{$fim['logradouro_nome']} - {$fim['logradouro_cep']}</option>";
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
            $escolasData = new ModelInstituicao;
            $escolasData->getInstituicoes(1);
            if($escolasData->getResult()){
              $escolas = $escolasData->getResult();
              for($x = 0; $x < count($escolasData->getResult()); $x++){
                echo "<input type='checkbox' name='escolas[]' value='{$escolas[$x]['instituicao_id']}' /> {$escolas[$x]['instituicao_nome']}<br />";
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
              if ($veiculos->getResult()):
                foreach ($veiculos->getResult() as $veiculo):
                  if(0 < $veiculo['veiculo_vagas'])
                  {
                    $description = $veiculo['veiculo_placa'] . ' - ' . $veiculo['veiculo_marca'] . ' - ' . $veiculo['veiculo_modelo'];
                    echo "<option value=\"{$veiculo['veiculo_id']}\">{$description}</option>";
                  }
                endforeach;
              endif;
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
                <input type="date" name="inicio" class="form-control" placeholder="<?= date('d/m/Y'); ?>" required="required" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="input-group">
                <div class="input-group-addon">Fim</div>
                <input type="date" name="fim" class="form-control" placeholder="<?= date('d/m/Y', strtotime('+1 year')); ?>" required="required" />
              </div>
            </div>
          </div>
        </div>

        <hr />

        <div class="form-group">
          <label for="observacoes" class="col-md-3 control-label">Observações</label>
          <div class="col-md-4">
            <textarea class="form-control" name="observacoes" id="observacoes" placeholder="Este campo serve apenas para observações, o mesmo é opcional."></textarea>
          </div>
        </div>

        <hr />

        <div class="form-group">
          <label for="" class="col-md-3 control-label"></label>
          <div class="col-md-3">
            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-download"></i> Gravar</button>
          </div>
        </div>
      </div>
    </div>
    <?php
  }else{
    header('HTTP/1.0 403 Forbidden');
    include_once './errors/403.php';
  }
  ?>
</div>
