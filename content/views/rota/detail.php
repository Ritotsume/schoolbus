<div class="side-body">
  <?php
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  $idRota = filter_input(INPUT_GET, 'param', FILTER_DEFAULT);
  $param = filter_input(INPUT_GET, 'ref', FILTER_VALIDATE_INT);

  if (isset($idRota) && !empty($idRota)):
    $readrota = new ModelRotas();
    $dataRota = $readrota->getRota($idRota);
    if ($dataRota):
      ?>

      <div class="page-title">
        <span class="title">Detalhamento de rotas</span>
        <div class="description">Detalhamento de rotas, permite visualizar detalhes adicionais sobre determinada rota.</div>
      </div>

      <div class="card">
        <div class="card-header">
          <div class="card-title">
          </div>
        </div>
        <div class="card-body">

          <form id="detail-rotas" method="post" action="">

            <div class="form-group">
              <label for="rota_inicio" class="col-md-3 control-label">Início do trajeto</label>
              <div class="col-md-4">
                <?php
                $rotaInicio = new ModelEnderecos;
                $inicio = $rotaInicio->getLogradouro($dataRota[0]['rota_saida']);
                $inicio = $inicio[0]['logradouro_nome'] . ', ' . $inicio[0]['bairros_nome'] . ', ' . $inicio[0]['cidade_nome'] . ' - ' . $inicio[0]['cidade_uf'];
                echo $inicio;
                ?>
              </div>
            </div>

            <div class="form-group">
              <label for="rota_fim" class="col-md-3 control-label">Fim do trajeto</label>
              <div class="col-md-4">
                <?php
                $rotaFim = clone $rotaInicio;
                $fim = $rotaFim->getLogradouro($dataRota[0]['rota_chegada']);
                $fim = $fim[0]['logradouro_nome'] . ', ' . $fim[0]['bairros_nome'] . ', ' . $fim[0]['cidade_nome'] . ' - ' . $fim[0]['cidade_uf'];
                echo $fim;
                ?>
              </div>
            </div>

            <hr />

            <div class="form-group">
              <label for="" class="col-md-3 control-label">Escolas</label>
              <div class="col-md-7">
                <?php
                $escolasCad = json_decode($dataRota[0]['rota_instituicoes'], true);
                $escolasData = new ModelInstituicao;

                foreach($escolasCad as $idEscola){
                  $escola = clone $escolasData;
                  $escola->getInstituicao($idEscola);
                  if($escola->getResult()){
                    $dataEscola = $escola->getResult();
                    echo "<div class='row'>
                    <ul>
                    <li>Escola: {$dataEscola[0]['instituicao_nome']}</li>
                    <li>Endereço: ".
                    $dataEscola[0]['logradouro_nome'] . ', ' . $dataEscola[0]['instituicao_numero'] . ', '
                    . $dataEscola[0]['bairros_nome'] . ', ' . $dataEscola[0]['cidade_nome'] . ' - '
                    . $dataEscola[0]['cidade_uf']
                    ."</li>
                    </ul>
                    </div>";
                  }
                }
                ?>
              </div>
            </div>

            <hr />

            <div class="form-group">
              <label for="rota_veiculo" class="col-md-3 control-label">Veículo</label>
              <div class="col-md-4">
                <?php
                $veiculos = new ModelVeiculo;
                $veiculos->getVeiculo($dataRota[0]['tb_veiculos_veiculo_id']);
                $veiculo = $veiculos->getResult()[0]['veiculo_marca'] . '-' . $veiculos->getResult()[0]['veiculo_modelo'] .
                ', Placa: ' . $veiculos->getResult()[0]['veiculo_placa'] . ' - ' .
                (($veiculos->getResult()[0]['veiculo_agregado'] == 2) ? 'Veículo da Prefeitura.' : 'Veículo agregado.');
                echo $veiculo;
                ?>
              </div>
            </div>

            <hr />

            <div class="form-group">
              <label for="" class="col-md-3 control-label">Período</label>
              <div class="col-md-8">
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-addon">Início</div>
                    <input type="text" class="form-control" value="<?= date('d/m/Y', strtotime($dataRota[0]['rota_inicio'])); ?>" disabled="disabled" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-addon">Fim</div>
                    <input type="text" class="form-control" value="<?= date('d/m/Y', strtotime($dataRota[0]['rota_fim'])); ?>" disabled="disabled" />
                  </div>
                </div>
              </div>
            </div>

            <hr />

            <div class="form-group">
              <label for="observacoes" class="col-md-3 control-label">Observações</label>
              <div class="col-md-4">
                <?= $dataRota[0]['rota_observacoes']; ?>
              </div>
            </div>

            <hr />

            <div class="form-group">
              <label for="" class="col-xs-3"></label>
              <div class="col-xs-2">
                <button type="button" class="btn btn-warning btn-block print-form" name="editar"><i class="fa fa-print"></i> Imprimir</button>
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
      </form>
    </div>
  </div>
</div>
