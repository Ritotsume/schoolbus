<div class="side-body">
  <?php
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
    <span class="title">Cadastro</span>
    <div class="description">Cadastro de rota.</div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="card-title">
        Atenção! Campos com (*) são de preenchimento obrigatório.
      </div>
    </div>
    <div class="card-body">

      <div class="form-group">
        <label for="tb_logradouros_logradouro_id" class="col-md-3 control-label">Logradouros</label>
        <div class="col-md-3">
          <button type="button" class="btn btn-warning col-xs-12" data-toggle="modal" data-target="#modal-logradouros">
            Adicionar caminhos
          </button>
        </div>
      </div>

      <div class="form-group">
        <label for="tb_instituicoes_instituicao_id" class="col-md-3 control-label">Escolas</label>
        <div class="col-md-3">
          <button type="button" class="btn btn-warning col-xs-12" data-toggle="modal" data-target="#modal-escolas">
            Adicionar escolas
          </button>
        </div>
      </div>

      <hr />

      <div class="form-group">
        <label for="tb_veiculos_veiculo_placa" class="col-md-3 control-label">Veículos</label>
        <div class="col-md-4">
          <select class="form-control" name="tb_veiculos_veiculo_placa" id="tb_veiculos_veiculo_placa">
            <option value="">Selecione</option>
            <?php
            $stat = 1;
            $read->Reader('tb_veiculos', 'where veiculo_status = :stat', "stat={$stat}");
            if ($read->getResult()):
              foreach ($read->getResult() as $veiculos):
                $description = $veiculos['veiculo_placa'] . ' - ' . $veiculos['veiculo_marca'] . ' - ' . $veiculos['veiculo_modelo'];
                echo "<option value=\"{$veiculos['veiculo_id']}\">{$description}</option>";
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
              <input type="date" name="inicio" placeholder="<?= date('d/m/Y'); ?>" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="input-group">
              <div class="input-group-addon">Fim</div>
              <input type="date" name="fim" placeholder="<?= date('d/m/Y', strtotime('+1 year')); ?>" />
            </div>
          </div>
        </div>
      </div>

      <hr />

      <div id="list-group-logradouros">
        <h4>Caminhos que compõem a rota</h4>
        <ul class="list-group" id="list-rota"></ul>
        <hr />
        <h4>Escolas que estão nessa rota</h4>
        <ul class="list-group" id="list-escolas"></ul>
      </div>
      <div class="list-group" id="list-group-escolas"></div>

      <div class="form-group">
        <label for="" class="col-md-3 control-label"></label>
        <div class="col-md-3">
          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-download"></i> Gravar</button>
        </div>
      </div>

      <!-- modal -->
      <div class="modal fade" id="modal-logradouros" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Título - Modal logradouros</h4>
            </div>
            <div class="modal-body  style="overflow: visible;" form-horizontal">

              <div class="form-group">
                <label for="tb_logradouros_logradouro_id" class="col-md-3 control-label">Logradouros</label>
                <div class="col-md-7">
                  <select class="form-control" name="tb_logradouros_logradouro_id" id="tb_logradouros_logradouro_id">
                    <option value="">Selecione</option>
                    <?php
                    $read->Reader('tb_logradouros', 'inner join tb_bairros on '
                    . 'tb_logradouros.tb_bairros_bairros_id = tb_bairros.bairros_id');
                    if ($read->getRowCount() > 0):
                      foreach ($read->getResult() as $options):
                        echo "<option value=\"{$options['logradouro_id']}\">{$options['logradouro_id']} - {$options['logradouro_nome']} -- "
                        . "{$options['bairros_nome']}</option>";
                      endforeach;
                    endif;
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="ref" class="col-md-3 control-label">Observações</label>
                <div class="col-md-7">
                  <textarea name="caminho_ref" id="ref"
                  placeholder="Coloque neste campo uma referência para o percurso." class="form-control"></textarea>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-primary add-logradouros">Adicionar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- fim modal -->

      <!-- modal -->
      <div class="modal fade" id="modal-escolas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Título - Modal escolas</h4>
            </div>
            <div class="modal-body">

              <div class="row form-horizontal">
                <label for="escolas" class="col-md-3 control-label">Escolas</label>
                <div class="col-md-7">
                  <select class="form-control" name="escolas_select" id="escolas">
                    <option value="">Selecione</option>
                    <?php
                    $stat = 1;
                    $read->Reader('tb_instituicoes', 'where instituicao_status = :stat', "stat={$stat}");
                    if ($read->getResult()):
                      foreach ($read->getResult() as $escolas):
                        echo "<option value='{$escolas['instituicao_id']}'>{$escolas['instituicao_id']} - {$escolas['instituicao_nome']}</option>";
                      endforeach;
                    endif;
                    ?>
                  </select>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-primary add-escolas">Adicionar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- fim modal -->

    </div>
  </div>
</div>
